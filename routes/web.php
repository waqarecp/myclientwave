<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatecolourController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UtilityCompanyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CommunicationMethodController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeTypeController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StageController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index']);
Route::get('/register-company', [FrontendController::class, 'registerCompany'])->name('register-company');
Route::post('/store-company', [CompanyController::class, 'store'])->name('store-company');
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboards Routes

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'handlePostRequest'])->name('dashboard');
    Route::post('/switch-dealer', [DashboardController::class, 'switchDealerAccount'])->name('dashboard.switch.dealer');

    Route::name('dashboard.')->group(function () {});
    // User Management routes
    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class)->middleware('check.dynamic.route.permissions:user');
        Route::resource('/user-management/roles', RoleManagementController::class)->middleware('check.dynamic.route.permissions:role');
        Route::resource('/user-management/permissions', PermissionManagementController::class)->middleware('check.dynamic.route.permissions:permission');
    });

    // Leads routes
    Route::resource('leads', LeadController::class)->middleware('check.dynamic.route.permissions:lead');
    Route::post('/leads/noteStore', [LeadController::class, 'noteStore'])->name('leads.noteStore');
    Route::post('/leads/update', [LeadController::class, 'update'])->name('leads.update');
    Route::post('/leads/mark-as-read', [LeadController::class, 'markAsRead'])->name('leads.markAsRead');
    Route::post('/leads/view-lead-comments', [LeadController::class, 'viewLeadComments'])->name('leads.viewLeadComments');
    Route::post('/leads/get-states', [LeadController::class, 'getStates'])->name('leads.getStates');
    Route::post('/leads/get-cities', [LeadController::class, 'getCities'])->name('leads.getCities');
    Route::post('/leads/destroy', [LeadController::class, 'destroy'])->name('leads.destroy');
    Route::post('/leads/covert-lead-to-deal', [LeadController::class, 'convertLeadToDeal'])->name('leads.convertLeadToDeal');
    Route::post('/leads/export', [LeadController::class, 'export'])->name('leads.export');

    // appointments routes
    Route::resource('appointments', AppointmentController::class)->middleware('check.dynamic.route.permissions:appointment');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::post('/appointments/update-appointment', [AppointmentController::class, 'updateAppointment'])->name('appointment.updateAppointment');
    Route::post('/appointments/get-address', [AppointmentController::class, 'getLeadAddress'])->name('appointment.getLeadAddress');
    Route::post('/appointments/view-timeline', [AppointmentController::class, 'viewTimeline'])->name('appointments.viewTimeline');
    Route::post('/appointments/update-timeline', [AppointmentController::class, 'update'])->name('appointments.updateTimeline');
    Route::post('/appointments/mark-as-read', [AppointmentController::class, 'markAsRead'])->name('appointments.markAsRead');
    Route::post('/appointments/note-store', [AppointmentController::class, 'noteStore'])->name('appointments.noteStore');
    Route::post('/appointments/view-status-comments', [AppointmentController::class, 'viewStatusComments'])->name('appointments.viewStatusComments');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::post('/appointments/export', [AppointmentController::class, 'export'])->name('appointments.export');

    // calendars routes
    Route::resource('calendars', CalendarController::class)->middleware('check.dynamic.route.permissions:appointment');

    // deals routes
    Route::resource('deals', DealController::class)->except(['update', 'destroy'])->middleware('check.dynamic.route.permissions:deal');
    Route::post('/deals/update', [DealController::class, 'update'])->name('deals.update');
    Route::post('/deals/destroy', [DealController::class, 'destroy'])->name('deals.destroy');
    Route::post('/deals/view-deal-timeline', [DealController::class, 'viewDealTimeline'])->name('deals.viewTimeline');
    Route::post('/deals/update-deal-timeline', [DealController::class, 'updateDealTimeline'])->name('deals.updateTimeline');
    Route::post('/deals/export', [DealController::class, 'export'])->name('deals.export');

    // Utility Company routes
    Route::resource('utility-companies', UtilityCompanyController::class)->middleware('check.dynamic.route.permissions:utility company');

    Route::group(['middleware' => 'check.company.access'], function () {
        Route::resource('companies', CompanyController::class)->except(['store', 'update', 'destroy']);
        Route::post('/companies/update', [CompanyController::class, 'update'])->name('companies.update');
        Route::post('/companies/destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');
        Route::post('/companies/active', [CompanyController::class, 'active'])->name('companies.active');
        Route::post('/companies/export', [CompanyController::class, 'export'])->name('companies.export');
    });

    Route::prefix('manage-settings')->group(function () {
        // Lead Sources routes
        Route::resource('lead-sources', LeadSourceController::class)->middleware('check.dynamic.route.permissions:lead source');

        // Statuses routes
        Route::resource('statuses', StatusController::class)->middleware('check.dynamic.route.permissions:status');

        // States color routes
        Route::resource('state-colours', StatecolourController::class)->middleware('check.dynamic.route.permissions:state colour');
        Route::post('/state-colours/store', [StatecolourController::class, 'store'])->name('state-colour.store');
        Route::post('/state-colours/update', [StatecolourController::class, 'update'])->name('state-colour.update');
        Route::post('/state-colours/get-states', [StatecolourController::class, 'getStates'])->name('stateColours.getStates');
        Route::post('/state-colours/destroy', [StatecolourController::class, 'destroy'])->name('state-colour.destroy');

        // stages routes
        Route::resource('stages', StageController::class)->except(['update', 'destroy'])->middleware('check.dynamic.route.permissions:stage');
        Route::post('/stages/update', [StageController::class, 'update'])->name('stage.update');
        Route::post('/stages/destroy', [StageController::class, 'destroy'])->name('stage.destroy');
       
        // Routes for pipeline
        Route::resource('pipeline', PipelineController::class)->except(['update', 'destroy'])->middleware('check.dynamic.route.permissions:pipeline');
        Route::post('/pipeline/update', [PipelineController::class, 'update'])->name('pipeline.update');
        Route::post('/pipeline/destroy', [PipelineController::class, 'destroy'])->name('pipeline.destroy');

        // home types routes
        Route::resource('home_types', HomeTypeController::class)->except(['update', 'destroy'])->middleware('check.dynamic.route.permissions:home type');
        Route::post('/home_types/update', [HomeTypeController::class, 'update'])->name('home_types.update');
        Route::post('/home_types/destroy', [HomeTypeController::class, 'destroy'])->name('home_types.destroy');

        // Routes for organizations
        Route::resource('organizations', OrganizationController::class)->except(['update', 'destroy'])->middleware('check.dynamic.route.permissions:organization');
        Route::post('/organizations/update', [OrganizationController::class, 'update'])->name('organizations.update');
        Route::post('/organizations/destroy', [OrganizationController::class, 'destroy'])->name('organizations.destroy');

        // communications routes
        Route::resource('communication_methods', CommunicationMethodController::class)->except(['update', 'destroy'])->middleware('check.dynamic.route.permissions:communication method');
        Route::post('/communication_methods/update', [CommunicationMethodController::class, 'update'])->name('communication_methods.update');
        Route::post('/communication_methods/destroy', [CommunicationMethodController::class, 'destroy'])->name('communication_methods.destroy');

        // Country setting routes
        Route::get('country', [SettingController::class, 'index'])->middleware('check.dynamic.route.permissions:setting')->name('settings.index');
        Route::post('country/update', [SettingController::class, 'update'])->name('setting.update');
    });
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
