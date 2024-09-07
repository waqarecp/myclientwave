<div class="modal fade" id="kt_modal_add_state_colour" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-450px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_state_colour_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update State' : 'Add New State' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-2">
                <form
                    @if($this->edit_mode)
                    wire:submit.prevent="updateStateColour(Object.fromEntries(new FormData($event.target)))"
                    @else
                    wire:submit="createStateColour"
                    @endif
                    data-edit-mode="{{ $this->edit_mode ? 'edit' : 'add' }}" id="kt_modal_add_state_colour_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="statecolour_id" name="statecolour_id" />
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_state_colour_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_state_colour_header" data-kt-scroll-wrappers="#kt_modal_add_state_colour_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="fv-row mb-7 col-md-12">
                                <label class="required fw-semibold fs-6 mb-2">Country</label>
                                <select id="country_id" name="country_id" onchange="getStates(this)" wire:model="country_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_state_colour" data-placeholder="Select a Country...">
                                    @foreach($countries as $id => $name)
                                    <option {{ $this->country_id==$id ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-12">
                                <label class="required fw-semibold fs-6 mb-2">State</label>
                                <select id="state_id" name="state_id" wire:model="state_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_state_colour" data-placeholder="Select a State...">
                                    @if ($states)
                                        @foreach($states as $sId => $sName)
                                        <option value="{{ $sId }}" @if($sId == $state_id) selected @endif>{{ $sName }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('state_id')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-12">
                                <label class="required fw-semibold fs-6 mb-2">Pick Color</label>
                                <input type="color" id="color" wire:model.defer="color_code" name="color_code" class="form-control form-control-solid border mb-3 mb-lg-0" style="height: 50px; width: 50px; padding: 0px; border-radius: 50% !important" />
                                @error('color_code')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-state-colour-modal-action="submit">
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
        // Re-initialize Select2 when the modal is shown
        $('#kt_modal_add_state_colour').on('shown.bs.modal', function() {
            // Initialize Select2 for #state_id on page load and when modal is shown
            $('#country_id').select2({
                dropdownParent: $('#kt_modal_add_state_colour'),
                placeholder: 'Select a Country...'
            });
            $('#state_id').select2({
                dropdownParent: $('#kt_modal_add_state_colour'),
                placeholder: 'Select a State...'
            });
        });
        function getStates(element) {
            var countryId = $(element).val();
            var stateDropdown = $('select[name="state_id"]');
            stateDropdown.empty();
            $.ajax({
                url: "{{ route('stateColours.getStates') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    countryId: countryId,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.empty(); // Clear existing options
                    
                    $('#state_id').select2({
                        dropdownParent: $('#kt_modal_add_state_colour'),
                        placeholder: 'Select a State...'
                    });
                    // Populate states dropdown
                    $.each(data.states, function(key, value) {
                        stateDropdown.append('<option value="' + key + '">' + value + '</option>');
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
</script>