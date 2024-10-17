<x-default-layout>

    @section('title')
    Billing
    @endsection

    <div class="card">
    @if (session('success'))
            <div class="row">
                <div class="alert alert-success text-center">{{session('success')}}</div>
            </div>
        @elseif (session('error'))
            <div class="row">
                <div class="alert alert-danger text-center">{{session('error')}}</div>
            </div>
        @endif
                                
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Plans-->
            <div class="d-flex flex-column">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bold mb-5">Choose Your Plan</h1>
                </div>
                <!--end::Heading-->
                <!--begin::Row-->
                    <div class="row g-10">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-gray-900 mb-5 fw-bolder">Basic</h1>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="text-gray-600 fw-semibold mb-5">Optimal for 1-5 member size
                                        <br />and new startup</div>
                                        <!--end::Description-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bold text-primary">15</span>
                                            <span class="fs-7 fw-semibold opacity-50">/ 
                                            <span data-kt-element="period">Mon</span></span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Features-->
                                    <div class="w-100 mb-10">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 1-5 Active Users</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Lead Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Calendar Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Appointment Module</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Deal Module</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Analytics and Reports</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Monthly Update Features</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Full Access To CRM</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Features-->
                                    <!--begin::Select-->
                                    <a href="{{ route('subscription.StripeCheckout', ['plan' => 'price_1Q7IocLaW8b3mxPpiwNdtXH2']) }}" class="btn btn-sm btn-primary">Select</a>
                                    <!--end::Select-->
                                </div>
                                <!--end::Option-->
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-gray-900 mb-5 fw-bolder">Deluxe</h1>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="text-gray-600 fw-semibold mb-5">Optimal for 5-10 member size
                                        <br />and growing companies</div>
                                        <!--end::Description-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bold text-primary">35</span>
                                            <span class="fs-7 fw-semibold opacity-50">/ 
                                            <span data-kt-element="period">Mon</span></span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Features-->
                                    <div class="w-100 mb-10">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 5-10 Active Users</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Lead Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Calendar Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Appointment Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Analytics and Reports</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Deal Module</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Monthly Update Features</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Full Access To CRM</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Features-->
                                    <!--begin::Select-->
                                    <a href="{{ route('subscription.StripeCheckout', ['plan' => 'price_1Q7Ip5LaW8b3mxPp0j6a0bGA']) }}" class="btn btn-sm btn-primary">Select</a>
                                    <!--end::Select-->
                                </div>
                                <!--end::Option-->
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-gray-900 mb-5 fw-bolder">Exclusive</h1>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="text-gray-600 fw-semibold mb-5">Optimal for 10-50 member size
                                        <br />and large organizations</div>
                                        <!--end::Description-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bold text-primary">50</span>
                                            <span class="fs-7 fw-semibold opacity-50">/ 
                                            <span data-kt-element="period">Mon</span></span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Features-->
                                    <div class="w-100 mb-10">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 10-50 Active Users</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Full Access To CRM</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Monthly Update Features</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Analytics and Reports</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Lead Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Calendar Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Appointment Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Deal Module</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Features-->
                                    <!--begin::Select-->
                                    <a href="{{ route('subscription.StripeCheckout', ['plan' => 'price_1Q7IpiLaW8b3mxPpV8h0r2fO']) }}" class="btn btn-sm btn-primary">Select</a>
                                    <!--end::Select-->
                                </div>
                                <!--end::Option-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

            </div>
            <!--end::Plans-->
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>