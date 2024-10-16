<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<!--begin::Toolbar container-->
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/_page-title')
		<!--begin::Actions-->
        @if(request()->is('dashboard*') || request()->is('/'))
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                    @if(!View::hasSection('hide-date-range-picker'))
                        <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                class="btn btn-sm fw-bold btn-secondary d-flex align-items-center px-4 d-none">
                            <!--begin::Display range-->
                            <div class="text-gray-600 fw-bold">Loading date range...</div>
                            <!--end::Display range-->
                            <i class="ki-duotone ki-calendar-8 fs-2 ms-2 me-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                            </i>
                        </div>
                    @endif
                <!--end::Daterangepicker-->
                <?php
                    $company = App\Models\Company::where('id', \Illuminate\Support\Facades\Auth::user()->company_id)->first(); 
                    $subscription = $company->subscription('default');
                ?>
                @if ($subscription && ($company->onTrial('default') || $subscription->active()) && $subscription->ends_at === null) 
                    @if(auth()->user()->can('create lead'))
                        <a href="javascript:void(0)" class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_lead">{!! getIcon('plus', 'fs-2', '', 'i') !!} Create New Lead</a>
                    @endif
                @endif
            </div>
        @endIf
		<!--end::Actions-->
	</div>
	<!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
