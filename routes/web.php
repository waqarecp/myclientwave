<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UtilityCompanyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Auth\SocialiteController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\SettingsController;

use App\Http\Controllers\SystemController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportsController;
use App\Models\Appointment;
use App\Models\UtilityCompany;

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

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboards Routes
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'handlePostRequest'])->name('dashboard');
    Route::post('/performance-analytics', [DashboardController::class, 'handlePostRequest'])->name('dashboard.performance.analytics.post');
    Route::post('/google-campaigns', [DashboardController::class, 'handlePostRequest'])->name('dashboard.google.campaigns.post');
    Route::post('/facebook-analytics', [DashboardController::class, 'handlePostRequest'])->name('dashboard.facebook.analytics.post');
    Route::get('/analytics-accounts', [DashboardController::class,'getAnalyticsAccounts'])->name('dashboard.analytics.account');
    Route::post('/switch-dealer', [DashboardController::class, 'switchDealerAccount'])->name('dashboard.switch.dealer');

    Route::name('dashboard.')->group(function () {

    });

    // System Routes
    Route::get('/logs', [SystemController::class, 'index'])->name('system.logs')->middleware('check.dynamic.route.permissions:logs');

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

    // Leads routes
    Route::resource('leads', LeadController::class)->middleware('check.dynamic.route.permissions:lead');
    Route::post('/leads/noteStore', [LeadController::class, 'noteStore'])->name('leads.noteStore');
    Route::post('/leads/get-data', [LeadController::class, 'getData'])->name('leads.getData');
    Route::post('/leads/mark-as-read', [LeadController::class, 'markAsRead'])->name('leads.markAsRead');
    Route::post('/leads/view-lead-comments', [LeadController::class, 'viewLeadComments'])->name('leads.viewLeadComments');

    // appointments routes
    Route::resource('appointments', AppointmentController::class)->middleware('check.dynamic.route.permissions:appointment');
    Route::post('/appointments/update-timeline', [AppointmentController::class, 'updateTimeline'])->name('appointments.updateTimeline');
    Route::post('/appointments/mark-as-read', [AppointmentController::class, 'markAsRead'])->name('appointments.markAsRead');
    Route::post('/appointments/note-store', [AppointmentController::class, 'noteStore'])->name('appointments.noteStore');
    Route::post('/appointments/view-status-comments', [AppointmentController::class, 'viewStatusComments'])->name('appointments.viewStatusComments');

    // calendars routes
    Route::resource('calendars', CalendarController::class)->middleware('check.dynamic.route.permissions:appointment');

    // Utility Company routes
    Route::resource('utility-companies', UtilityCompanyController::class)->middleware('check.dynamic.route.permissions:utility company');

    // Reports routes
    Route::name('reports.')->group(function () {
        Route::get('/reports/dsm-market-report', [ReportsController::class, 'index'])->name('dsm-market-report.index');
    });
    
    // Reports audience-manager
    Route::name('audience-manager.')->group(function () {
        Route::get('/audience-manager/campaigns', [ReportsController::class, 'list'])->name('campaigns.list');
    });

    // Define routes for integrations
    Route::name('integrations.')->group(function () {
        Route::resource('/integrations/settings', SettingsController::class)->middleware('check.dynamic.route.permissions:settings');
    });

    Route::get('/get-providers',[\App\Http\Controllers\ProviderController::class, 'getProviders'])->name('inventory-setup.getProvider');

    Route::name('legal.')->group(function () {

    });

});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
