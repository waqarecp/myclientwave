@php
$user = auth()->user();
@endphp
<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
         data-kt-scroll-activate="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
             data-kt-menu="true" data-kt-menu-expand="false">

            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('dashboard') || request()->routeIs('dashboard.*') ? 'here show' : '' }}">
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>
            <!--end:Menu item-->
            
            <!--begin:Menu item-->
            @php
                $hasPermissionLead = $user->can('read lead') || $user->can('write lead') || $user->can('create lead');
            @endphp
            @if($hasPermissionLead)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('leads')}}">
                    <a class="menu-link {{ request()->routeIs('leads') ? 'active' : '' }}" href="{{ route('leads.index') }}">
                        <span class="menu-icon">{!! getIcon('graph-up', 'fs-3') !!}</span>
                        <span class="menu-title">Leads</span>
                    </a>
                </div>
            @endif
            <!--end:Menu item-->
            
            <!--begin:Menu item-->
            @php
                $hasPermissionAppointment = $user->can('read appointment') || $user->can('write appointment') || $user->can('create appointment');
            @endphp
            @if($hasPermissionAppointment)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('appointments')}}">
                    <a class="menu-link {{ request()->routeIs('appointments') ? 'active' : '' }}" href="{{ route('appointments') }}">
                        <span class="menu-icon">{!! getIcon('profile-user', 'fs-3') !!}</span>
                        <span class="menu-title">Appointments</span>
                    </a>
                </div>
            @endif
            <!--end:Menu item-->
            
            <!--begin:Menu item-->
            @php
                $hasPermissionCalendar = $user->can('read appointment') || $user->can('write appointment') || $user->can('create appointment');
            @endphp
            @if($hasPermissionCalendar)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('calendars')}}">
                    <a class="menu-link {{ request()->routeIs('calendars') ? 'active' : '' }}" href="{{ route('calendars.index') }}">
                        <span class="menu-icon">{!! getIcon('calendar', 'fs-3') !!}</span>
                        <span class="menu-title">Calendars</span>
                    </a>
                </div>
            @endif
            <!--end:Menu item-->

            @php
                $hasPermissionDeal = $user->can('read deal') || $user->can('write deal') || $user->can('create deal');
            @endphp
            @if($hasPermissionDeal)
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('deals.index') ? 'active' : '' }}" href="{{ route('deals.index') }}">
                        <span class="menu-icon">{!! getIcon('like', 'fs-3') !!}</span>
                        <span class="menu-title">Deals</span>
                    </a>
                </div>
            @endif
            
            <!--begin:Menu item-->
            @php
                $hasPermissionUtilityCompanies = $user->can('read utility company') || $user->can('write utility company') || $user->can('create utility company');
            @endphp
            @if($hasPermissionUtilityCompanies)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('utility-companies')}}">
                    <a class="menu-link {{ request()->routeIs('utility-companies.*') ? 'active' : '' }}" href="{{ route('utility-companies.index') }}">
                        <span class="menu-icon">{!! getIcon('color-swatch', 'fs-2') !!}</span>
                        <span class="menu-title">Utility Companies</span>
                    </a>
                </div>
            @endif
            <!--end:Menu item-->

            <!--begin:Menu item-->
            @php
                $hasPermissionUser = $user->can('read user') || $user->can('write user') || $user->can('create user');
                $hasPermissionRole = $user->can('read role') || $user->can('write role') || $user->can('create role');
                $hasPermissionPermission = $user->can('read permission') || $user->can('write permission') || $user->can('create permission');
                $hasPermissionUserManagement = $hasPermissionUser || $hasPermissionRole || $hasPermissionPermission;
            @endphp
            @if($hasPermissionUserManagement)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">{!! getIcon('user-edit', 'fs-2') !!}</span>
                        <span class="menu-title">User Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @if($hasPermissionUser)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}" href="{{ route('user-management.users.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Users</span>
                                </a>
                            </div>
                        @endif
                        @if($hasPermissionRole)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('user-management.roles.*') ? 'active' : '' }}" href="{{ route('user-management.roles.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Roles</span>
                                </a>
                            </div>
                        @endif
                        @if($hasPermissionPermission)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('user-management.permissions.*') ? 'active' : '' }}" href="{{ route('user-management.permissions.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Permissions</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <!--end:Menu item-->
            
            @php
                $hasPermissionLeadSources = $user->can('read lead source') || $user->can('write lead source') || $user->can('create lead source');
                $hasPermissionStatus = $user->can('read status') || $user->can('write status') || $user->can('create status');
                $hasPermissionState = $user->can('read state colour') || $user->can('write state colour') || $user->can('create state colour');
                $hasPermissionStage = $user->can('read stage') || $user->can('write stage') || $user->can('create stage');
                $hasPermissionHomeType = $user->can('read home type') || $user->can('write home type') || $user->can('create home type');
                $hasPermissionOrganization = $user->can('read organization') || $user->can('write organization') || $user->can('create organization');
                $hasPermissionCommunicationMethod = $user->can('read communication method') || $user->can('write communication method') || $user->can('create communication method');
                $hasPermissionCountrySetting = $user->can('read setting') || $user->can('write setting') || $user->can('create setting');

                $hasPermissionManagementSetting = $hasPermissionLeadSources || $hasPermissionStatus || $hasPermissionState || $hasPermissionStage || $hasPermissionHomeType || $hasPermissionCommunicationMethod || $hasPermissionCountrySetting || $hasPermissionOrganization;
                $manageSettingsActive = request()->routeIs('lead-sources.*', 'statuses.*', 'state-colours.*', 'stages.*', 'home_types.*', 'communication_methods.*', 'settings.index');
            @endphp

            <!--end:Menu item-->
            @if($hasPermissionManagementSetting)
                <!-- Parent Menu for Manage Settings -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $manageSettingsActive ? 'here show' : '' }}">
                    <span class="menu-link">
                        <span class="menu-icon">{!! getIcon('wrench', 'fs-3') !!}</span>
                        <span class="menu-title">Manage Settings</span>
                        <span class="menu-arrow"></span>
                    </span>
                    
                    <!-- Child Menu Items -->
                    <div class="menu-sub menu-sub-accordion">

                        @if($hasPermissionLeadSources)
                            <a class="menu-link {{ request()->routeIs('lead-sources.*') ? 'active' : '' }}" href="{{ route('lead-sources.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Lead Sources</span>
                            </a>
                        @endif

                        @if($hasPermissionStatus)
                            <a class="menu-link {{ request()->routeIs('statuses.*') ? 'active' : '' }}" href="{{ route('statuses.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Statuses</span>
                            </a>
                        @endif

                        @if($hasPermissionState)
                            <a class="menu-link {{ request()->routeIs('state-colours.*') ? 'active' : '' }}" href="{{ route('state-colours.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">State Colors</span>
                            </a>
                        @endif

                        @if($hasPermissionStage)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('stages.index') ? 'active' : '' }}" href="{{ route('stages.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Deal Stages</span>
                                </a>
                            </div>
                        @endif

                        @if($hasPermissionHomeType)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('home_types.index') ? 'active' : '' }}" href="{{ route('home_types.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Deal Home Types</span>
                                </a>
                            </div>
                        @endif

                        @if($hasPermissionOrganization)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('organizations.index') ? 'active' : '' }}" href="{{ route('organizations.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Manage Organizations</span>
                                </a>
                            </div>
                        @endif

                        @if($hasPermissionCommunicationMethod)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('communication_methods.index') ? 'active' : '' }}" href="{{ route('communication_methods.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Communication Methods</span>
                                </a>
                            </div>
                        @endif

                        @if($hasPermissionCountrySetting)
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('settings.index') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Country</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <!--begin:Menu item-->
            @php
                $hasPermissionManageCompanies = $user->company_id == 1 && ($user->roles[0] && $user->roles[0]->id == 1);
            @endphp

            @if($hasPermissionManageCompanies)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('companies')}}">
                    <a class="menu-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                        <span class="menu-icon">{!! getIcon('home', 'fs-2') !!}</span>
                        <span class="menu-title">Manage Companies</span>
                    </a>
                </div>
            @endif
            <!--end:Menu item-->
            
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
