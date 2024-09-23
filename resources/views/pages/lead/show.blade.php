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
                    <div class="accordion" id="accordion_lead_info">
                        <div class="accordion-item border border-primary border-dashed">
                            <h2 class="accordion-header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeadInfo" aria-expanded="false" aria-controls="collapseLeadInfo">
                                    {{ $lead->first_name }} {{ $lead->last_name }}
                                </button>
                            </h2>
                            <div id="collapseLeadInfo" class="{{isset($_GET['page']) ? '' : 'show'}} collapse" data-bs-parent="#accordion_lead_info">
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
                    </div>
                    <div class="accordion" id="accordion_lead_comments">
                        <div class="accordion-item border border-primary border-dashed">
                            <h2 class="accordion-header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeadComment" aria-expanded="false" aria-controls="collapseLeadComment">
                                    Lead Comments
                                </button>
                            </h2>
                            <div id="collapseLeadComment" class="{{isset($_GET['page']) ? 'show' : ''}} collapse" data-bs-parent="#accordion_lead_comments">
                                <div class="card-body">
                                    <div class="accordion" id="accordion_new_comment">
                                        <div class="accordion-item border border-primary border-dashed">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button fs-4 fw-semibold collapsed bg-light-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewComment" aria-expanded="false" aria-controls="collapseNewComment">
                                                    {!! getIcon('plus', 'fs-2', '', 'i') !!} Add New Comment
                                                </button>
                                            </h2>
                                            <div id="collapseNewComment" class="collapse" data-bs-parent="#accordion_new_comment">
                                                <div class="card-body p-2">
                                                    <form method="post" enctype="multipart/form-data" id="AddLeadNote">
                                                        @csrf
                                                        <input type="hidden" name="appointment_id" id="new_comment_appointment_id" class="form-control" value="{{ $appointments->last()->id }}">
                                                        <input type="hidden" name="current_status_id" id="current_status_id" class="form-control" value="{{ $appointments->last()->status->id }}">
                                                        <div class="fv-row mb-3">
                                                            <label class="fw-semibold m-4">Tag users in comment</label>
                                                            <label for="notify" class="btn btn-sm btn-secondary border p-2 float-end m-2"><input type="checkbox" name="nofity" id="notify" value="1"> Notify Tagged Users</label>
                                                            <select onchange="selectAll(this)" id="tag_users" name="user_ids[]" class="form-select" data-control="select2" data-bs-parent="accordion_lead_comments" data-search="true" multiple>
                                                                <option value="all">Tag All Users</option>
                                                                @foreach($users as $userId => $userName)
                                                                    @if ($userId != auth()->user()->id)
                                                                    <option value="{{$userId}}">{{ucwords($userName)}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            @error('user_ids')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <textarea name="appointment_notes" id="appointment_notes" class="form-control mt-2"></textarea>
                                                        @error('appointment_notes')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <button type="button" id="btnAddComment" data-url="{{ route('appointments.noteStore') }}" class="btn btn-sm btn-primary mt-2">Add Comment</button>
                                                        <button type="reset" class="btn btn-sm btn-warning mt-2 d-none">Clear All</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator"></div>
                                    <div class="row">
                                        <!--begin::Details content-->
                                        <div class="collapse show">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        @if (count($rows))
                                                        @foreach($rows as $comment)
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                $taggedUsers = $comment->user_ids ? explode(",", $comment->user_ids) : [];
                                                                $unreadUsers = $comment->unread_ids ? explode(",", $comment->unread_ids) : [];
                                                                ?>
                                                                <div class="ms-3">
                                                                    <a href="javascript:void(0)" class="fs-5 text-gray-900 text-hover-primary me-1">
                                                                        <small class="text-muted">Comment added by </small><i>{{ ucwords($comment->user_name ?? 'Unknown User') }}</i>
                                                                    </a>
                                                                    <span class="text-muted fs-7 mb-1 float-end">{{ \Carbon\Carbon::parse($comment->created_at)->format('d M Y, g:i A') }}</span>
                                                                </div>
                                                                <div data-note-comment="{{ $comment->note_id }}" class="p-3 rounded {{ in_array(Auth::user()->id, $unreadUsers) ? 'bg-light-success' : 'bg-light-secondary' }} text-gray-900 fw-semibold border" data-kt-element="message-text">
                                                                    <div class="d-inline-block">{!! $comment->notes !!}</div>
                                                                    @if (in_array(Auth::user()->id, $unreadUsers))
                                                                    <div data-unread-id="{{ $comment->note_id }}" class="badge badge-light-danger border border-danger float-end">Unread</div>
                                                                    @endif
                                                                </div>
                                                                <div class="mt-2">
                                                                    @if (in_array(Auth::user()->id, $unreadUsers))
                                                                    <a data-note-id="{{ $comment->note_id }}" href="javascript:void(0)" class="float-start badge bg-light-success" onclick="markAsRead(this, {{ $comment->note_id }})">
                                                                        <i class="ki-duotone ki-check fs-3"></i> Mark as read
                                                                    </a>
                                                                    @endif
                                                                    <div class="float-end">
                                                                        @if($taggedUsers)
                                                                        <small class="text-muted">Tagged Users </small>
                                                                        @foreach ($taggedUsers as $taggedUser)
                                                                        <span class="badge bg-light-warning">{{ ucwords($users[$taggedUser] ?? 'Unknown User') }}</span>
                                                                        @endforeach
                                                                        @endif
                                                                    </div><br><br>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td align="center" colspan="9">There are no records in this list currently! Thank you</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>

                                                <!-- Pagination Links -->
                                                {{ $rows->links('pagination::bootstrap-5') }}
                                            </div>
                                        </div>
                                        <!--end::Details content-->
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
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.replace('appointment_notes', {
            height: '150px',
        });

        function selectAll(element) {
            if ($(element).val() == 'all') {
                $("#tag_users option").each(function() {
                    if ($(this).val() !== 'all') { // Exclude the option with value 'all'
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });
                $("#tag_users").trigger("change");
            }
        }

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

        $('#btnAddComment').on('click', function(e) {
            e.preventDefault();

            // Fetch the button and form data
            var formData = new FormData($('#AddLeadNote')[0]);
            var url = $(this).data('url');
            formData.append('appointment_notes', CKEDITOR.instances.appointment_notes.getData());

            // Perform the AJAX request
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = window.location.href.split('?')[0] + '?page=1';
                    } else {
                        Swal.fire({
                            text: 'Failed to add your comment! Try again later',
                            icon: 'error',
                            confirmButtonText: "Close",
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-light-danger"
                            }
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        text: 'Failed to add your comment! Try again later',
                        icon: 'error',
                        confirmButtonText: "Close",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        });

        function markAsRead(element, noteId) {
            $.ajax({
                url: "{{route('appointments.markAsRead')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
                },
                data: {
                    noteId: noteId
                },
                success: function(response) {
                    if (response.success) {
                        $(element).remove();
                        $('[data-unread-id="' + noteId + '"]').remove();
                        $('[data-note-comment="' + noteId + '"]').removeClass("bg-light-success").addClass("bg-light-secondary");
                    }else{
                        Swal.fire({
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: "Close",
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-light-danger"
                            }
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to mark this comment as read! Try again later',
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