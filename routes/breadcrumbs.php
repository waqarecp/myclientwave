<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;
use App\Models\LeadSource;
use App\Models\Lead;
use App\Models\UtilityCompany;
use App\Models\Appointment;
use App\Models\LeadStatus;

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

// Home > Lead Sources > index
Breadcrumbs::for('lead-sources.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Lead Source', route('lead-sources.index'));
});

// Home > Lead Sources > [Lead Source]
Breadcrumbs::for('lead-sources.show', function (BreadcrumbTrail $trail, LeadSource $leadSource) {
    $trail->parent('lead-sources.index');
    $trail->push(ucwords($leadSource->source_name), route('lead-sources.show', $leadSource));
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


// Home > Utility Company > index
Breadcrumbs::for('utility-companies.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Utility Company', route('utility-companies.index'));
});

// Home > Utility Company > [Utility Company]
Breadcrumbs::for('utility-companies.show', function (BreadcrumbTrail $trail, UtilityCompany $utilityCompany) {
    $trail->parent('utility-companies.index');
    $trail->push(ucwords($utilityCompany->utility_company_name), route('utility-companies.show', $utilityCompany));
});

// Home > Appointment > index
Breadcrumbs::for('appointments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Appointment', route('appointments.index'));
});

// Home > Appointment > [Appointment]
Breadcrumbs::for('appointments.show', function (BreadcrumbTrail $trail, Appointment $appointment) {
    $trail->parent('appointments.index');
    $trail->push(ucwords($appointment->id), route('appointments.show', $appointment));
});

// Home > Calendar > index
Breadcrumbs::for('calendars.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Calendar', route('calendars.index'));
});

// Home > Lead Statuses > index
Breadcrumbs::for('lead-statuses.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Lead Status', route('lead-statuses.index'));
});

// Home > Lead Statuses > [Lead Status]
Breadcrumbs::for('lead-statuses.show', function (BreadcrumbTrail $trail, LeadStatus $leadstatus) {
    $trail->parent('lead-statuses.index');
    $trail->push(ucwords($leadstatus->status_name), route('lead-statuses.show', $leadstatus));
});