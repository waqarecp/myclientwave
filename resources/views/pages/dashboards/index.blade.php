<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
        @endif
        <!--begin::Col-->
        <div class="col-xxl-4 mb-5 mb-xl-10">
            <!--begin::Chart widget 27-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">35,568</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <span class="badge badge-light-danger fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-danger ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>8.02%</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Organic Sessions</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-1">
                    <div id="kt_charts_widget_27" class="min-h-auto"></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 27-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4 mb-5 mb-xl-10">
            <!--begin::Chart widget 28-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">2,579</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>2.2%</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Domain External Links</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_28" class="h-300px w-100 min-h-auto"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 28-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4 mb-5 mb-xl-10">
            <!--begin::List widget 9-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">5,037</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>2.2%</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Visits by Social Networks</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Flag-->
                        <img src="assets/media/svg/brand-logos/dribbble-icon-1.svg" class="me-4 w-30px" style="border-radius: 4px" alt="" />
                        <!--end::Flag-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Dribbble</a>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Community</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span class="text-gray-800 fw-bold fs-4 me-3">579</span>
                                <!--end::Number-->
                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>2.6%</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Flag-->
                        <img src="assets/media/svg/brand-logos/linkedin-1.svg" class="me-4 w-30px" style="border-radius: 4px" alt="" />
                        <!--end::Flag-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Linked In</a>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social Media</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span class="text-gray-800 fw-bold fs-4 me-3">1,088</span>
                                <!--end::Number-->
                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-danger fs-base">
                                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>0.4%</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Flag-->
                        <img src="assets/media/svg/brand-logos/slack-icon.svg" class="me-4 w-30px" style="border-radius: 4px" alt="" />
                        <!--end::Flag-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Slack</a>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Messanger</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                                <!--end::Number-->
                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>0.2%</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Flag-->
                        <img src="assets/media/svg/brand-logos/youtube-3.svg" class="me-4 w-30px" style="border-radius: 4px" alt="" />
                        <!--end::Flag-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">YouTube</a>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Video Channel</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span class="text-gray-800 fw-bold fs-4 me-3">978</span>
                                <!--end::Number-->
                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>4.1%</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Flag-->
                        <img src="assets/media/svg/brand-logos/instagram-2-1.svg" class="me-4 w-30px" style="border-radius: 4px" alt="" />
                        <!--end::Flag-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Instagram</a>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social Network</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span class="text-gray-800 fw-bold fs-4 me-3">1,458</span>
                                <!--end::Number-->
                                <!--begin::Info-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>8.3%</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 9-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Table widget 9-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Top Referral Sources</span>
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Counted in Millions</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light">PDF Report</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold border-0 text-gray-500">
                                    <th class="min-w-150px" colspan="2">CAMPAIGN</th>
                                    <th class="min-w-150px text-end pe-0" colspan="2">SESSIONS</th>
                                    <th class="text-end min-w-150px" colspan="2">CONVERSION RATE</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Google</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6 me-1">1,256</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-935</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6 me-3">23.63%</span>
                                            <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-9.35%</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Facebook</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6 me-1">446</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-576</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6 me-3">12.45%</span>
                                            <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-57.02%</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Bol.com</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6 me-1">67</span>
                                            <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+24</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6 me-3">73.63%</span>
                                            <span class="text-success min-w-60px d-block text-end fw-bold fs-6">+28.73%</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Dutchnews.nl</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6 me-1">2,136</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-1,229</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6 me-3">3.67%</span>
                                            <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-12.29%</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Stackoverflow</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6 me-1">945</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-634</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6 me-3">25.03%</span>
                                            <span class="text-danger min-w-60px d-block text-end fw-bold fs-6">-9.35%</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Themeforest</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6 me-1">237</span>
                                            <span class="text-success min-w-50px d-block text-end fw-bold fs-6">106</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6 me-3">36.52%</span>
                                            <span class="text-success min-w-60px d-block text-end fw-bold fs-6">+3.06%</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Table Widget 9-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Table widget 10-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Top Performing Pages</span>
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Counted in Millions</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light">PDF Report</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold border-0 text-gray-500">
                                    <th class="min-w-200px" colspan="2">LANDING PAGE</th>
                                    <th class="min-w-100px text-end pe-0" colspan="2">CLICKS</th>
                                    <th class="text-end min-w-100px" colspan="2">AVG. POSITION</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Index</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6">1,256</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-935</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6">2.63</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-1.35</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Products</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6">446</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-576</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6">1.45</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">0.32</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">devs.keenthemes.com</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6">67</span>
                                            <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+24</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6">7.63</span>
                                            <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+8.73</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">studio.keenthemes.com</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6">2,136</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-1,229</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6">3.67</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-2.29</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">graphics.keenthemes.com</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6">945</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-634</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6">5.03</span>
                                            <span class="text-danger min-w-50px d-block text-end fw-bold fs-6">-0.35</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Licenses</a>
                                    </td>
                                    <td class="pe-0" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-800 fw-bold fs-6">237</span>
                                            <span class="text-success min-w-50px d-block text-end fw-bold fs-6">106</span>
                                        </div>
                                    </td>
                                    <td class="" colspan="2">
                                        <div class="d-flex justify-content-end">
                                            <span class="text-gray-900 fw-bold fs-6">3.52</span>
                                            <span class="text-success min-w-50px d-block text-end fw-bold fs-6">+3.06</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Table Widget 10-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Chart widget 15-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Author Sales</span>
                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Statistics by Countries</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-sm btn-light">PDF Report</a>
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-100px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Remove</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Mute</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Settings</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <!--begin::Chart container-->
                    <div id="kt_charts_widget_15_chart" class="min-h-auto ps-4 pe-6 mb-3 h-300px"></div>
                    <!--end::Chart container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 15-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Table widget 11-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Top Queries by Clicks</span>
                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Counted in Millions</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light">PDF Report</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between flex-column py-3">
                    <!--begin::Block-->
                    <div class="m-0"></div>
                    <!--end::Block-->
                    <!--begin::Table container-->
                    <div class="table-responsive mb-n2">
                        <!--begin::Table-->
                        <table class="table table-row-dashed gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold border-0 text-gray-500">
                                    <th class="min-w-300px">KEYWORD</th>
                                    <th class="min-w-100px">CLICKS</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Buy phone online</a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                        <div class="progress rounded-start-0">
                                            <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 166px" aria-valuenow="166" aria-valuemin="0" aria-valuemax="166px"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Top 10 Earbuds</a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">238</span>
                                        <div class="progress rounded-start-0">
                                            <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 158px" aria-valuenow="158" aria-valuemin="0" aria-valuemax="158px"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Cyber Monday</a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">189</span>
                                        <div class="progress rounded-start-0">
                                            <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 129px" aria-valuenow="129" aria-valuemin="0" aria-valuemax="129px"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">OLED TV in Amsterdam</a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                        <div class="progress rounded-start-0">
                                            <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 112px" aria-valuenow="112" aria-valuemin="0" aria-valuemax="112px"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Macbook M1</a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                        <div class="progress rounded-start-0">
                                            <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 107px" aria-valuenow="107" aria-valuemin="0" aria-valuemax="107px"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">Best noise cancelation headsets</a>
                                    </td>
                                    <td class="d-flex align-items-center border-0">
                                        <span class="fw-bold text-gray-800 fs-6 me-3">263</span>
                                        <div class="progress rounded-start-0">
                                            <div class="progress-bar bg-success m-0" role="progressbar" style="height: 12px;width: 74px" aria-valuenow="74" aria-valuemin="0" aria-valuemax="74px"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Table Widget 11-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4 mb-5 mb-xl-10">
            <!--begin::Chart widget 29-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">7,9</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>2.2%</span>
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Avarage Position</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end p-0">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_29" class="h-300px w-100 min-h-auto ps-7 pe-0 mb-5"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 29-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8 mb-5 mb-xl-10">
            <!--begin::Chart widget 24-->
            <div class="card card-flush overflow-hidden h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Human Resources</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Reports by states and ganders</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_24" class="min-h-auto" style="height: 300px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Chart widget 24-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-0">
            <!--begin::List widget 12-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Visits by Source</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">29.4k visitors</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-rocket fs-3 text-gray-600">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Container-->
                            <div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                                <!--begin::Content-->
                                <div class="me-5">
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Direct Source</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link clicks</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-4 me-3">1,067</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <!--begin::label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>2.6%</span>
                                    <!--end::label-->
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-tiktok fs-3 text-gray-600">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Container-->
                            <div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                                <!--begin::Content-->
                                <div class="me-5">
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Social Networks</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">All Social Channels</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-4 me-3">24,588</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <!--begin::label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>4.1%</span>
                                    <!--end::label-->
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-sms fs-3 text-gray-600">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Container-->
                            <div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                                <!--begin::Content-->
                                <div class="me-5">
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Email Newsletter</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Mailchimp Campaigns</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <!--begin::label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>0.2%</span>
                                    <!--end::label-->
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-icon fs-3 text-gray-600">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Container-->
                            <div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                                <!--begin::Content-->
                                <div class="me-5">
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Referrals</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Impact Radius visits</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-4 me-3">6,578</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <!--begin::label-->
                                    <span class="badge badge-light-danger fs-base">
                                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>0.4%</span>
                                    <!--end::label-->
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-abstract-25 fs-3 text-gray-600">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Container-->
                            <div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                                <!--begin::Content-->
                                <div class="me-5">
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Other</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Many Sources</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-4 me-3">79,458</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <!--begin::label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>8.3%</span>
                                    <!--end::label-->
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-abstract-39 fs-3 text-gray-600">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Container-->
                            <div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                                <!--begin::Content-->
                                <div class="me-5">
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Rising Networks</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social Network</span>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Number-->
                                    <span class="text-gray-800 fw-bold fs-4 me-3">18,047</span>
                                    <!--end::Number-->
                                    <!--begin::Info-->
                                    <!--begin::label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>1.9%</span>
                                    <!--end::label-->
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 12-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-0">
            <!--begin::Chart widget 30-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7 mb-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Stats by Department</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">8k social visitors</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">PDF Report</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Items-->
                    <div class="d-flex flex-wrap d-grid gap-5 mb-10">
                        <!--begin::Item-->
                        <div class="border-end-dashed border-end border-gray-300 pe-xxl-7 me-xxl-5">
                            <!--begin::Statistics-->
                            <div class="d-flex mb-2">
                                <span class="fs-4 fw-semibold text-gray-500 me-1">$</span>
                                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">8,035</span>
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Description-->
                            <span class="fs-6 fw-semibold text-gray-500">Actual for April</span>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="m-0">
                            <!--begin::Statistics-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Currency-->
                                <span class="fs-4 fw-semibold text-gray-500 align-self-start me-1">$</span>
                                <!--end::Currency-->
                                <!--begin::Value-->
                                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">4,684</span>
                                <!--end::Value-->
                                <!--begin::Label-->
                                <span class="badge badge-light-success fs-base">
                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>4.5%</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Description-->
                            <span class="fs-6 fw-semibold text-gray-500">GAP</span>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Items-->
                    <!--begin::Chart container-->
                    <div id="kt_charts_widget_30_chart" class="w-100 h-200px"></div>
                    <!--end::Chart container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 30-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Modal - Create Lead-->
    <div class="modal fade" id="kt_modal_create_lead" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        {!! getIcon('cross', 'fs-1') !!}
                    </div>
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_create_lead_form" class="form" method="POST" action="{{ route('leads.store') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center">
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                <i class="ki-duotone ki-information fs-2tx text-primary me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">Create New Lead</h4>
                                        <div class="fs-6 text-gray-700">Fill out the form to create new lead!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Accordion-->
                        <div class="accordion" id="leadAccordion">
                            <!--begin::Lead Information-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="leadInfoHeader">
                                    <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#leadInfoCollapse" aria-expanded="true" aria-controls="leadInfoCollapse">
                                        Lead Information
                                    </button>
                                </h2>
                                <div id="leadInfoCollapse" class="accordion-collapse collapse show" aria-labelledby="leadInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-4 mt-3">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                        <span class="required">Lead Owner</span>
                                                    </label>
                                                    <select class="form-select" name="owner_id" required>
                                                        <option value="">Select Lead Owner</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('owner_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Sales Representative</label>
                                                    <select class="form-select" name="sale_representative">
                                                        <option value="">--- Select a User ---</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sale_representative')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Lead Source</label>
                                                    <select class="form-select" name="lead_source_id">
                                                        <option value="">--- Select Lead Source ---</option>
                                                        @foreach($sources as $source)
                                                        <option value="{{$source->id}}">{{$source->source_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lead_source_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" required />
                                                    @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" required />
                                                    @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Mobile</label>
                                                    <input type="text" class="form-control" name="mobile" minlength="11" maxlength="15" required />
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Phone</label>
                                                    <input type="text" class="form-control" minlength="11" maxlength="15" name="phone" />
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Email</label>
                                                    <input type="email" class="form-control" name="email" required />
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Utility Company</label>
                                                    <select class="form-select" name="utility_company_id">
                                                        <option value="">Choose</option>
                                                        @foreach($utilitycompanies as $utilitycompany)
                                                        <option value="{{$utilitycompany->id}}">{{$utilitycompany->utility_company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('utility_company_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Call Center Representative</label>
                                                    <select class="form-select" name="call_center_representative">
                                                        <option value="">--- Select a User ---</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('call_center_representative')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold">Lead Status</label>
                                                    <select class="form-select" name="lead_status" required>
                                                        <option value="">--- Choose a Status ---</option>
                                                        <option selected value="1">Fresh</option>
                                                        <option value="2">Site Survey</option>
                                                        <option value="3">Engineering Design</option>
                                                        <option value="4">Proposal</option>
                                                        <option value="5">System Details Finalized</option>
                                                        <option value="6">PO Received</option>
                                                        <option value="7">Cold</option>
                                                    </select>
                                                    @error('lead_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="fs-row mt-4">
                                                    <div class="me-5">
                                                        <label class="btn btn-outline btn-outline-primary btn-sm mb-3 fs-5 fw-semibold"><input type="checkbox" id="appointment_sat" name="appointment_sat" value="1"> Schedule a meeting</label>
                                                        <div class="fs-7 fw-semibold text-muted">Check the box if you want to schedule a meeting with customer</div>
                                                    </div>
                                                    @error('appointment_sat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 appointment_fields">
                                                    <label class="fs-6 fw-semibold mt-3">Select Appointment Date</label>
                                                    <input type="date" class="form-control" name="appointment_date" />
                                                    @error('appointment_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 appointment_fields">
                                                    <label class="fs-6 fw-semibold mt-3">Select Appointment Time</label>
                                                    <input type="time" class="form-control" name="appointment_time" />
                                                    @error('appointment_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 appointment_fields">
                                                    <label class="fs-6 fw-semibold mt-3">Appointment Notes</label>
                                                    <textarea placeholder="Write appointment notes ..." class="form-control" rows="3" name="appointment_notes"></textarea>
                                                    @error('appointment_notes')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Lead Information-->

                            <!--begin::Address Information-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="addressInfoHeader">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addressInfoCollapse" aria-expanded="false" aria-controls="addressInfoCollapse">
                                        Address Information
                                    </button>
                                </h2>
                                <div id="addressInfoCollapse" class="accordion-collapse collapse" aria-labelledby="addressInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-4 mt-3">
                                                <label class="required fs-6 fw-semibold ">Country</label>
                                                <select name="country" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a Country..." class="form-select">
                                                    <option value="">Select a Country...</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Aland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="KR">South Korea</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Vietnam</option>
                                                    <option value="VI">Virgin Islands</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                                @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                                <input type="text" class="form-control" name="address1" requried/>
                                                @error('address1')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">Address Line 2</label>
                                                <input type="text" class="form-control" name="address2" />
                                                @error('address2')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">Street</label>
                                                <input type="text" class="form-control" name="street" />
                                                @error('street')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">City</label>
                                                <input type="text" class="form-control" name="city" />
                                                @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">State / Province</label>
                                                <input type="text" class="form-control" name="state" />
                                                @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">Post Code</label>
                                                <input type="text" class="form-control" name="zip" />
                                                @error('zip')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Address Information-->

                            <!--begin::Description Information-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="descriptionInfoHeader">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#descriptionInfoCollapse" aria-expanded="false" aria-controls="descriptionInfoCollapse">
                                        Lead Information & Notes
                                    </button>
                                </h2>
                                <div id="descriptionInfoCollapse" class="accordion-collapse collapse" aria-labelledby="descriptionInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
                                        <div class="fv-row">
                                            <label class="fs-6 fw-semibold ">Notes</label>
                                            <textarea placeholder="Write any extra notes ..." class="form-control" rows="3" name="notes"></textarea>
                                            @error('notes')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">
                                <span class="indicator-label">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit Lead</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Lead-->
    @include('partials/modals/adwords-terms')

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Initially hide the appointment date and time fields
            $('.appointment_fields').hide();
            
            // Show/Hide appointment date and time based on checkbox
            $('#appointment_sat').change(function() {
                $('input[name="appointment_date"]').val('');
                $('input[name="appointment_time"]').val('');
                if ($(this).is(':checked')) {
                    $('.appointment_fields').show();
                } else {
                    $('.appointment_fields').hide();
                }
            });
        });
    </script>
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <!--end::Vendors Javascript-->
    @endpush
</x-default-layout>