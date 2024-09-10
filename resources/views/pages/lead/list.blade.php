<x-default-layout>

    @section('title')
    Lead
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('leads.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form method="GET" action="{{ route('leads.index') }}" class="d-flex align-items-center">
                    <div class="m-1">
                        <small for="search">Search Lead</small>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search Lead" class="form-control form-control-sm me-3">
                    </div>
                    <div class="m-1">
                        <small for="date_from">Date From</small>
                        <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" placeholder="Date From..." class="form-control form-control-sm">
                    </div>
                    <div class="m-1">
                        <small for="date_to">Date To</small>
                        <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" placeholder="Date To..." class="form-control form-control-sm">
                    </div>
                    <div class="m-1">
                        <small for="filter_source">Source</small>
                        <select id="filter_source" name="filter_source" class="filter_source form-select form-select-sm">
                            <option value="">--- Filter By Source ---</option>
                            @foreach($sources as $source)
                            <option {{$request->filter_source == $source->id ? 'selected' : ''}} value="{{$source->id}}">{{$source->source_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="m-1">
                        <small for="filter_utility">Utility Company</small>
                        <select id="filter_utility" name="filter_utility" class="filter_utility form-select form-select-sm">
                            <option value="">--- Filter By Utility Company ---</option>
                            @foreach($utilityCompanies as $ucompany)
                            <option {{$request->filter_utility == $ucompany->id ? 'selected' : ''}} value="{{$ucompany->id}}">{{$ucompany->utility_company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="m-1">
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        <a href="/leads" class="btn btn-secondary btn-sm border">Clear</a>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Card header-->
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
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light-primary">
                            <th>ID</th>
                            <th>Lead Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>State</th>
                            <th>Source</th>
                            <th>Utility Company</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($rows))
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->first_name . ' ' . $row->last_name }}</td>
                            <td>{{ $row->email}}</td>
                            <td>{{ $row->phone}}</td>
                            <td>{{ $row->state_name}}</td>
                            <td>{{ $row->leadSource->source_name}}</td>
                            <td>{{ isset($row->utilityCompany->utility_company_name) ? $row->utilityCompany->utility_company_name : 'Nil'}}</td>
                            <td>
                                {{ $row->user->name }}&nbsp;<small>{{\Carbon\Carbon::parse($row->created_at)->format('d F Y H:i')}}</small>
                            </td>

                            <td>
                                <!-- Include action buttons -->
                                @include('pages.lead.columns._actions', ['lead' => $row])
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
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    <!-- lead modal -->
    <div class="modal fade" id="kt_modal_lead" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_lead_header">
                    <h2 class="fw-bold">Update Lead Information</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_lead_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="lead_id" name="lead_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_lead_scroll">
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
                                                        <!--begin::Lead Owner-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                            <span class="required">Lead Owner</span>
                                                        </label>
                                                        <select class="form-select" id="owner_id" name="owner_id" required data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Owner">
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
                                                        <!--end::Lead Owner-->
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <!--begin::Sales Representative-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                            <span class="required">Sales Representative</span>
                                                        </label>
                                                        <select class="form-select" id="sale_representative" name="sale_representative" required data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Sale Representative">
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
                                                        <!--end::Sales Representative-->
                                                    </div>

                                                    <!--begin::Lead Source-->
                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">Lead Source</label>
                                                        <select class="form-select" id="lead_source_id" name="lead_source_id" required data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Source">
                                                        @foreach($sources as $source)
                                                        <option value="{{$source->id}}">{{$source->source_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('lead_source_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!--end::Lead Source-->

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" required />
                                                        @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" required />
                                                        @error('last_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">Mobile</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" required />
                                                        @error('mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="fs-6 fw-semibold ">Phone</label>
                                                        <input type="text" class="form-control" id="phone" minlength="5" maxlength="25" name="phone" />
                                                        @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" required />
                                                        @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="fs-6 fw-semibold ">Utility Company</label>
                                                        <select class="form-select" id="utility_company_id" name="utility_company_id" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Company">
                                                            @foreach($utilityCompanies as $utilitycompany)
                                                            <option value="{{$utilitycompany->id}}">{{$utilitycompany->utility_company_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('utility_company_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <label class="fs-6 fw-semibold ">Call Center Representative</label>
                                                        <select class="form-select" id="call_center_representative" name="call_center_representative" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Representative">
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
                                                    <select name="country_id" id="country_id" onchange="getStates(this)" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a country">
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
                                                    <select class="form-control" id="state_id" name="state_id" onchange="getCities()" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a state">
                                                        @foreach($states as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">City</label>
                                                    <select class="form-control" name="city_id" id="city_id" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a city">
                                                        @foreach($cities as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('city_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Street</label>
                                                    <input type="text" class="form-control" id="street" name="street" />
                                                    @error('street')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Post Code</label>
                                                    <input type="text" class="form-control" id="zip" name="zip" />
                                                    @error('zip')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                                    <input type="text" class="form-control" id="address_1" name="address_1" requried />
                                                    @error('address_1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Address Line 2</label>
                                                    <input type="text" class="form-control" id="address_2" name="address_2" />
                                                    @error('address_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Address Information-->
                            </div>
                            <!--end::Accordion-->
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
    <!-- end lead modal -->

    <!--begin::Modal - View Lead Details-->
    <div class="modal fade" id="kt_modal_view_lead_comments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach">
                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Modal - New Address-->

    @push('scripts')
    <script>
        document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
            element.addEventListener('click', function () {
                Swal.fire({
                    text: 'Are you sure you want to delete?',
                    icon: 'warning',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var leadId = this.getAttribute('data-kt-lead-id');
                        var url = "{{ route('leads.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                leadId: leadId
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: response.message,
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
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the appointment.';

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
                    }
                });
            });
        });

        $('#kt_modal_lead_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = "{{ route('leads.update') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#kt_modal_lead').modal('hide');
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

        function lead_modal(element) {
            var leadId = $(element).data('kt-lead-id');
            var ownerId = $(element).data('kt-owner-id');
            var leadSourceId = $(element).data('kt-lead-source-id');
            var utitlityCompany = $(element).data('kt-utility-company-id');
            var firstName = $(element).data('kt-first-name');
            var lastName = $(element).data('kt-last-name');
            var saleRepresentative = $(element).data('kt-sale-representative');
            var callRepresentative = $(element).data('kt-call-center-representative');
            var mobile = $(element).data('kt-mobile');
            var phone = $(element).data('kt-phone');
            var email = $(element).data('kt-email');
            var countryId = $(element).data('kt-country-id');
            var stateId = $(element).data('kt-state-id');
            var cityId = $(element).data('kt-city-id');
            var street = $(element).data('kt-street');
            var zip = $(element).data('kt-zip');
            var address1 = $(element).data('kt-address-1');
            var address2 = $(element).data('kt-address-2');

            $('#lead_id').val(leadId);
            $('#owner_id').val(ownerId).trigger('change');
            $('#lead_source_id').val(leadSourceId).trigger('change');
            $('#utility_company_id').val(utitlityCompany).trigger('change');
            $('#call_center_representative').val(callRepresentative).trigger('change');
            $('#first_name').val(firstName);
            $('#last_name').val(lastName);
            $('#sale_representative').val(saleRepresentative).trigger('change');
            $('#mobile').val(mobile);
            $('#phone').val(phone);
            $('#email').val(email);
            $('#country_id').val(countryId).trigger('change');
                getStates(stateId);
            $('#state_id').on('change', function() {
                getCities(cityId);
            });
            $('#street').val(street);
            $('#zip').val(zip);
            $('#address_1').val(address1);
            $('#address_2').val(address2);
            $('#kt_modal_lead').modal('show');
        }

        // Function to get states based on selected country
        function getStates(selectedStateId = null) {
            var countryId = $('#country_id').val();
            var stateDropdown = $('#state_id');
            var cityDropdown = $('#city_id');
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
                        dropdownParent: $('#kt_modal_lead'),
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

        // Function to format state options with color
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

        // Function to get cities based on selected state
        function getCities(selectedCityId = null) {
            var stateId = $('#state_id').val();
            var cityDropdown = $('#city_id');
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

        // Reinitialize Select2 for all relevant fields
        $('#owner_id, #sale_representative, #lead_source_id, #utility_company_id, #call_center_representative, #country_id, #state_id, #city_id').select2({
            dropdownParent: $('#kt_modal_lead')
        });

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
    </script>

    @endpush

</x-default-layout>