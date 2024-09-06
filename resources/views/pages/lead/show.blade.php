<x-default-layout>

    @section('title')
    View Lead Details
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('leads.show', $lead) }}
    @endsection

    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" data-bs-target="#kt_lead_information" href="javascript:void(0)">Lead information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" data-bs-target="#kt_lead_schedule_appointment" href="javascript:void(0)">Scheduled Appointments</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_lead_information" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $lead->first_name }} {{ $lead->last_name }}</h2>
                            <div class="fs-6 fw-semibold text-muted"> Lead details for {{ $lead->first_name }} {{ $lead->last_name }}</div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">
                        <div class="separator"></div>
                        <div class="row">
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show col-md-6">
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
                                    <div class="fw-bold mt-5">Utility Company</div>
                                    <div class="text-gray-600">{{ $lead->utilitycompany->utility_companyname ?: 'N/A' }}</div>
                                </div>
                            </div>
                            <!--end::Details content-->
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show col-md-6 mt-2">
                                <div class="pb-5 fs-6 ">
                                    <!--begin::Details item-->
                                    <div class="text-gray-600"></div>
                                    <div class="fw-bold mt-5">Call Center Representative</div>
                                    <div class="text-gray-600">{{ $lead->user->name }}</div>
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
                                    <div class="fw-bold mt-5">Email</div>
                                    <div class="text-gray-600">{{ $lead->email }}</div>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>

                        <div class="row">
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show col-md-12">
                                <h3>Address information</h3>
                                <div class="pb-5 fs-6">
                                    <div class="text-gray-600">
                                        {{(implode(', ', array_filter([
                                            optional($lead->country)->name,
                                            optional($lead->state)->name,
                                            optional($lead->city)->name,
                                            $lead->address_1,
                                            $lead->address_2,
                                            $lead->street,
                                            $lead->zip
                                        ])))}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_lead_schedule_appointment" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $lead->first_name }} {{ $lead->last_name }}</h2>
                            <div class="fs-6 fw-semibold text-muted">List of all scheduled appointments.</div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="bg-light-primary">
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Address</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1 @endphp
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{\Carbon\Carbon::parse($appointment->appointment_date)->format('d F Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')}}</td>
                                    <td><small>{{(implode(', ', array_filter([
                                            optional($appointment->country)->name,
                                            optional($appointment->state)->name,
                                            optional($appointment->city)->name,
                                            $appointment->appointment_address_1,
                                            $appointment->appointment_address_2,
                                            $appointment->appointment_street,
                                            $appointment->appointment_zip
                                        ])))}}</small></td>
                                    <td>
                                        {{\Carbon\Carbon::parse($appointment->created_at)->format('d F Y, H:i')}}
                                        <br><span class="badge badge-secondary">{{($appointment->created_by ? $appointment->user->name : 'N/A')}}</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill w-15px h-15px me-1 d-inline-block" style="background-color: {{ $appointment->status->color_code }};"></span>
                                        {{$appointment->status?$appointment->status->status_name:'N/A'}}
                                        <button class="btn btn-sm btn-light-primary p-2 flaot-end" title="View Comments" data-kt-appointment-id="{{ $appointment->id }}" onclick="updateAppointmentTimeline('{{ $appointment->id }}')"><i class="fa fa-comments"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
     
     <!--begin::Modal - View Lead Details-->
     <div class="modal fade" id="kt_modal_view_lead_comments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach">
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - New Address-->
    <!--begin::Modal - View Lead Details-->
    <div class="modal fade" id="kt_modal_update_appointment_timeline" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach_appointment_notes">

                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Modal - New Address-->
<script>
    function updateAppointmentTimeline(appointment_id, activeCommentsTab = false) {
        $.ajax({
            url: "{{ route('appointments.updateTimeline') }}", // Use the URL from the data attribute
            method: 'post',
            data: {
                appointment_id: appointment_id,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
            },
            success: function(data) {
                $('.kt_modal_attach_appointment_notes').html(data);
                $('#kt_modal_update_appointment_timeline').modal('show');
                if (activeCommentsTab) {
                    $('#update_followup .nav-item a').removeClass('active');
                    $('#update_followup .nav-item a').eq(1).addClass('active');
                    $('#appointment-note-content .tab-pane').removeClass('active show');
                    $('#appointment-note-content .tab-pane').eq(1).addClass('active show');
                }
            },
            error: function(data) {
                Swal.fire({
                    text: 'Failed to view timeline for this appointment!', 
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
</script>
</x-default-layout>