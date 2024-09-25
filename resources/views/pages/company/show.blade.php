<x-default-layout>

    @section('title')
    View Company Details
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('companies.show', $company) }}
    @endsection
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $company->name }}</h2>
                            <div class="fs-6 fw-semibold text-muted"> Company details for {{ $company->name }}</div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">
                        <div class="separator"></div>
                        <div class="row">
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Company ID</div>
                                        <div class="text-gray-600">{{ $company->id }}</div>
                                        <div class="fw-bold mt-5">Company Name</div>
                                        <div class="text-gray-600">{{ $company->name }}</div>
                                        <div class="fw-bold mt-5">Address</div>
                                        <div class="text-gray-600">{{ $company->address }}</div>
                                        <div class="fw-bold mt-5">Phone</div>
                                        <div class="text-gray-600">{{ $company->phone }}</div>
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">{{ $company->email }}</div>
                                        <div class="fw-bold mt-5">Description</div>
                                        <div class="text-gray-600">{{ $company->description }}</div>
                                        <div class="fw-bold mt-5">Created At</div>
                                        <div class="text-gray-600">{{ \Carbon\Carbon::parse($company->created_at)->format('d F Y, g:i a') }}</div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
</x-default-layout>