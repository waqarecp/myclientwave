
<x-default-layout>
    <link rel="canonical" href="http://apps/calendar.html" />
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    @section('title')
     Calendar
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('calendars.index') }}
    @endsection
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
    <!--begin::Modal - Add Appointment-->
    <div class="modal fade" id="kt_modal_appointment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_appointment_header">
                    <h2 class="fw-bold"></h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_appointment_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" name="appointment_id" id="appointment_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_appointment_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_appointment_header" data-kt-scroll-wrappers="#kt_modal_appointment_scroll" data-kt-scroll-offset="200px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Lead</label>
                                    <select id="lead_id" name="lead_id" onchange="getLeadAddress(this)" class="form-select form-select-solid border fw-semibold">
                                        <option value="">--- Select a Lead ---</option>
                                        @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" data-street="{{$lead->street}}" data-city="{{$lead->city_id}}" data-state="{{$lead->state_id}}" data-zip="{{$lead->zip}}" data-country="{{$lead->country_id}}" data-address1="{{$lead->address_1}}" data-address2="{{$lead->address_2}}">{{$lead->first_name}} {{$lead->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('lead_id')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Call Center Representative</label>
                                    <select name="representative_user" class="form-select form-select-solid border fw-semibold">
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
                                    @error('representative_user')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Appointment Date</label>
                                    <input placeholder="Enter Appointment Date" type="date" name="appointment_date" class="form-control form-control-solid border mb-3 mb-lg-0" required />
                                    @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Appointment Time</label>
                                    <input placeholder="Enter Appointment Time" type="time" name="appointment_time" class="form-control form-control-solid border mb-3 mb-lg-0" />
                                    @error('appointment_time')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="required fs-6 fw-semibold ">Country</label>
                                    <select onchange="getStates()" class="form-select" name="appointment_country_id" id="appointment_country_id" data-control="select2" data-dropdown-parent="#kt_modal_appointment" data-placeholder="Select a country">
                                        @foreach($countries as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('appointment_country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="fs-6 fw-semibold ">State / Province</label>
                                    <select class="form-select" id="appointment_state_id" name="appointment_state_id" onchange="getCities()" data-control="select2" data-dropdown-parent="#kt_modal_appointment" data-placeholder="Select a state">
                                        <option value="">Select a State...</option>
                                    </select>
                                    @error('appointment_state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="fs-6 fw-semibold ">City</label>
                                    <select class="form-control" name="appointment_city_id" id="appointment_city_id" data-control="select2" data-dropdown-parent="#kt_modal_appointment" data-placeholder="Select a city">
                                        <option value="">Select a City...</option>
                                    </select>
                                    @error('appointment_city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="fs-6 fw-semibold ">Street</label>
                                    <input type="text" class="form-control" name="appointment_street" id="appointment_street" />
                                    @error('street')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="fs-6 fw-semibold ">Post Code</label>
                                    <input type="text" class="form-control" name="appointment_zip" id="appointment_zip" />
                                    @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                    <input type="text" class="form-control" name="appointment_address_1" id="appointment_address_1" requried />
                                    @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="fs-6 fw-semibold ">Address Line 2</label>
                                    <input type="text" class="form-control" name="appointment_address_2" id="appointment_address_2" />
                                    @error('address2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - Add Appointment-->
    </div>
    <!--end::Card header-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <h2 class="card-title fw-bold d-none">Calendar</h2>
                    <div class="card-toolbar">
                        <!--begin::Add appointment-->
                        <!-- @if(auth()->user()->can('create appointment'))
                        <button class="btn btn-flex btn-primary" data-kt-calendar="add">
                            <i class="ki-duotone ki-plus fs-2"></i>Add Event</button>
                        @endif -->
                        <!--begin::Add appointment-->
                        @if(auth()->user()->can('create appointment'))
                        <button type="button" class="btn btn-primary" onclick="appointment_modal(this)">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Add New Appointment
                        </button>
                        @endif
                        <!--end::Add appointment-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <input type="hidden" id="calendar_data" value='{{ $calendarData }}'/>
                    <!--begin::Calendar-->
                    <div id="kt_calendar_app"></div>
                    <!--end::Calendar-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            <!--begin::Modal - New Product-->
            <div class="modal fade" id="kt_modal_add_event" tabindex-="1" aria-hidden="true" data-bs-focus="false">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="#" id="kt_modal_add_event_form">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Add Event</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold required mb-2">Event Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Event Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Event Location</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday" />
                                        <span class="form-check-label fw-semibold" for="kt_calendar_datepicker_allday">All Day</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2 required">Event Start Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Event Start Time</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2 required">Event End Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Event End Time</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">Cancel</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Modal - New Product-->
            <!--begin::Modal - New Product-->
            <div class="modal fade" id="kt_modal_view_event" tabindex="-1" data-bs-focus="false" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header border-0 justify-content-end">
                            <a id="viewDetailsBtn" href="javascript:void(0)" data-kt-calendar="lead_id" class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary me-2" title="View Details">
                                <i class="ki-duotone ki-eye">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </a>
                            <!--begin::Edit-->
                            <!-- <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div> -->
                            <!--end::Edit-->
                            <!--begin::Edit-->
                            <!-- <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </div> -->
                            <!--end::Edit-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-2x">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body pt-0 pb-20 px-lg-17">
                            <!--begin::Row-->
                            <div class="d-flex">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-calendar-8 fs-1 text-muted me-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                                <!--end::Icon-->
                                <div class="mb-9">
                                    <!--begin::Event name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="javascript:void(0)" id="eventName" title="View Details" class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></a>
                                        <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                    </div>
                                    <!--end::Event name-->
                                    <!--begin::Event description-->
                                    <div class="fs-6" data-kt-calendar="event_description"></div>
                                    <!--end::Event description-->
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-dot h-10px w-10px bg-success ms-2 me-7"></span>
                                <!--end::Bullet-->
                                <!--begin::Event start date/time-->
                                <div class="fs-6">
                                    <span class="fw-bold">Starts</span>
                                    <span data-kt-calendar="event_start_date"></span>
                                </div>
                                <!--end::Event start date/time-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="d-flex align-items-center mb-9 d-none">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-dot h-10px w-10px bg-danger ms-2 me-7"></span>
                                <!--end::Bullet-->
                                <!--begin::Event end date/time-->
                                <div class="fs-6">
                                    <span class="fw-bold">Ends</span>
                                    <span data-kt-calendar="event_end_date"></span>
                                </div>
                                <!--end::Event end date/time-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="d-flex align-items-center">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-geolocation fs-1 text-muted me-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Event location-->
                                <div class="fs-6" data-kt-calendar="event_location"></div>
                                <!--end::Event location-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                </div>
            </div>
            <!--end::Modal - New Product-->
            <!--end::Modals-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    @push('scripts')
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="assets/js/custom/apps/calendar/calendar.js"></script>
        
    <script>
        $('#kt_modal_appointment').on('hidden.bs.modal', function() {
            window.location.reload();
        });

        function appointment_modal(element) {
            var appointmentId = $(element).data('kt-appointment-id');
            if (appointmentId) {
                $('#kt_modal_appointment_header h2').text('Update Appointment');
                $('#kt_modal_appointment_form').trigger('reset'); // Reset form fields
                $('#appointment_id').val(appointmentId); // Clear the hidden input for appointment ID
                $('#kt_modal_appointment').modal('show');
            } else {
                $('#kt_modal_appointment_header h2').text('Add New Appointment');
                $('#kt_modal_appointment_form').trigger('reset'); // Reset form fields
                $('#appointment_id').val(''); // Clear the hidden input for appointment ID
                $('#kt_modal_appointment').modal('show');

            }
        }
        $('#kt_modal_appointment_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $('#appointmentId').val() ? "{{ route('appointment.updateAppointment') }}" : "{{ route('appointment.store') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(response) {
                    $('#kt_modal_appointment').modal('hide');
                    Swal.fire({
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'Close',
                        customClass: { confirmButton: 'btn btn-light-success' }
                    });
                    // Reload or update your appointments list here
                    window.location.reload();
                },
                error: function(xhr) {
                    // Parse the error response if any
                    var errorMessage = xhr.responseJSON.error || 'Failed to save the appointment.';

                    Swal.fire({
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Close',
                        customClass: { confirmButton: 'btn btn-light-danger' }
                    });
                }
            });
        });

        // Function to get Lead address and set country, state, and city
        function getLeadAddress(element){
            var leadId = $(element).val();
            $.ajax({
                url: "{{ route('appointment.getLeadAddress') }}",
                method: 'post',
                data: { leadId: leadId },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    if (data.lead) {
                        // Set the country, state, and city values
                        $("#appointment_country_id").val(data.lead.country_id).trigger('change');

                        // Wait for states to load, then set the state
                        setTimeout(function() {
                            $("#appointment_state_id").val(data.lead.state_id).trigger('change');
                        }, 500);

                        // Wait for cities to load, then set the city
                        setTimeout(function() {
                            $("#appointment_city_id").val(data.lead.city_id).trigger('change');
                        }, 2000);
                        $("#appointment_street").val(data.lead.street);
                        $("#appointment_zip").val(data.lead.zip);
                        $("#appointment_address_1").val(data.lead.address_1);
                        $("#appointment_address_2").val(data.lead.address_2);
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get lead address!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: { confirmButton: "btn btn-light-danger" }
                    });
                }
            });
        }

        // Function to get states based on selected country
        function getStates() {
            var countryId = $('#appointment_country_id').val();
            var stateDropdown = $('#appointment_state_id');
            var cityDropdown = $('#appointment_city_id');
            stateDropdown.empty();
            cityDropdown.empty();
            
            $.ajax({
                url: "{{ route('leads.getStates') }}",
                method: 'post',
                data: { countryId: countryId },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    stateDropdown.select2({
                        dropdownParent: $('#kt_modal_appointment'),
                        templateResult: formatStateColour,
                        templateSelection: formatStateColour
                    });

                    $.each(data.states, function(index, state) {
                        var option = $('<option></option>')
                            .val(state.id)
                            .text(state.name)
                            .attr('data-color', state.color_code); // Add color to option
                        stateDropdown.append(option);
                    });
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: { confirmButton: "btn btn-light-danger" }
                    });
                }
            });
        }

        // Function to format state options with color
        function formatStateColour(state) {
            if (!state.id) { return state.text; }

            var color = $(state.element).data('color'); // Get color from option data
            var $state = $(
                '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + state.text + '</span>'
            );

            return $state;
        }

        // Function to get cities based on selected state
        function getCities() {
            var stateId = $('#appointment_state_id').val();
            var cityDropdown = $('#appointment_city_id');
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getCities') }}",
                method: 'post',
                data: { stateId: stateId },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    $.each(data.states, function(key, value) {
                        cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get cities for this state!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: { confirmButton: "btn btn-light-danger" }
                    });
                }
            });
        }

        // Reinitialize Select2 for all relevant fields
        $('#appointment_country_id, #appointment_state_id, #appointment_city_id').select2({
            dropdownParent: $('#kt_modal_appointment')
        });

    </script>
    @endpush

</x-default-layout>