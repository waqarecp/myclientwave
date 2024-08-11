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
                    <input type="hidden" wire:model="appointment_id" name="appointment_id"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_appointment_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_appointment_header" data-kt-scroll-wrappers="#kt_modal_add_appointment_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label class="required fw-semibold fs-6 mb-2">Lead</label>
                                <select data-dropdown-parent="body" wire:model.lazy="lead_id" id="lead_id" name="lead_id" onchange="get_lead_address(this)" aria-label="Select Lead" class="form-select form-select-solid border fw-semibold">
                                    <option value="">Choose</option>
                                    @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" data-street="{{$lead->street}}" data-city="{{$lead->city}}" data-state="{{$lead->state}}" data-zip="{{$lead->zip}}" data-country="{{$lead->country}}">{{$lead->first_name}} {{$lead->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('lead_id')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label class="required fw-semibold fs-6 mb-2">Call Center Representative</label>
                                <select data-dropdown-parent="body" wire:model.lazy="representative_user" name="representative_user" aria-label="Select Call Center Representative" class="form-select form-select-solid border fw-semibold">
                                    <option value="">Choose</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('representative_user')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Appointment Date</label>
                                <input placeholder="Enter Appointment Date" type="date" wire:model="appointment_date" name="appointment_date" class="form-control form-control-solid border mb-3 mb-lg-0"/>
                                @error('appointment_date')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Appointment Time</label>
                                <input placeholder="Enter Appointment Time" type="time" wire:model="appointment_time" name="appointment_time" class="form-control form-control-solid border mb-3 mb-lg-0"/>
                                @error('appointment_time')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-12">
                                <label class="required fw-semibold fs-6 mb-2">Appointment Notes</label>
                                <input placeholder="Enter Appointment Notes" type="text" wire:model="appointment_notes" name="appointment_notes" class="form-control form-control-solid border mb-3 mb-lg-0"/>
                                @error('appointment_notes')
                                <span class="text-danger">{{ $message }}</span> @enderror
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