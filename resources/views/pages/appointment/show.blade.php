<x-default-layout>

    @section('title')
        View Appointment Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('appointments.show', $appointment) }}
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
                    <!--begin::appointment Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <!--begin::Name-->
                        <h1 class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">Appointment Details</h1>
                        <!--end::Name-->
                    </div>
                    <!--end::appointment Info-->
                    <!--end::Summary-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div class="row">
                        <div id="kt_dealer_view_details" class="collapse show col-md-6">
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Appointment ID</div>
                                <div class="text-gray-600">{{ $appointment->id }}</div>
                                <div class="fw-bold mt-5">Lead Name</div>
                                <div class="text-gray-600">{{ $appointment->lead->first_name }} {{ $appointment->lead->last_name }}</div>
                                <div class="fw-bold mt-5">Call Center Representative</div>
                                <div class="text-gray-600">{{ $appointment->user->name }}</div>
                                <div class="fw-bold mt-5">Appointment Date</div>
                                <div class="text-gray-600">{{ $appointment->appointment_date }}</div>
                            </div>
                        </div>
                        
                        <div id="kt_dealer_view_details" class="collapse show col-md-6">
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Appointment Time</div>
                                <div class="text-gray-600">{{ $appointment->appointment_time }}</div>
                                <div class="fw-bold mt-5">Appointment Created By</div>
                                <div class="text-gray-600">{{ $appointment->user->name }}</div>
                                <div class="fw-bold mt-5">Appointment Created Date</div>
                                <div class="text-gray-600">{{ \Carbon\Carbon::parse($appointment->created_at)->format('d F Y, g:i a') }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!--begin::Details content-->
                        <div id="kt_dealer_view_details" class="collapse show col-md-12">
                            <div class="pb-5 fs-6">
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Appointment Notes</div>
                                <div class="text-gray-600">{{ $appointment->appointment_notes }}</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
    </div>
    <!--end::Layout-->
</x-default-layout>
