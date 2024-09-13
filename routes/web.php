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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;

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
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboards Routes

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'handlePostRequest'])->name('dashboard');
    Route::post('/switch-dealer', [DashboardController::class, 'switchDealerAccount'])->name('dashboard.switch.dealer');

    Route::name('dashboard.')->group(function () {

    });
    // User Management routes
    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class)->middleware('check.dynamic.route.permissions:user');
        Route::resource('/user-management/roles', RoleManagementController::class)->middleware('check.dynamic.route.permissions:role');
        Route::resource('/user-management/permissions', PermissionManagementController::class)->middleware('check.dynamic.route.permissions:permission');
    });

    // Lead Sources routes
    Route::resource('lead-sources', LeadSourceController::class)->middleware('check.dynamic.route.permissions:lead source');

    // Statuses routes
    Route::resource('statuses', StatusController::class)->middleware('check.dynamic.route.permissions:status');

    // Statuses routes
    Route::resource('state-colours', StatecolourController::class)->middleware('check.dynamic.route.permissions:state colour');
    Route::post('/state-colours/store', [StatecolourController::class, 'store'])->name('state-colour.store');
    Route::post('/state-colours/update', [StatecolourController::class, 'update'])->name('state-colour.update');
    Route::post('/state-colours/get-states', [StatecolourController::class, 'getStates'])->name('stateColours.getStates');
    Route::post('/state-colours/destroy', [StatecolourController::class, 'destroy'])->name('state-colour.destroy');

    // Leads routes
    Route::resource('leads', LeadController::class)->middleware('check.dynamic.route.permissions:lead');
    Route::post('/leads/noteStore', [LeadController::class, 'noteStore'])->name('leads.noteStore');
    Route::post('/leads/update', [LeadController::class, 'update'])->name('leads.update');
    Route::post('/leads/mark-as-read', [LeadController::class, 'markAsRead'])->name('leads.markAsRead');
    Route::post('/leads/view-lead-comments', [LeadController::class, 'viewLeadComments'])->name('leads.viewLeadComments');
    Route::post('/leads/get-states', [LeadController::class, 'getStates'])->name('leads.getStates');
    Route::post('/leads/get-cities', [LeadController::class, 'getCities'])->name('leads.getCities');
    Route::post('/leads/destroy', [LeadController::class, 'destroy'])->name('leads.destroy');

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


    // setting routes
    Route::get('settings/index', [SettingController::class, 'index'])->middleware('check.dynamic.route.permissions:setting')->name('settings.index');
    Route::post('settings/update', [SettingController::class, 'update'])->name('setting.update');

    // calendars routes
    Route::resource('calendars', CalendarController::class)->middleware('check.dynamic.route.permissions:appointment');

    // Utility Company routes
    Route::resource('utility-companies', UtilityCompanyController::class)->middleware('check.dynamic.route.permissions:utility company');
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
