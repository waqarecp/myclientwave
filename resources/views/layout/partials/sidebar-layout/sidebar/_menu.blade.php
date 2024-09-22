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
                $hasPermissionLead = auth()->user()->can('read lead') || auth()->user()->can('write lead') || auth()->user()->can('create lead');
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
                $hasPermissionAppointment = auth()->user()->can('read appointment') || auth()->user()->can('write appointment') || auth()->user()->can('create appointment');
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
                $hasPermissionCalendar = auth()->user()->can('read appointment') || auth()->user()->can('write appointment') || auth()->user()->can('create appointment');
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
                $hasPermissionDeal = auth()->user()->can('read deal') || auth()->user()->can('write deal') || auth()->user()->can('create deal');
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
                $hasPermissionUtilityCompanies = auth()->user()->can('read utility company') || auth()->user()->can('write utility company') || auth()->user()->can('create utility company');
            @endphp
            @if($hasPermissionUtilityCompanies)
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('utility-companies')}}">
                    <a class="menu-link {{ request()->routeIs('utility-companies') ? 'active' : '' }}" href="{{ route('utility-companies.index') }}">
                        <span class="menu-icon">{!! getIcon('color-swatch', 'fs-2') !!}</span>
                        <span class="menu-title">Utility Companies</span>
                    </a>
                </div>
            @endif
            <!--end:Menu item-->

            <!--begin:Menu item-->
            @php
                $hasPermissionUser = auth()->user()->can('read user') || auth()->user()->can('write user') || auth()->user()->can('create user');
                $hasPermissionRole = auth()->user()->can('read role') || auth()->user()->can('write role') || auth()->user()->can('create role');
                $hasPermissionPermission = auth()->user()->can('read permission') || auth()->user()->can('write permission') || auth()->user()->can('create permission');
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
                $hasPermissionLeadSources = auth()->user()->can('read lead source') || auth()->user()->can('write lead source') || auth()->user()->can('create lead source');
                $hasPermissionStatus = auth()->user()->can('read status') || auth()->user()->can('write status') || auth()->user()->can('create status');
                $hasPermissionState = auth()->user()->can('read state colour') || auth()->user()->can('write state colour') || auth()->user()->can('create state colour');
                $hasPermissionStage = auth()->user()->can('read stage') || auth()->user()->can('write stage') || auth()->user()->can('create stage');
                $hasPermissionHomeType = auth()->user()->can('read home type') || auth()->user()->can('write home type') || auth()->user()->can('create home type');
                $hasPermissionCommunicationMethod = auth()->user()->can('read communication method') || auth()->user()->can('write communication method') || auth()->user()->can('create communication method');
                $hasPermissionCountrySetting = auth()->user()->can('read setting') || auth()->user()->can('write setting') || auth()->user()->can('create setting');

                $hasPermissionManagementSetting = $hasPermissionLeadSources || $hasPermissionStatus || $hasPermissionState || $hasPermissionStage || $hasPermissionHomeType || $hasPermissionCommunicationMethod || $hasPermissionCountrySetting;
                $manageSettingsActive = request()->routeIs('lead-sources.*', 'statuses.*', 'state-colours.*', 'utility-companies.*', 'deals.*', 'stages.*', 'home_types.*', 'communication_methods.*', 'settings.index');
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


        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
