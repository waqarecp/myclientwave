<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Drawer toggle-->
		<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-200px h-35px">
            <div class="navbar-item" title="You are currently using {{ session('dealer_name') }} account">
                <b>CRM Admin Panel</b>
            </div>
        </div>
        <!--end::Drawer toggle-->
    </div>
    <!--begin::Search-->
    <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">
        @include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/search/_dropdown')
    </div>
    <!--end::Search-->
    <!--begin::User menu-->
	<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
		<div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            @if(Auth::user()->profile_photo_url)
                <img src="{{ \Auth::user()->profile_photo_url }}" class="rounded-3" alt="user" />
            @else
                <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()->name) }}">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            @endif
        </div>
        @include('partials/menus/_user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
</div>
<!--end::Navbar-->
