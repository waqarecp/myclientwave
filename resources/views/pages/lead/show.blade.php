<x-default-layout>

    @section('title')
    View Lead Details
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('leads.show', $lead) }}
    @endsection

    <!--begin::Layout-->
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto mb-10" style="width: 100%;">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::lead Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <div class="symbol-label fs-1 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $lead->first_name) }}">
                                {{ substr($lead->first_name, 0, 1) }}
                            </div>
                        </div>
                        <!--begin::Name-->
                        <a href="javascript:void(0)" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $lead->first_name }} {{ $lead->last_name }}</a>
                        <!--end::Name-->
                    </div>
                    <!--end::lead Info-->
                    <!--end::Summary-->
                    <div class="separator"></div>
                    <div class="row">
                        <!--begin::Details content-->
                        <div id="kt_dealer_view_details" class="collapse show col-md-6">
                            <h3>Lead information</h3>
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Lead ID</div>
                                <div class="text-gray-600">{{ $lead->id }}</div>
                                <div class="fw-bold mt-5">Lead Owner</div>
                                <div class="text-gray-600">{{ $lead->user->name }}</div>
                                <div class="fw-bold mt-5">Sales Representative</div>
                                <div class="text-gray-600">{{ $lead->user->name }}</div>
                                <div class="fw-bold mt-5">Mobile</div>
                                <div class="text-gray-600">{{ $lead->mobile }}</div>
                                <div class="fw-bold mt-5">Phone</div>
                                <div class="text-gray-600">{{ $lead->phone }}</div>
                                <div class="fw-bold mt-5">Email</div>
                                <div class="text-gray-600">{{ $lead->email }}</div>
                                <div class="fw-bold mt-5">Utility Company</div>
                                <div class="text-gray-600">{{ $lead->utilitycompany->utility_companyname }}</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                        <!--begin::Details content-->
                        <div id="kt_dealer_view_details" class="collapse show col-md-6 mt-2">
                            <div class="pb-5 fs-6 ">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Appointment Date/Time</div>
                                <?php
                                $count = 0;
                                if ($lead->appointments) {
                                    foreach ($lead->appointments as $data) {
                                        $count++;
                                ?>
                                        <div class="text-gray-600"><b>Event {{$count}} : </b>{{ \Carbon\Carbon::parse($data->appointment_date)->format('d F Y') }} / {{ \Carbon\Carbon::parse($data->appointment_time)->format('g:i A') }}</div>
                                <?php
                                    }
                                }
                                ?>
                                <div class="text-gray-600"></div>
                                <div class="fw-bold mt-5">Call Center Representative</div>
                                <div class="text-gray-600">{{ $lead->user->name }}</div>
                                <div class="fw-bold mt-5">Lead Status</div>
                                <div class="text-gray-600">{{ $lead->status->status_name }}</div>
                                <div class="fw-bold mt-5">Lead Created By</div>
                                <?php
                                $created_at = \Carbon\Carbon::parse($lead->created_at)->format('d F Y');
                                $created_by = $lead->created_by ? $lead->user->name : 'N/A';
                                ?>
                                <div class="text-gray-600">{{ $created_by . ' | ' .$created_at }}</div>
                                <div class="fw-bold mt-5">Lead Source</div>
                                <div class="text-gray-600">{{ $lead->leadSource->source_name }}</div>
                                <div class="fw-bold mt-5">Layout</div>
                                <div class="text-gray-600">{{ $lead->company->name }}</div>
                                <div class="fw-bold mt-5">Appointment Sat</div>
                                <div class="text-gray-600">{{ $lead->appointment_sat==1 ? "Yes" : "No" }}</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                    </div>

                    <div class="row">
                        <!--begin::Details content-->
                        <div id="kt_dealer_view_details" class="collapse show col-md-6">
                            <h3>Address information</h3>
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Street</div>
                                <div class="text-gray-600">{{ $lead->street }}</div>
                                <div class="fw-bold mt-5">City</div>
                                <div class="text-gray-600">{{ $lead->city }}</div>
                                <div class="fw-bold mt-5">State</div>
                                <div class="text-gray-600">{{ $lead->state }}</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                        <!--begin::Details content-->
                        <div id="kt_dealer_view_details" class="collapse show col-md-6 mt-2">
                            <div class="pb-5 fs-6 ">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Zip Code</div>
                                <div class="text-gray-600">{{ $lead->zip }}</div>
                                <div class="fw-bold mt-5">Country</div>
                                <div class="text-gray-600">{{ $lead->country }}</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                    </div>

                    <div class="row">
                        <!--begin::Details content-->
                        <div id="kt_dealer_view_details" class="collapse show col-md-12">
                            <h3>Description information</h3>
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Lead Notes</div>
                                <div class="text-gray-600">{{ $lead->note->notes }}</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
    </div>
    <!--end::Layout-->
</x-default-layout>