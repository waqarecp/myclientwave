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
                                                    <select class="form-select" name="sale_representative" required>
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
                                                    <select class="form-select" name="lead_source_id" required>
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
                                                    <label class="required fs-6 fw-semibold ">Mobile</label>
                                                    <input type="text" class="form-control" name="mobile" />
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Phone</label>
                                                    <input type="text" class="form-control" minlength="5" maxlength="25" name="phone" required/>
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Email</label>
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
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="fw-semibold">Tag users in comment</label>
                                                <select onchange="selectAll(this)" id="tag_users" name="user_ids[]" class="form-select select2" data-control="select2" data-search="true" multiple>
                                                        <option value="all">Tag All Users</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{ucwords($user->name)}}</option>
                                                        @endforeach
                                                </select>
                                                @error('user_ids')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="fs-6 fw-semibold ">Notes</label>
                                                <textarea placeholder="Write any extra notes ..." class="form-control" rows="3" name="notes" id="lead_notes"></textarea>
                                                @error('notes')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                <select id="kt_ecommerce_select2_country" class="form-select form-select-solid" name="country" data-kt-ecommerce-settings-type="select2_flags" data-placeholder="Select a country">
                                                    <option></option>
                                                    <option value="AF" data-kt-select2-country="assets/media/flags/afghanistan.svg">Afghanistan</option>
                                                    <option value="AX" data-kt-select2-country="assets/media/flags/aland-islands.svg">Aland Islands</option>
                                                    <option value="AL" data-kt-select2-country="assets/media/flags/albania.svg">Albania</option>
                                                    <option value="DZ" data-kt-select2-country="assets/media/flags/algeria.svg">Algeria</option>
                                                    <option value="AS" data-kt-select2-country="assets/media/flags/american-samoa.svg">American Samoa</option>
                                                    <option value="AD" data-kt-select2-country="assets/media/flags/andorra.svg">Andorra</option>
                                                    <option value="AO" data-kt-select2-country="assets/media/flags/angola.svg">Angola</option>
                                                    <option value="AI" data-kt-select2-country="assets/media/flags/anguilla.svg">Anguilla</option>
                                                    <option value="AG" data-kt-select2-country="assets/media/flags/antigua-and-barbuda.svg">Antigua and Barbuda</option>
                                                    <option value="AR" data-kt-select2-country="assets/media/flags/argentina.svg">Argentina</option>
                                                    <option value="AM" data-kt-select2-country="assets/media/flags/armenia.svg">Armenia</option>
                                                    <option value="AW" data-kt-select2-country="assets/media/flags/aruba.svg">Aruba</option>
                                                    <option value="AU" data-kt-select2-country="assets/media/flags/australia.svg">Australia</option>
                                                    <option value="AT" data-kt-select2-country="assets/media/flags/austria.svg">Austria</option>
                                                    <option value="AZ" data-kt-select2-country="assets/media/flags/azerbaijan.svg">Azerbaijan</option>
                                                    <option value="BS" data-kt-select2-country="assets/media/flags/bahamas.svg">Bahamas</option>
                                                    <option value="BH" data-kt-select2-country="assets/media/flags/bahrain.svg">Bahrain</option>
                                                    <option value="BD" data-kt-select2-country="assets/media/flags/bangladesh.svg">Bangladesh</option>
                                                    <option value="BB" data-kt-select2-country="assets/media/flags/barbados.svg">Barbados</option>
                                                    <option value="BY" data-kt-select2-country="assets/media/flags/belarus.svg">Belarus</option>
                                                    <option value="BE" data-kt-select2-country="assets/media/flags/belgium.svg">Belgium</option>
                                                    <option value="BZ" data-kt-select2-country="assets/media/flags/belize.svg">Belize</option>
                                                    <option value="BJ" data-kt-select2-country="assets/media/flags/benin.svg">Benin</option>
                                                    <option value="BM" data-kt-select2-country="assets/media/flags/bermuda.svg">Bermuda</option>
                                                    <option value="BT" data-kt-select2-country="assets/media/flags/bhutan.svg">Bhutan</option>
                                                    <option value="BO" data-kt-select2-country="assets/media/flags/bolivia.svg">Bolivia, Plurinational State of</option>
                                                    <option value="BQ" data-kt-select2-country="assets/media/flags/bonaire.svg">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA" data-kt-select2-country="assets/media/flags/bosnia-and-herzegovina.svg">Bosnia and Herzegovina</option>
                                                    <option value="BW" data-kt-select2-country="assets/media/flags/botswana.svg">Botswana</option>
                                                    <option value="BR" data-kt-select2-country="assets/media/flags/brazil.svg">Brazil</option>
                                                    <option value="IO" data-kt-select2-country="assets/media/flags/british-indian-ocean-territory.svg">British Indian Ocean Territory</option>
                                                    <option value="BN" data-kt-select2-country="assets/media/flags/brunei.svg">Brunei Darussalam</option>
                                                    <option value="BG" data-kt-select2-country="assets/media/flags/bulgaria.svg">Bulgaria</option>
                                                    <option value="BF" data-kt-select2-country="assets/media/flags/burkina-faso.svg">Burkina Faso</option>
                                                    <option value="BI" data-kt-select2-country="assets/media/flags/burundi.svg">Burundi</option>
                                                    <option value="KH" data-kt-select2-country="assets/media/flags/cambodia.svg">Cambodia</option>
                                                    <option value="CM" data-kt-select2-country="assets/media/flags/cameroon.svg">Cameroon</option>
                                                    <option value="CA" data-kt-select2-country="assets/media/flags/canada.svg">Canada</option>
                                                    <option value="CV" data-kt-select2-country="assets/media/flags/cape-verde.svg">Cape Verde</option>
                                                    <option value="KY" data-kt-select2-country="assets/media/flags/cayman-islands.svg">Cayman Islands</option>
                                                    <option value="CF" data-kt-select2-country="assets/media/flags/central-african-republic.svg">Central African Republic</option>
                                                    <option value="TD" data-kt-select2-country="assets/media/flags/chad.svg">Chad</option>
                                                    <option value="CL" data-kt-select2-country="assets/media/flags/chile.svg">Chile</option>
                                                    <option value="CN" data-kt-select2-country="assets/media/flags/china.svg">China</option>
                                                    <option value="CX" data-kt-select2-country="assets/media/flags/christmas-island.svg">Christmas Island</option>
                                                    <option value="CC" data-kt-select2-country="assets/media/flags/cocos-island.svg">Cocos (Keeling) Islands</option>
                                                    <option value="CO" data-kt-select2-country="assets/media/flags/colombia.svg">Colombia</option>
                                                    <option value="KM" data-kt-select2-country="assets/media/flags/comoros.svg">Comoros</option>
                                                    <option value="CK" data-kt-select2-country="assets/media/flags/cook-islands.svg">Cook Islands</option>
                                                    <option value="CR" data-kt-select2-country="assets/media/flags/costa-rica.svg">Costa Rica</option>
                                                    <option value="CI" data-kt-select2-country="assets/media/flags/ivory-coast.svg">Côte d'Ivoire</option>
                                                    <option value="HR" data-kt-select2-country="assets/media/flags/croatia.svg">Croatia</option>
                                                    <option value="CU" data-kt-select2-country="assets/media/flags/cuba.svg">Cuba</option>
                                                    <option value="CW" data-kt-select2-country="assets/media/flags/curacao.svg">Curaçao</option>
                                                    <option value="CZ" data-kt-select2-country="assets/media/flags/czech-republic.svg">Czech Republic</option>
                                                    <option value="DK" data-kt-select2-country="assets/media/flags/denmark.svg">Denmark</option>
                                                    <option value="DJ" data-kt-select2-country="assets/media/flags/djibouti.svg">Djibouti</option>
                                                    <option value="DM" data-kt-select2-country="assets/media/flags/dominica.svg">Dominica</option>
                                                    <option value="DO" data-kt-select2-country="assets/media/flags/dominican-republic.svg">Dominican Republic</option>
                                                    <option value="EC" data-kt-select2-country="assets/media/flags/ecuador.svg">Ecuador</option>
                                                    <option value="EG" data-kt-select2-country="assets/media/flags/egypt.svg">Egypt</option>
                                                    <option value="SV" data-kt-select2-country="assets/media/flags/el-salvador.svg">El Salvador</option>
                                                    <option value="GQ" data-kt-select2-country="assets/media/flags/equatorial-guinea.svg">Equatorial Guinea</option>
                                                    <option value="ER" data-kt-select2-country="assets/media/flags/eritrea.svg">Eritrea</option>
                                                    <option value="EE" data-kt-select2-country="assets/media/flags/estonia.svg">Estonia</option>
                                                    <option value="ET" data-kt-select2-country="assets/media/flags/ethiopia.svg">Ethiopia</option>
                                                    <option value="FK" data-kt-select2-country="assets/media/flags/falkland-islands.svg">Falkland Islands (Malvinas)</option>
                                                    <option value="FJ" data-kt-select2-country="assets/media/flags/fiji.svg">Fiji</option>
                                                    <option value="FI" data-kt-select2-country="assets/media/flags/finland.svg">Finland</option>
                                                    <option value="FR" data-kt-select2-country="assets/media/flags/france.svg">France</option>
                                                    <option value="PF" data-kt-select2-country="assets/media/flags/french-polynesia.svg">French Polynesia</option>
                                                    <option value="GA" data-kt-select2-country="assets/media/flags/gabon.svg">Gabon</option>
                                                    <option value="GM" data-kt-select2-country="assets/media/flags/gambia.svg">Gambia</option>
                                                    <option value="GE" data-kt-select2-country="assets/media/flags/georgia.svg">Georgia</option>
                                                    <option value="DE" data-kt-select2-country="assets/media/flags/germany.svg">Germany</option>
                                                    <option value="GH" data-kt-select2-country="assets/media/flags/ghana.svg">Ghana</option>
                                                    <option value="GI" data-kt-select2-country="assets/media/flags/gibraltar.svg">Gibraltar</option>
                                                    <option value="GR" data-kt-select2-country="assets/media/flags/greece.svg">Greece</option>
                                                    <option value="GL" data-kt-select2-country="assets/media/flags/greenland.svg">Greenland</option>
                                                    <option value="GD" data-kt-select2-country="assets/media/flags/grenada.svg">Grenada</option>
                                                    <option value="GU" data-kt-select2-country="assets/media/flags/guam.svg">Guam</option>
                                                    <option value="GT" data-kt-select2-country="assets/media/flags/guatemala.svg">Guatemala</option>
                                                    <option value="GG" data-kt-select2-country="assets/media/flags/guernsey.svg">Guernsey</option>
                                                    <option value="GN" data-kt-select2-country="assets/media/flags/guinea.svg">Guinea</option>
                                                    <option value="GW" data-kt-select2-country="assets/media/flags/guinea-bissau.svg">Guinea-Bissau</option>
                                                    <option value="HT" data-kt-select2-country="assets/media/flags/haiti.svg">Haiti</option>
                                                    <option value="VA" data-kt-select2-country="assets/media/flags/vatican-city.svg">Holy See (Vatican City State)</option>
                                                    <option value="HN" data-kt-select2-country="assets/media/flags/honduras.svg">Honduras</option>
                                                    <option value="HK" data-kt-select2-country="assets/media/flags/hong-kong.svg">Hong Kong</option>
                                                    <option value="HU" data-kt-select2-country="assets/media/flags/hungary.svg">Hungary</option>
                                                    <option value="IS" data-kt-select2-country="assets/media/flags/iceland.svg">Iceland</option>
                                                    <option value="IN" data-kt-select2-country="assets/media/flags/india.svg">India</option>
                                                    <option value="ID" data-kt-select2-country="assets/media/flags/indonesia.svg">Indonesia</option>
                                                    <option value="IR" data-kt-select2-country="assets/media/flags/iran.svg">Iran, Islamic Republic of</option>
                                                    <option value="IQ" data-kt-select2-country="assets/media/flags/iraq.svg">Iraq</option>
                                                    <option value="IE" data-kt-select2-country="assets/media/flags/ireland.svg">Ireland</option>
                                                    <option value="IM" data-kt-select2-country="assets/media/flags/isle-of-man.svg">Isle of Man</option>
                                                    <option value="IL" data-kt-select2-country="assets/media/flags/israel.svg">Israel</option>
                                                    <option value="IT" data-kt-select2-country="assets/media/flags/italy.svg">Italy</option>
                                                    <option value="JM" data-kt-select2-country="assets/media/flags/jamaica.svg">Jamaica</option>
                                                    <option value="JP" data-kt-select2-country="assets/media/flags/japan.svg">Japan</option>
                                                    <option value="JE" data-kt-select2-country="assets/media/flags/jersey.svg">Jersey</option>
                                                    <option value="JO" data-kt-select2-country="assets/media/flags/jordan.svg">Jordan</option>
                                                    <option value="KZ" data-kt-select2-country="assets/media/flags/kazakhstan.svg">Kazakhstan</option>
                                                    <option value="KE" data-kt-select2-country="assets/media/flags/kenya.svg">Kenya</option>
                                                    <option value="KI" data-kt-select2-country="assets/media/flags/kiribati.svg">Kiribati</option>
                                                    <option value="KP" data-kt-select2-country="assets/media/flags/north-korea.svg">Korea, Democratic People's Republic of</option>
                                                    <option value="KW" data-kt-select2-country="assets/media/flags/kuwait.svg">Kuwait</option>
                                                    <option value="KG" data-kt-select2-country="assets/media/flags/kyrgyzstan.svg">Kyrgyzstan</option>
                                                    <option value="LA" data-kt-select2-country="assets/media/flags/laos.svg">Lao People's Democratic Republic</option>
                                                    <option value="LV" data-kt-select2-country="assets/media/flags/latvia.svg">Latvia</option>
                                                    <option value="LB" data-kt-select2-country="assets/media/flags/lebanon.svg">Lebanon</option>
                                                    <option value="LS" data-kt-select2-country="assets/media/flags/lesotho.svg">Lesotho</option>
                                                    <option value="LR" data-kt-select2-country="assets/media/flags/liberia.svg">Liberia</option>
                                                    <option value="LY" data-kt-select2-country="assets/media/flags/libya.svg">Libya</option>
                                                    <option value="LI" data-kt-select2-country="assets/media/flags/liechtenstein.svg">Liechtenstein</option>
                                                    <option value="LT" data-kt-select2-country="assets/media/flags/lithuania.svg">Lithuania</option>
                                                    <option value="LU" data-kt-select2-country="assets/media/flags/luxembourg.svg">Luxembourg</option>
                                                    <option value="MO" data-kt-select2-country="assets/media/flags/macao.svg">Macao</option>
                                                    <option value="MG" data-kt-select2-country="assets/media/flags/madagascar.svg">Madagascar</option>
                                                    <option value="MW" data-kt-select2-country="assets/media/flags/malawi.svg">Malawi</option>
                                                    <option value="MY" data-kt-select2-country="assets/media/flags/malaysia.svg">Malaysia</option>
                                                    <option value="MV" data-kt-select2-country="assets/media/flags/maldives.svg">Maldives</option>
                                                    <option value="ML" data-kt-select2-country="assets/media/flags/mali.svg">Mali</option>
                                                    <option value="MT" data-kt-select2-country="assets/media/flags/malta.svg">Malta</option>
                                                    <option value="MH" data-kt-select2-country="assets/media/flags/marshall-island.svg">Marshall Islands</option>
                                                    <option value="MQ" data-kt-select2-country="assets/media/flags/martinique.svg">Martinique</option>
                                                    <option value="MR" data-kt-select2-country="assets/media/flags/mauritania.svg">Mauritania</option>
                                                    <option value="MU" data-kt-select2-country="assets/media/flags/mauritius.svg">Mauritius</option>
                                                    <option value="MX" data-kt-select2-country="assets/media/flags/mexico.svg">Mexico</option>
                                                    <option value="FM" data-kt-select2-country="assets/media/flags/micronesia.svg">Micronesia, Federated States of</option>
                                                    <option value="MD" data-kt-select2-country="assets/media/flags/moldova.svg">Moldova, Republic of</option>
                                                    <option value="MC" data-kt-select2-country="assets/media/flags/monaco.svg">Monaco</option>
                                                    <option value="MN" data-kt-select2-country="assets/media/flags/mongolia.svg">Mongolia</option>
                                                    <option value="ME" data-kt-select2-country="assets/media/flags/montenegro.svg">Montenegro</option>
                                                    <option value="MS" data-kt-select2-country="assets/media/flags/montserrat.svg">Montserrat</option>
                                                    <option value="MA" data-kt-select2-country="assets/media/flags/morocco.svg">Morocco</option>
                                                    <option value="MZ" data-kt-select2-country="assets/media/flags/mozambique.svg">Mozambique</option>
                                                    <option value="MM" data-kt-select2-country="assets/media/flags/myanmar.svg">Myanmar</option>
                                                    <option value="NA" data-kt-select2-country="assets/media/flags/namibia.svg">Namibia</option>
                                                    <option value="NR" data-kt-select2-country="assets/media/flags/nauru.svg">Nauru</option>
                                                    <option value="NP" data-kt-select2-country="assets/media/flags/nepal.svg">Nepal</option>
                                                    <option value="NL" data-kt-select2-country="assets/media/flags/netherlands.svg">Netherlands</option>
                                                    <option value="NZ" data-kt-select2-country="assets/media/flags/new-zealand.svg">New Zealand</option>
                                                    <option value="NI" data-kt-select2-country="assets/media/flags/nicaragua.svg">Nicaragua</option>
                                                    <option value="NE" data-kt-select2-country="assets/media/flags/niger.svg">Niger</option>
                                                    <option value="NG" data-kt-select2-country="assets/media/flags/nigeria.svg">Nigeria</option>
                                                    <option value="NU" data-kt-select2-country="assets/media/flags/niue.svg">Niue</option>
                                                    <option value="NF" data-kt-select2-country="assets/media/flags/norfolk-island.svg">Norfolk Island</option>
                                                    <option value="MP" data-kt-select2-country="assets/media/flags/northern-mariana-islands.svg">Northern Mariana Islands</option>
                                                    <option value="NO" data-kt-select2-country="assets/media/flags/norway.svg">Norway</option>
                                                    <option value="OM" data-kt-select2-country="assets/media/flags/oman.svg">Oman</option>
                                                    <option value="PK" data-kt-select2-country="assets/media/flags/pakistan.svg">Pakistan</option>
                                                    <option value="PW" data-kt-select2-country="assets/media/flags/palau.svg">Palau</option>
                                                    <option value="PS" data-kt-select2-country="assets/media/flags/palestine.svg">Palestinian Territory, Occupied</option>
                                                    <option value="PA" data-kt-select2-country="assets/media/flags/panama.svg">Panama</option>
                                                    <option value="PG" data-kt-select2-country="assets/media/flags/papua-new-guinea.svg">Papua New Guinea</option>
                                                    <option value="PY" data-kt-select2-country="assets/media/flags/paraguay.svg">Paraguay</option>
                                                    <option value="PE" data-kt-select2-country="assets/media/flags/peru.svg">Peru</option>
                                                    <option value="PH" data-kt-select2-country="assets/media/flags/philippines.svg">Philippines</option>
                                                    <option value="PL" data-kt-select2-country="assets/media/flags/poland.svg">Poland</option>
                                                    <option value="PT" data-kt-select2-country="assets/media/flags/portugal.svg">Portugal</option>
                                                    <option value="PR" data-kt-select2-country="assets/media/flags/puerto-rico.svg">Puerto Rico</option>
                                                    <option value="QA" data-kt-select2-country="assets/media/flags/qatar.svg">Qatar</option>
                                                    <option value="RO" data-kt-select2-country="assets/media/flags/romania.svg">Romania</option>
                                                    <option value="RU" data-kt-select2-country="assets/media/flags/russia.svg">Russian Federation</option>
                                                    <option value="RW" data-kt-select2-country="assets/media/flags/rwanda.svg">Rwanda</option>
                                                    <option value="BL" data-kt-select2-country="assets/media/flags/st-barts.svg">Saint Barthélemy</option>
                                                    <option value="KN" data-kt-select2-country="assets/media/flags/saint-kitts-and-nevis.svg">Saint Kitts and Nevis</option>
                                                    <option value="LC" data-kt-select2-country="assets/media/flags/st-lucia.svg">Saint Lucia</option>
                                                    <option value="MF" data-kt-select2-country="assets/media/flags/sint-maarten.svg">Saint Martin (French part)</option>
                                                    <option value="VC" data-kt-select2-country="assets/media/flags/st-vincent-and-the-grenadines.svg">Saint Vincent and the Grenadines</option>
                                                    <option value="WS" data-kt-select2-country="assets/media/flags/samoa.svg">Samoa</option>
                                                    <option value="SM" data-kt-select2-country="assets/media/flags/san-marino.svg">San Marino</option>
                                                    <option value="ST" data-kt-select2-country="assets/media/flags/sao-tome-and-prince.svg">Sao Tome and Principe</option>
                                                    <option value="SA" data-kt-select2-country="assets/media/flags/saudi-arabia.svg">Saudi Arabia</option>
                                                    <option value="SN" data-kt-select2-country="assets/media/flags/senegal.svg">Senegal</option>
                                                    <option value="RS" data-kt-select2-country="assets/media/flags/serbia.svg">Serbia</option>
                                                    <option value="SC" data-kt-select2-country="assets/media/flags/seychelles.svg">Seychelles</option>
                                                    <option value="SL" data-kt-select2-country="assets/media/flags/sierra-leone.svg">Sierra Leone</option>
                                                    <option value="SG" data-kt-select2-country="assets/media/flags/singapore.svg">Singapore</option>
                                                    <option value="SX" data-kt-select2-country="assets/media/flags/sint-maarten.svg">Sint Maarten (Dutch part)</option>
                                                    <option value="SK" data-kt-select2-country="assets/media/flags/slovakia.svg">Slovakia</option>
                                                    <option value="SI" data-kt-select2-country="assets/media/flags/slovenia.svg">Slovenia</option>
                                                    <option value="SB" data-kt-select2-country="assets/media/flags/solomon-islands.svg">Solomon Islands</option>
                                                    <option value="SO" data-kt-select2-country="assets/media/flags/somalia.svg">Somalia</option>
                                                    <option value="ZA" data-kt-select2-country="assets/media/flags/south-africa.svg">South Africa</option>
                                                    <option value="KR" data-kt-select2-country="assets/media/flags/south-korea.svg">South Korea</option>
                                                    <option value="SS" data-kt-select2-country="assets/media/flags/south-sudan.svg">South Sudan</option>
                                                    <option value="ES" data-kt-select2-country="assets/media/flags/spain.svg">Spain</option>
                                                    <option value="LK" data-kt-select2-country="assets/media/flags/sri-lanka.svg">Sri Lanka</option>
                                                    <option value="SD" data-kt-select2-country="assets/media/flags/sudan.svg">Sudan</option>
                                                    <option value="SR" data-kt-select2-country="assets/media/flags/suriname.svg">Suriname</option>
                                                    <option value="SZ" data-kt-select2-country="assets/media/flags/swaziland.svg">Swaziland</option>
                                                    <option value="SE" data-kt-select2-country="assets/media/flags/sweden.svg">Sweden</option>
                                                    <option value="CH" data-kt-select2-country="assets/media/flags/switzerland.svg">Switzerland</option>
                                                    <option value="SY" data-kt-select2-country="assets/media/flags/syria.svg">Syrian Arab Republic</option>
                                                    <option value="TW" data-kt-select2-country="assets/media/flags/taiwan.svg">Taiwan, Province of China</option>
                                                    <option value="TJ" data-kt-select2-country="assets/media/flags/tajikistan.svg">Tajikistan</option>
                                                    <option value="TZ" data-kt-select2-country="assets/media/flags/tanzania.svg">Tanzania, United Republic of</option>
                                                    <option value="TH" data-kt-select2-country="assets/media/flags/thailand.svg">Thailand</option>
                                                    <option value="TG" data-kt-select2-country="assets/media/flags/togo.svg">Togo</option>
                                                    <option value="TK" data-kt-select2-country="assets/media/flags/tokelau.svg">Tokelau</option>
                                                    <option value="TO" data-kt-select2-country="assets/media/flags/tonga.svg">Tonga</option>
                                                    <option value="TT" data-kt-select2-country="assets/media/flags/trinidad-and-tobago.svg">Trinidad and Tobago</option>
                                                    <option value="TN" data-kt-select2-country="assets/media/flags/tunisia.svg">Tunisia</option>
                                                    <option value="TR" data-kt-select2-country="assets/media/flags/turkey.svg">Turkey</option>
                                                    <option value="TM" data-kt-select2-country="assets/media/flags/turkmenistan.svg">Turkmenistan</option>
                                                    <option value="TC" data-kt-select2-country="assets/media/flags/turks-and-caicos.svg">Turks and Caicos Islands</option>
                                                    <option value="TV" data-kt-select2-country="assets/media/flags/tuvalu.svg">Tuvalu</option>
                                                    <option value="UG" data-kt-select2-country="assets/media/flags/uganda.svg">Uganda</option>
                                                    <option value="UA" data-kt-select2-country="assets/media/flags/ukraine.svg">Ukraine</option>
                                                    <option value="AE" data-kt-select2-country="assets/media/flags/united-arab-emirates.svg">United Arab Emirates</option>
                                                    <option value="GB" data-kt-select2-country="assets/media/flags/united-kingdom.svg">United Kingdom</option>
                                                    <option value="US" selected data-kt-select2-country="assets/media/flags/united-states.svg">United States</option>
                                                    <option value="UY" data-kt-select2-country="assets/media/flags/uruguay.svg">Uruguay</option>
                                                    <option value="UZ" data-kt-select2-country="assets/media/flags/uzbekistan.svg">Uzbekistan</option>
                                                    <option value="VU" data-kt-select2-country="assets/media/flags/vanuatu.svg">Vanuatu</option>
                                                    <option value="VE" data-kt-select2-country="assets/media/flags/venezuela.svg">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN" data-kt-select2-country="assets/media/flags/vietnam.svg">Vietnam</option>
                                                    <option value="VI" data-kt-select2-country="assets/media/flags/virgin-islands.svg">Virgin Islands</option>
                                                    <option value="YE" data-kt-select2-country="assets/media/flags/yemen.svg">Yemen</option>
                                                    <option value="ZM" data-kt-select2-country="assets/media/flags/zambia.svg">Zambia</option>
                                                    <option value="ZW" data-kt-select2-country="assets/media/flags/zimbabwe.svg">Zimbabwe</option>
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
                                        Lead Appointment Schedule
                                    </button>
                                </h2>
                                <div id="descriptionInfoCollapse" class="accordion-collapse collapse" aria-labelledby="descriptionInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
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
                                            <div class="col-md-4 mt-3 appointment_fields">
                                                <label class="required fs-6 fw-semibold">Select an appointment status</label>
                                                <select class="form-select" name="status_id" id="status_id" required>
                                                    @foreach($statuses as $status)
                                                        <option value="{{ $status->id }}" data-color="{{ $status->color_code }}">
                                                            {{ $status->status_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('status_id')
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
                                            <div class="col-md-12 mt-3 appointment_fields">
                                                <label class="fw-semibold">Tag users in appointment comment</label>
                                                <select onchange="selectAll(this)" name="appointment_user_ids[]" id="tag_users_appointment" class="form-select select2" data-control="select2" data-search="true" multiple>
                                                        <option value="all">Tag All Users</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{ucwords($user->name)}}</option>
                                                        @endforeach
                                                </select>
                                                @error('user_ids')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 appointment_fields">
                                                <label class="fs-6 fw-semibold mt-3">Appointment Notes</label>
                                                <textarea placeholder="Write appointment notes ..." class="form-control" rows="3" name="appointment_notes" id="appointment_notes"></textarea>
                                                @error('appointment_notes')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
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

    @push('scripts')
    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
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

             // Initialize Select2 normally
             $('#status_id').select2({
                templateResult: formatState,
                templateSelection: formatState,
                dropdownParent: $('#kt_modal_create_lead') // Ensure dropdown appends to modal
            });

            // Function to format Select2 options with color
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span><span class="badge-circle" style="background-color:' + $(state.element).data('color') + '; width: 15px; height: 15px; display: inline-block; margin-right: 5px; border-radius: 50%;"></span>' + state.text + '</span>'
                );
                return $state;
            }

            // Re-initialize Select2 when the modal is shown
            $('#kt_modal_create_lead').on('shown.bs.modal', function () {
                $('#status_id').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                    dropdownParent: $('#kt_modal_create_lead') // Ensure dropdown appends to modal
                });
            });
        });

        CKEDITOR.replace('lead_notes', {
            height: '150px',
        });

        CKEDITOR.replace('appointment_notes', {
            height: '150px',
        });
        $('#tag_users, #tag_users_appointment').select2({
            placeholder: "Select users to tag", // Add placeholder
            allowClear: true // Allows clearing of the selection
        });

        function selectAll(element) {
            if ($(element).val() == 'all') {
                $(element).find("option").each(function() {
                    if ($(this).val() !== 'all') { // Exclude the option with value 'all'
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });
                $(element).find("option").trigger("change");
            }
        }
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
    <script src="{{asset('assets/js/custom/apps/ecommerce/settings/settings.js')}}"></script>
    <!--end::Vendors Javascript-->
    @endpush
</x-default-layout>