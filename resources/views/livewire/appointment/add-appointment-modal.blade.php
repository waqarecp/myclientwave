<div class="modal fade" id="kt_modal_add_appointment" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_appointment_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update Appointment' : 'Add New Appointment' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-2">
                <form
                    @if($this->edit_mode)
                    wire:submit.prevent="updateAppointment(Object.fromEntries(new FormData($event.target)))"
                    @else
                    wire:submit="createAppointment"
                    @endif
                    data-edit-mode="{{ $this->edit_mode ? 'edit' : 'add' }}" id="kt_modal_add_appointment_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="appointment_id" name="appointment_id" />
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_appointment_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_appointment_header" data-kt-scroll-wrappers="#kt_modal_add_appointment_scroll" data-kt-scroll-offset="200px">
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label class="required fw-semibold fs-6 mb-2">Lead</label>
                                <select data-dropdown-parent="body" wire:model.lazy="lead_id" id="lead_id" name="lead_id" aria-label="Select Lead" class="form-select form-select-solid border fw-semibold">
                                    <option value="">--- Select a Lead ---</option>
                                    @foreach($leads as $lead)
                                    <option value="{{$lead->id}}" data-street="{{$lead->street}}" data-city="{{$lead->city_id}}" data-state="{{$lead->state_id}}" data-zip="{{$lead->zip}}" data-country="{{$lead->country_id}}" data-address1="{{$lead->address_1}}" data-address2="{{$lead->address_2}}">{{$lead->first_name}} {{$lead->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('lead_id')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label class="required fw-semibold fs-6 mb-2">Call Center Representative</label>
                                <select data-dropdown-parent="body" wire:model.lazy="representative_user" name="representative_user" aria-label="Select Call Center Representative" class="form-select form-select-solid border fw-semibold">
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
                                <input placeholder="Enter Appointment Date" type="date" wire:model="appointment_date" name="appointment_date" class="form-control form-control-solid border mb-3 mb-lg-0" required />
                                @error('appointment_date')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Appointment Time</label>
                                <input placeholder="Enter Appointment Time" type="time" wire:model="appointment_time" name="appointment_time" class="form-control form-control-solid border mb-3 mb-lg-0" />
                                @error('appointment_time')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="required fs-6 fw-semibold ">Country</label>
                                <select wire:model="appointment_country_id" onchange="getStates()" class="form-select" name="appointment_country_id" id="appointment_country_id" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a country">
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
                                <select class="form-select" id="appointment_state_id" name="appointment_state_id" onchange="getCities(this)" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a state">
                                    <option value="">Select a State...</option>
                                    @foreach($states as $data)
                                    <option {{$this->appointment_state_id==$data->id ? 'selected' : ''}} value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('appointment_state_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="fs-6 fw-semibold ">City</label>
                                <select class="form-control" name="appointment_city_id" id="appointment_city_id" data-control="select2" data-dropdown-parent="#kt_modal_add_appointment" data-placeholder="Select a city">
                                    <option value="">Select a City...</option>
                                    @foreach($cities as $id => $name)
                                    <option {{$this->appointment_city_id==$id ? 'selected' : ''}} value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('appointment_city_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="fs-6 fw-semibold ">Street</label>
                                <input type="text" class="form-control" wire:model="appointment_street" name="appointment_street" id="appointment_street" />
                                @error('street')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="fs-6 fw-semibold ">Post Code</label>
                                <input type="text" class="form-control" wire:model="appointment_zip" name="appointment_zip" id="appointment_zip" />
                                @error('zip')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                <input type="text" class="form-control" wire:model="appointment_address_1" name="appointment_address_1" id="appointment_address_1" requried />
                                @error('address1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="fs-6 fw-semibold ">Address Line 2</label>
                                <input type="text" class="form-control" wire:model="appointment_address_2" name="appointment_address_2" id="appointment_address_2" />
                                @error('address2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-appointment-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>Submit</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        $('#lead_id').on('change', function(e) {
            Livewire.dispatch('getLeadAddress', {
                leadId: $(this).val()
            });
            setTimeout(function() {
                getStates();
            }, 1000)
        });
    });
    function getStates() {
        var countryId = $('#appointment_country_id').val();
        var stateDropdown = $('select[name="appointment_state_id"]');
        var cityDropdown = $('select[name="appointment_city_id"]');
        stateDropdown.empty();
        cityDropdown.empty();

        $.ajax({
            url: "{{ route('leads.getStates') }}", // Make sure this route matches your routes/web.php
            method: 'post',
            data: {
                countryId: countryId,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                stateDropdown.empty(); // Clear existing options
                stateDropdown.select2({
                    dropdownParent: $('#kt_modal_add_appointment') // Ensure dropdown appends to modal
                });

                // Populate states dropdown with color data attributes
                $.each(data.states, function(index, state) {
                    var option = $('<option></option>')
                        .val(state.id)
                        .text(state.name)
                        .attr('data-color', state.color_code); // Set data-color attribute

                    stateDropdown.append(option);
                });

                // Re-initialize Select2 for #state_id to apply the formatting
                stateDropdown.select2({
                    templateResult: formatStateColour,
                    templateSelection: formatStateColour,
                    dropdownParent: $('#kt_modal_add_appointment') // Ensure dropdown appends to modal
                });
            },
            error: function(data) {
                Swal.fire({
                    text: 'Failed to get states for this country!',
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

    // Function to format Select2 options with color
    function formatStateColour(state) {
        if (!state.id) {
            return state.text;
        }

        var color = $(state.element).data('color'); // Get the color from the data attribute

        // Create the formatted state element with a color badge
        var $state = $(
            '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + state.text + '</span>'
        );

        return $state;
    }

    function getCities(element) {
        var stateId = $(element).val();
        var cityDropdown = $('select[name="appointment_city_id"]');
        $.ajax({
            url: "{{ route('leads.getCities') }}", // Make sure this route matches your routes/web.php
            method: 'post',
            data: {
                stateId: stateId
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                cityDropdown.empty(); // Clear existing options

                // Populate states dropdown
                $.each(data.states, function(key, value) {
                    cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                });
            },
            error: function(data) {
                Swal.fire({
                    text: 'Failed to get cities for this states!',
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