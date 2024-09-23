<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;
use App\Models\LeadSource;
use App\Models\Lead;
use App\Models\UtilityCompany;
use App\Models\Appointment;
use App\Models\Setting;
use App\Models\Status;
use App\Models\StateColour;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Accounts
Breadcrumbs::for('accounts', function (BreadcrumbTrail $trail) {
    $trail->push('Accounts', route('dashboard'));
});

// Developers
Breadcrumbs::for('developers', function (BreadcrumbTrail $trail) {
    $trail->push('Developers', route('dashboard'));
});

// Integrations
Breadcrumbs::for('integrations', function (BreadcrumbTrail $trail) {
    $trail->push('Integrations', route('dashboard'));
});

// Breadcrumbs for System
Breadcrumbs::for('system', function (BreadcrumbTrail $trail) {
    $trail->parent('home'); // Assuming performance analytics is accessed from the dashboard
    $trail->push('System', route('system.logs'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});


// Home > Integrations > Settings
Breadcrumbs::for('integrations.settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('integrations');
    $trail->push('Setting', route('integrations.settings.index'));
});

// Home > Lead > index
Breadcrumbs::for('leads.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Leads', route('leads.index'));
});

// Home > Lead > [Lead]
Breadcrumbs::for('leads.show', function (BreadcrumbTrail $trail, Lead $lead) {
    $trail->parent('leads.index');
    $trail->push(ucwords($lead->first_name), route('leads.show', $lead));
});

// Home > Appointment > index
Breadcrumbs::for('appointments', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Appointment', route('appointments'));
});

// Home > Appointment > [Appointment]
Breadcrumbs::for('appointments.show', function (BreadcrumbTrail $trail, Appointment $appointment) {
    $trail->parent('appointments');
    $trail->push(ucwords($appointment->id), route('appointments.show', $appointment));
});

// Home > Calendar > index
Breadcrumbs::for('calendars.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Calendar', route('calendars.index'));
});

// Home > settings > Lead Sources > index
Breadcrumbs::for('lead-sources.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('Lead Source', route('lead-sources.index'));
});

// Home > settings > Lead Sources > [Lead Source]
Breadcrumbs::for('lead-sources.show', function (BreadcrumbTrail $trail, LeadSource $leadSource) {
    $trail->parent('lead-sources.index');
    $trail->push(ucwords($leadSource->source_name), route('lead-sources.show', $leadSource));
});

// Home > settings > Statuses > index
Breadcrumbs::for('statuses.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('Statuses', route('statuses.index'));
});

// Home > settings > Statuses > [Status]
Breadcrumbs::for('statuses.show', function (BreadcrumbTrail $trail, Status $status) {
    $trail->parent('statuses.index');
    $trail->push(ucwords($status->status_name), route('statuses.show', $status));
});

// Home > settings > states color > index
Breadcrumbs::for('state-colours.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('States Colour', route('state-colours.index'));
});

// Home > settings > Utility Company > index
Breadcrumbs::for('utility-companies.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('Utility Company', route('utility-companies.index'));
});

// Home > Settings > Deals > index
Breadcrumbs::for('deals.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Deals', route('deals.index'));
});

// Home > Settings > Deals > [Deal]
Breadcrumbs::for('deals.show', function (BreadcrumbTrail $trail, $deal) {
    $trail->parent('deals.index');
    $trail->push($deal->deal_name, route('deals.show', $deal));
});
// Home > settings >Utility Company > [Utility Company]
Breadcrumbs::for('utility-companies.show', function (BreadcrumbTrail $trail, UtilityCompany $utilityCompany) {
    $trail->parent('utility-companies.index');
    $trail->push(ucwords($utilityCompany->utility_company_name), route('utility-companies.show', $utilityCompany));
});

// Home > Settings > Stages > index
Breadcrumbs::for('stages.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('Stages', route('stages.index'));
});

// Home > Settings > Stages > [Stage]
Breadcrumbs::for('stages.show', function (BreadcrumbTrail $trail, $stage) {
    $trail->parent('stages.index');
    $trail->push($stage->stage_name, route('stages.show', $stage));
});

// Home > Settings > Home Types > index
Breadcrumbs::for('home_types.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('Home Types', route('home_types.index'));
});

// Home > Settings > Home Types > [Home Type]
Breadcrumbs::for('home_types.show', function (BreadcrumbTrail $trail, $homeType) {
    $trail->parent('home_types.index');
    $trail->push($homeType->home_type_name, route('home_types.show', $homeType));
});

// Home > Settings > Communication Methods > index
Breadcrumbs::for('communication_methods.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#');
    $trail->push('Communication Methods', route('communication_methods.index'));
});

// Home > Settings > Communication Methods > [Communication Method]
Breadcrumbs::for('communication_methods.show', function (BreadcrumbTrail $trail, $method) {
    $trail->parent('communication_methods.index');
    $trail->push($method->method_name, route('communication_methods.show', $method));
});

// Home > Manage Setting > ountry > index
Breadcrumbs::for('settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Settings', '#'); // The settings parent node
    $trail->push('Country', route('settings.index'));
});