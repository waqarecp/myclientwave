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
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{$countLeads}}</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <!-- <span class="badge badge-light-danger fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-danger ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>8.02%</span> -->
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Total Leads</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar d-none">
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
                    <input type="hidden" id="lead_data" value='{{ $leadData }}' />
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
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{$countAppointments}}</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <!-- <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>2.2%</span> -->
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Total Appointments</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar d-none">
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
                <input type="hidden" id="appointment_data" value='{{ $appointmentData }}' />
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
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{$countLeads}}</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <!-- <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>2.2%</span> -->
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">Lead By Sources</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar d-none">
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
                <input type="hidden" id="lead_source_data" value='' />
                <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
                    <!--begin::Item-->
                    @foreach($leadSources as $leadSource)
                    <div class="d-flex flex-stack">
                        <div class="symbol symbol-30px me-5">
                            <span class="symbol-label">
                                <i class="ki-duotone ki-rocket fs-3 text-gray-600">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                            <!--begin::Content-->
                            <div class="me-5">
                                <!--begin::Title-->
                                <b class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $leadSource['source_name'] }}</b>
                                <!--end::Title-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Total Leads</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center">
                                <!--begin::Number-->
                                <span class="text-gray-800 fw-bold fs-4 me-3">{{ $leadSource['count'] }}</span>
                                <!--end::Number-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Section-->
                    </div>
                    @endforeach

                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--end::Separator-->
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
                                                    <select class="form-select" name="owner_id" id="owner_id" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a Owner" required>
                                                        <option value="">Select Lead Owner</option>
                                                        @foreach($roles as $role)
                                                        <optgroup label="{{ ucwords($role->name) }}">
                                                            @foreach($users as $user)
                                                            @if($user->roles->contains($role))
                                                            <option data-child-users="{{ $user->child_users }}" value="{{ $user->id }}">
                                                                {{ $user->name }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </optgroup>
                                                        @endforeach
                                                    </select>
                                                    @error('owner_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold">Sales Representative</label>
                                                    <select class="form-select" name="sale_representative" id="sale_representative" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a Representative" disabled required>
                                                        <option value="">--- Select a User ---</option>
                                                        @foreach($roles as $role)
                                                        <optgroup label="{{ ucwords($role->name) }}">
                                                            @foreach($users as $user)
                                                            @if($user->roles->contains($role))
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </optgroup>
                                                        @endforeach
                                                    </select>
                                                    @error('sale_representative')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Lead Source</label>
                                                    <select class="form-select" name="lead_source_id" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a source" required>
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
                                                    <input type="text" class="form-control" minlength="5" maxlength="25" name="phone" required />
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
                                                    <select class="form-select" name="utility_company_id" id="utility_company_id" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a Company">
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
                                                    <select class="form-select" name="call_center_representative" id="call_center_representative" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a User" disabled>
                                                        <option value="">--- Select a User ---</option>
                                                        @foreach($roles as $role)
                                                        <optgroup label="{{ ucwords($role->name) }}">
                                                            @foreach($users as $user)
                                                            @if($user->roles->contains($role))
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </optgroup>
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
                                                <select class="form-select form-select-solid" name="country_id" onchange="getStates(this)" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a country">
                                                    <option>Select a country</option>
                                                    @foreach($countries as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">State / Province</label>
                                                <select class="form-select" id="state_id" name="state_id" onchange="getCities(this)" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a state"></select>
                                                @error('state_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">City</label>
                                                <select class="form-control" name="city_id" data-control="select2" data-dropdown-parent="#kt_modal_create_lead" data-placeholder="Select a city"></select>
                                                @error('city_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                                <input type="text" class="form-control" name="address1" requried />
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
        function getStates(element) {
            var countryId = $(element).val();
            var stateDropdown = $('select[name="state_id"]');
            var cityDropdown = $('select[name="city_id"]');
            stateDropdown.empty();
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getStates') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    countryId: countryId,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.empty(); // Clear existing options
                    stateDropdown.select2({
                        dropdownParent: $('#kt_modal_create_lead') // Ensure dropdown appends to modal
                    });

                    // Populate states dropdown with color data attributes
                    $.each(data.states, function(index, state) {
                        var option = $('<option></option>')
                            .val(state.id)
                            .text(state.name)
                            .attr('data-color', state.color_code); // Set data-color attribute

                        stateDropdown.append(option);
                    });

                    // Re-initialize Select2 for #state_id to apply the formatting
                    stateDropdown.select2({
                        templateResult: formatStateColour,
                        templateSelection: formatStateColour,
                        dropdownParent: $('#kt_modal_create_lead') // Ensure dropdown appends to modal
                    });
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        // Function to format Select2 options with color
        function formatStateColour(state) {
            if (!state.id) {
                return state.text;
            }

            var color = $(state.element).data('color'); // Get the color from the data attribute

            // Create the formatted state element with a color badge
            var $state = $(
                '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + state.text + '</span>'
            );

            return $state;
        }

        function getCities(element) {
            var stateId = $(element).val();
            var cityDropdown = $('select[name="city_id"]');
            $.ajax({
                url: "{{ route('leads.getCities') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    stateId: stateId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    cityDropdown.empty(); // Clear existing options

                    // Populate states dropdown
                    $.each(data.states, function(key, value) {
                        cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to get cities for this states!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        function ucwords(str) {
            return str.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
        }
        $(document).ready(function() {
            $('#owner_id').on('change', function() {
                var childUsers = $('#owner_id option:selected').data('child-users');
                var allUsers = @json($users); // Assuming $users includes role relationship

                // Clear existing options except the first one and keep the structure intact
                $('#sale_representative optgroup, #call_center_representative optgroup').remove();

                if (!childUsers || childUsers === "") {
                    // If no child users, enable and populate with all users grouped by role
                    $('#sale_representative, #call_center_representative').prop('disabled', false);

                    // Group users by roles
                    var usersByRole = {};
                    allUsers.forEach(function(user) {
                        var roleName = ucwords(user.roles[0].name); // Assuming each user has a single role
                        if (!usersByRole[roleName]) {
                            usersByRole[roleName] = [];
                        }
                        usersByRole[roleName].push(user);
                    });

                    // Append users grouped by roles
                    $.each(usersByRole, function(roleName, users) {
                        if (users.length > 0) {
                            var optgroup = $('<optgroup>', {
                                label: roleName
                            });
                            users.forEach(function(user) {
                                optgroup.append($('<option>', {
                                    value: user.id,
                                    text: user.name
                                }));
                            });
                            $('#sale_representative, #call_center_representative').append(optgroup);
                        }
                    });

                } else {
                    // If there are child users, enable and populate with specific users grouped by role
                    var childUserIds = childUsers.toString().split(',');

                    $('#sale_representative, #call_center_representative').prop('disabled', false);

                    // Filter child users by their role
                    var usersByRole = {};
                    childUserIds.forEach(function(userId) {
                        var user = allUsers.find(u => u.id == userId);
                        if (user) {
                            var roleName = ucwords(user.roles[0].name); // Assuming each user has a single role
                            if (!usersByRole[roleName]) {
                                usersByRole[roleName] = [];
                            }
                            usersByRole[roleName].push(user);
                        }
                    });

                    // Append users grouped by roles
                    $.each(usersByRole, function(roleName, users) {
                        if (users.length > 0) {
                            var optgroup = $('<optgroup>', {
                                label: roleName
                            });
                            users.forEach(function(user) {
                                optgroup.append($('<option>', {
                                    value: user.id,
                                    text: user.name
                                }));
                            });
                            $('#sale_representative, #call_center_representative').append(optgroup);
                        }
                    });
                }
            });
        });


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
                    '<span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color:' + $(state.element).data('color') + '"></span>' + state.text + '</span>'
                );
                return $state;
            }

            // Re-initialize Select2 when the modal is shown
            $('#kt_modal_create_lead').on('shown.bs.modal', function() {
                $('#status_id').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                    dropdownParent: $('#kt_modal_create_lead') // Ensure dropdown appends to modal
                });
                // Initialize Select2 for #state_id on page load and when modal is shown
                $('#state_id').select2({
                    templateResult: formatStateColour,
                    templateSelection: formatStateColour,
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
    <script src="{{asset('assets/js/custom/apps/ecommerce/settings/settings.js')}}"></script>
    <!--end::Vendors Javascript-->
    @endpush
</x-default-layout>