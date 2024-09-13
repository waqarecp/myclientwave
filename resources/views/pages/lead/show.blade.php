<x-default-layout>

    @section('title')
    View Lead Details
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('leads.show', $lead) }}
    @endsection

    <!--begin::Content-->
    <div class="">
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
                                    <div class="text-gray-600">{{ $lead->user ? $lead->user->name : 'N/A' }}</div>
                                    <div class="fw-bold mt-5">Sales Representative</div>
                                    <div class="text-gray-600">{{ $lead->user ? $lead->user->name : 'N/A' }}</div>
                                    <div class="fw-bold mt-5">Mobile</div>
                                    <div class="text-gray-600">{{ $lead->mobile }}</div>
                                    <div class="fw-bold mt-5">Phone</div>
                                    <div class="text-gray-600">{{ $lead->phone }}</div>
                                    <div class="fw-bold mt-5">Utility Company</div>
                                    <div class="text-gray-600">{{ $lead->utilityCompany ? $lead->utilityCompany->utility_company_name : 'N/A' }}</div>
                                </div>
                            </div>
                            <!--end::Details content-->
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show col-md-6 mt-2">
                                <div class="pb-5 fs-6 ">
                                    <!--begin::Details item-->
                                    <div class="text-gray-600"></div>
                                    <div class="fw-bold mt-5">Call Center Representative</div>
                                    <div class="text-gray-600">{{ $lead->user ? $lead->user->name : 'N/A' }}</div>
                                    <div class="fw-bold mt-5">Lead Created By</div>
                                    <?php
                                    $created_at = \Carbon\Carbon::parse($lead->created_at)->format('d F Y');
                                    $created_by = $lead->created_by ? $lead->user->name : 'N/A';
                                    ?>
                                    <div class="text-gray-600">{{ $created_by . ' | ' .$created_at }}</div>
                                    <div class="fw-bold mt-5">Lead Source</div>
                                    <div class="text-gray-600">{{ $lead->leadSource ? $lead->leadSource->source_name : 'N/A' }}</div>
                                    <div class="fw-bold mt-5">Layout</div>
                                    <div class="text-gray-600">{{ $lead->company ? $lead->company->name : 'N/A' }}</div>
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
                    <div class="card-body p-2">
                        <table class="table">
                            <thead>
                                <tr class="bg-light-primary">
                                    <th>S.No</th>
                                    <th width="12%">Date Time</th>
                                    <th>Address</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1 @endphp
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td><b>{{\Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y')}} {{\Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')}}</b></td>
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
                                    </td>
                                    <td>
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions<i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                        @if(auth()->user()->can('read appointment'))
                                            <div class="menu-item px-3">
                                                <a href="{{ route('appointments.show', $appointment->id) }}" class="menu-link px-3">View Details</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a title="View appointment comments" href="javascript:void(0)" data-kt-appointment-id="{{ $appointment->id }}" onclick="viewAppointmentTimeline('{{ $appointment->id }}')" class="menu-link px-3">Show Comments</a>
                                            </div>
                                        @endif
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
    function viewAppointmentTimeline(appointment_id, activeCommentsTab = false) {
        $.ajax({
            url: "{{ route('appointments.viewTimeline') }}", // Use the URL from the data attribute
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