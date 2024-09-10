<x-default-layout>

    @section('title')
    Appointment
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('appointments') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form method="GET" action="{{ route('appointments') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control form-control-sm me-3">
                    <button type="submit" class="btn btn-primary btn-sm me-1">Search</button>
                    <a href="/appointments" class="btn btn-secondary btn-sm me-1">Clear</a>
                </form>
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-appointment-table-toolbar="base">
                    <!--begin::Add appointment-->
                    @if(auth()->user()->can('create appointment'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_appointment">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New appointment
                    </button>
                    @endif
                    <!--end::Add appointment-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light-primary">
                            <th>ID</th>
                            <th>Lead Name</th>
                            <th>Appointment Info</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($rows))
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->first_name . ' ' . $row->last_name }}<br><small class="badge badge-secondary"><i class="fa fa-phone"></i>&nbsp;{{ $row->phone}}</small></td>
                            <td><b>{{\Carbon\Carbon::parse($row->appointment_date . ' ' . $row->appointment_time)->format('d F Y H:i')}}</b>
                                <br><small>{{(implode(', ', array_filter([
                                            optional($row->country)->name,
                                            optional($row->state)->name,
                                            optional($row->city)->name,
                                            $row->appointment_address_1,
                                            $row->appointment_address_2,
                                            $row->appointment_street,
                                            $row->appointment_zip
                                        ])))}}</small>
                            </td>
                            <td>
                                <span class="badge rounded-pill w-15px h-15px me-1 d-inline-block" style="background-color: {{ $row->color_code }};"></span>
                                {{ $row->status_name }}
                            </td>

                            <td>
                                <!-- Include action buttons -->
                                @include('pages.appointment.columns._actions', ['appointment' => $row])
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td align="center" colspan="7">There are no records in this list currently! Thank you</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Pagination Links -->
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    <!--begin::Modal - Add Appointment-->
    <div class="modal fade" id="kt_modal_add_appointment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_appointment_header">
                    <h2 class="fw-bold">Add New Appointment</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_add_appointment_form" class="form" action="#" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_appointment_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_appointment_header" data-kt-scroll-wrappers="#kt_modal_add_appointment_scroll" data-kt-scroll-offset="200px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Lead</label>
                                    <select id="lead_id" name="lead_id" onchange="getLeadAddress(this)" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a Lead">
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
                                    <select name="representative_user" id="representative_user" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a User">
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
                                    <input placeholder="Enter Appointment Date" type="date" id="appointment_date" name="appointment_date" class="form-control form-control-solid border mb-3 mb-lg-0" required />
                                    @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Appointment Time</label>
                                    <input placeholder="Enter Appointment Time" type="time" id="appointment_time" name="appointment_time" class="form-control form-control-solid border mb-3 mb-lg-0" />
                                    @error('appointment_time')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="required fs-6 fw-semibold ">Country</label>
                                    <select onchange="getStates()" class="form-select" name="appointment_country_id" id="appointment_country_id" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a country">
                                        <option value="">Select a Country...</option>
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
                                    <select class="form-select" id="appointment_state_id" name="appointment_state_id" onchange="getCities()" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a state">
                                        <option value="">Select a State...</option>
                                    </select>
                                    @error('appointment_state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="fs-6 fw-semibold ">City</label>
                                    <select class="form-control" name="appointment_city_id" id="appointment_city_id" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a city">
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

    <!--begin::Modal - update Appointment-->
    <div class="modal fade" id="kt_modal_update_appointment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_appointment_header">
                    <h2 class="fw-bold">Update Appointment</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_update_appointment_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" name="appointment_id" id="appointment_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_update_appointment_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_appointment_header" data-kt-scroll-wrappers="#kt_modal_update_appointment_scroll" data-kt-scroll-offset="200px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Lead</label>
                                    <select id="update_lead_id" name="update_lead_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_update_appointment" data-placeholder="Select a Lead">
                                        @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" data-street="{{$lead->street}}" data-city="{{$lead->city_id}}" data-state="{{$lead->state_id}}" data-zip="{{$lead->zip}}" data-country="{{$lead->country_id}}" data-address1="{{$lead->address_1}}" data-address2="{{$lead->address_2}}">{{$lead->first_name}} {{$lead->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('lead_id')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Call Center Representative</label>
                                    <select name="update_representative_user" id="update_representative_user" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_update_appointment" data-placeholder="Select a User">
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
                                    <input placeholder="Enter Appointment Date" type="date" id="update_appointment_date" name="update_appointment_date" class="form-control form-control-solid border mb-3 mb-lg-0" required />
                                    @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7 col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">Appointment Time</label>
                                    <input placeholder="Enter Appointment Time" type="time" id="update_appointment_time" name="update_appointment_time" class="form-control form-control-solid border mb-3 mb-lg-0" />
                                    @error('appointment_time')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="required fs-6 fw-semibold ">Country</label>
                                    <select onchange="updateGetStates()" class="form-select" name="update_appointment_country_id" id="update_appointment_country_id" data-control="select2" data-dropdown-parent="#kt_modal_update_appointment" data-placeholder="Select a country">
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
                                    <select class="form-select" id="update_appointment_state_id" name="update_appointment_state_id" onchange="updateGetCities()" data-control="select2" data-dropdown-parent="#kt_modal_update_appointment" data-placeholder="Select a state">
                                    </select>
                                    @error('appointment_state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="fs-6 fw-semibold ">City</label>
                                    <select class="form-control" name="update_appointment_city_id" id="update_appointment_city_id" data-control="select2" data-dropdown-parent="#kt_modal_update_appointment" data-placeholder="Select a city">
                                    </select>
                                    @error('appointment_city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="fs-6 fw-semibold ">Street</label>
                                    <input type="text" class="form-control" name="update_appointment_street" id="update_appointment_street" />
                                    @error('street')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="fs-6 fw-semibold ">Post Code</label>
                                    <input type="text" class="form-control" name="update_appointment_zip" id="update_appointment_zip" />
                                    @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                    <input type="text" class="form-control" name="update_appointment_address_1" id="update_appointment_address_1" requried />
                                    @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="fs-6 fw-semibold ">Address Line 2</label>
                                    <input type="text" class="form-control" name="update_appointment_address_2" id="update_appointment_address_2" />
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - update Appointment-->

    <!--begin::Modal - View Appointment Details-->
    <div class="modal fade" id="kt_modal_update_appointment_timeline" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach_appointment_notes">

                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Modal - View Appointment Details-->
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#mySearchInput').on('keyup', function() {
                table.search($(this).val()).draw();
            });
        });

        $('#kt_modal_add_appointment_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = "{{ route('appointment.store') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#kt_modal_add_appointment').modal('hide');
                    Swal.fire({
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'Close',
                        customClass: {
                            confirmButton: 'btn btn-light-success'
                        }
                    });
                    // Reload or update your appointments list here
                    location.reload();
                },
                error: function(xhr) {
                    // Parse the error response if any
                    var errorMessage = xhr.responseJSON.error || 'Failed to save the appointment.';

                    Swal.fire({
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Close',
                        customClass: {
                            confirmButton: 'btn btn-light-danger'
                        }
                    });
                }
            });
        });

        $('#kt_modal_update_appointment_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = "{{ route('appointment.updateAppointment') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#kt_modal_update_appointment').modal('hide');
                    Swal.fire({
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'Close',
                        customClass: {
                            confirmButton: 'btn btn-light-success'
                        }
                    });
                    // Reload or update your appointments list here
                    location.reload();
                },
                error: function(xhr) {
                    // Parse the error response if any
                    var errorMessage = xhr.responseJSON.error || 'Failed to save the appointment.';

                    Swal.fire({
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Close',
                        customClass: {
                            confirmButton: 'btn btn-light-danger'
                        }
                    });
                }
            });
        });

        function getLeadAddress(element) {
            var leadId = $(element).val();
            $.ajax({
                url: "{{ route('appointment.getLeadAddress') }}",
                method: 'post',
                data: {
                    leadId: leadId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
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
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        function getStates(selectedStateId = null) {
            var countryId = $('#appointment_country_id').val();
            var stateDropdown = $('#appointment_state_id');
            var cityDropdown = $('#appointment_city_id');
            stateDropdown.empty();
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getStates') }}",
                method: 'post',
                data: {
                    countryId: countryId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.select2({
                        dropdownParent: $('#kt_modal_add_appointment'),
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
                    // Set the selected state once the options are loaded
                    if (selectedStateId) {
                        stateDropdown.val(selectedStateId).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        function formatStateColour(state) {
            if (!state.id) {
                return state.text;
            }

            var color = $(state.element).data('color'); // Get color from option data
            var $state = $(
                '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + state.text + '</span>'
            );

            return $state;
        }

        function getCities(selectedCityId = null) {
            var stateId = $('#appointment_state_id').val();
            var cityDropdown = $('#appointment_city_id');
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getCities') }}",
                method: 'post',
                data: {
                    stateId: stateId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $.each(data.states, function(key, value) {
                        cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Set the selected city once the options are loaded
                    if (selectedCityId) {
                        cityDropdown.val(selectedCityId).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get cities for this state!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        function update_appointment_modal(element) {
            var appointmentId = $(element).data('kt-appointment-id');
            if (appointmentId) {
                var appointmentLeadId = $(element).data('kt-appointment-lead-id');
                var appointmentRepresentativeUser = $(element).data('kt-appointment-representative-user');
                var appointmentDate = $(element).data('kt-appointment-date');
                var appointmentTime = $(element).data('kt-appointment-time');
                var appointmentCountryId = $(element).data('kt-appointment-country-id');
                var appointmentStateId = $(element).data('kt-appointment-state-id');
                var appointmentCityId = $(element).data('kt-appointment-city-id');
                var appointmentStreet = $(element).data('kt-appointment-street');
                var appointmentZip = $(element).data('kt-appointment-zip');
                var appointmentAddress1 = $(element).data('kt-appointment-address-1');
                var appointmentAddress2 = $(element).data('kt-appointment-address-2');

                $('#appointment_id').val(appointmentId);
                $('#update_lead_id').val(appointmentLeadId).trigger('change');
                $('#update_representative_user').val(appointmentRepresentativeUser).trigger('change');
                $('#update_appointment_date').val(appointmentDate);
                $('#update_appointment_time').val(appointmentTime);
                $('#update_appointment_country_id').val(appointmentCountryId).trigger('change');
                updateGetStates(appointmentStateId);
                $('#update_appointment_state_id').on('change', function() {
                    updateGetCities(appointmentCityId);
                });
                $('#update_appointment_street').val(appointmentStreet);
                $('#update_appointment_zip').val(appointmentZip);
                $('#update_appointment_address_1').val(appointmentAddress1);
                $('#update_appointment_address_2').val(appointmentAddress2);
                $('#kt_modal_update_appointment').modal('show');
            }
        }

        function updateGetStates(selectedStateId = null) {
            var countryId = $('#update_appointment_country_id').val();
            var stateDropdown = $('#update_appointment_state_id');
            var cityDropdown = $('#update_appointment_city_id');
            stateDropdown.empty();
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getStates') }}",
                method: 'post',
                data: {
                    countryId: countryId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.select2({
                        dropdownParent: $('#kt_modal_update_appointment'),
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
                    // Set the selected state once the options are loaded
                    if (selectedStateId) {
                        stateDropdown.val(selectedStateId).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        function updateGetCities(selectedCityId = null) {
            var stateId = $('#update_appointment_state_id').val();
            var cityDropdown = $('#update_appointment_city_id');
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getCities') }}",
                method: 'post',
                data: {
                    stateId: stateId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $.each(data.states, function(key, value) {
                        cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Set the selected city once the options are loaded
                    if (selectedCityId) {
                        cityDropdown.val(selectedCityId).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get cities for this state!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        function updateGetLeadAddress(element) {
            var leadId = $(element).val();
            $.ajax({
                url: "{{ route('appointment.getLeadAddress') }}",
                method: 'post',
                data: {
                    leadId: leadId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.lead) {
                        // Set the country, state, and city values
                        $("#update_appointment_country_id").val(data.lead.country_id).trigger('change');

                        // Wait for states to load, then set the state
                        setTimeout(function() {
                            $("#update_appointment_state_id").val(data.lead.state_id).trigger('change');
                        }, 500);

                        // Wait for cities to load, then set the city
                        setTimeout(function() {
                            $("#update_appointment_city_id").val(data.lead.city_id).trigger('change');
                        }, 2000);
                        $("#update_appointment_street").val(data.lead.street);
                        $("#update_appointment_zip").val(data.lead.zip);
                        $("#update_appointment_address_1").val(data.lead.address_1);
                        $("#update_appointment_address_2").val(data.lead.address_2);
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get lead address!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        $('#representative_user, #appointment_country_id, #appointment_state_id, #appointment_city_id').select2({
            dropdownParent: $('#kt_modal_add_appointment')
        });

        $('#update_representative_user, update_appointment_country_id, #update_appointment_state_id, #update_appointment_city_id').select2({
            dropdownParent: $('#kt_modal_update_appointment')
        });

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
    @endpush
</x-default-layout>