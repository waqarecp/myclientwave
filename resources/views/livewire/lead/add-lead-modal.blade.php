<div class="modal fade" id="kt_modal_add_lead" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_lead_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update Lead' : 'Add New Lead' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-2">
            <form
                    @if($this->edit_mode)
                        wire:submit.prevent="updateLead(Object.fromEntries(new FormData($event.target)))"
                    @else
                        wire:submit="createLead"
                    @endif
                     data-edit-mode="{{ $this->edit_mode ? 'edit' : 'add' }}" id="kt_modal_add_lead_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="lead_id" name="lead_id"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_lead_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_lead_header" data-kt-scroll-wrappers="#kt_modal_add_lead_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Accordion-->
                        <div class="accordion" id="leadAccordion">
                            <!--begin::Lead Information-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="leadInfoHeader">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#leadInfoCollapse" aria-expanded="true" aria-controls="leadInfoCollapse">
                                        Lead Information
                                    </button>
                                </h2>
                                <div id="leadInfoCollapse" class="accordion-collapse collapse show" aria-labelledby="leadInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!--begin::Lead Owner-->
                                                <div class="fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                        <span class="required">Lead Owner</span>
                                                    </label>
                                                    <select class="form-control form-control-solid form-control-sm" wire:model="owner_id" name="owner_id" required>
                                                        <option value="">Choose</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('owner_id')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Lead Owner-->
                                                
                                                <!--begin::Sales Representative-->
                                                <div class="fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                        <span class="required">Sales Representative</span>
                                                    </label>
                                                    <select class="form-control form-control-solid form-control-sm" wire:model="sale_representative" name="sale_representative" required>
                                                        <option value="">Choose</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sale_representative')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Sales Representative-->

                                                <div class="fv-row">
                                                    <label class="required fw-semibold fs-6">First Name</label>
                                                    <input placeholder="Enter First Name" type="text" wire:model="first_name" name="first_name" class="form-control form-control-sm form-control-solid border mb-lg-0"/>
                                                    @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="fv-row">
                                                    <label class="required fw-semibold fs-6">Last Name</label>
                                                    <input placeholder="Enter Last Name" type="text" wire:model="last_name" name="last_name" class="form-control form-control-sm form-control-solid border mb-lg-0"/>
                                                    @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <!--begin::Mobile-->
                                                <div class="fv-row">
                                                    <label class="required fs-6 fw-semibold ">Mobile</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="mobile" name="mobile"  minlength="11" maxlength="15" required/>
                                                    @error('mobile')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Mobile-->

                                                <!--begin::Phone-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">Phone</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="phone" name="phone" minlength="11" maxlength="15" />
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Phone-->

                                                <!--begin::Email-->
                                                <div class="fv-row">
                                                    <label class="required fs-6 fw-semibold ">Email</label>
                                                    <input type="email" class="form-control form-control-solid" wire:model="email" name="email"  required/>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Email-->
                                                
                                                <!--begin::Utility Company-->
                                                <div class="fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                        Utility Company
                                                    </label>
                                                    <select class="form-control form-control-solid form-control-sm" wire:model="utility_company_id" name="utility_company_id">
                                                        <option value="">Choose</option>
                                                        @foreach($utilitycompanies as $utilitycompany)
                                                            <option value="{{$utilitycompany->id}}">{{$utilitycompany->utility_company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('utility_company_id')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Utility Company-->
                                            </div>
                                            <div class="col-md-4">
                                                <!--begin::Call Center Representative-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">Call Center Representative</label>
                                                    <select class="form-control form-control-solid form-control-sm" wire:model="call_center_representative" name="call_center_representative">
                                                        <option value="">Choose</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('call_center_representative')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Call Center Representative-->

                                                <!--begin::Lead Status-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">Lead Status</label>
                                                    <select class="form-control form-control-solid form-control-sm" wire:model="lead_status" name="lead_status" required>
                                                        <option value="">Choose Status</option>
                                                        <option value="1">Fresh</option>
                                                        <option value="2">Site Survey</option>
                                                        <option value="3">Engineering Design</option>
                                                        <option value="4">Proposal</option>
                                                        <option value="5">System Details Finalized</option>
                                                        <option value="6">PO Received</option>
                                                        <option value="7">Cold</option>
                                                    </select>
                                                    @error('lead_status')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Lead Status-->

                                                <!--begin::Lead Source-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">Lead Source</label>
                                                    <select class="form-control form-control-solid form-control-sm" wire:model="lead_source_id" name="lead_source_id">
                                                        <option value="">Select</option>
                                                        @foreach($sources as $source)
                                                        <option value="{{$source->id}}">{{$source->source_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lead_source_id')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Lead Source-->

                                                <!--begin::Appointment Sat-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold mb-2" for="appointment_sat">Appointment Sat</label>
                                                    <input type="checkbox" class="form-check-input" id="appointment_sat" <?= $this->appointment_sat=='1' ? 'checked' : '' ?> wire:model="appointment_sat" name="appointment_sat" value="1" />
                                                    @error('appointment_sat')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Appointment Sat-->

                                                <!--begin::Appointment Date-->
                                                <div class="fv-row" id="appointment_date_group">
                                                    <label class="fs-6 fw-semibold ">Appointment Date</label>
                                                    <input type="date" class="form-control form-control-solid form-control-sm" wire:model="appointment_date" name="appointment_date" />
                                                    @error('appointment_date')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Appointment Date-->

                                                <!--begin::Appointment Time-->
                                                <div class="fv-row" id="appointment_time_group">
                                                    <label class="fs-6 fw-semibold ">Appointment Time</label>
                                                    <input type="time" class="form-control form-control-solid form-control-sm" wire:model="appointment_time" name="appointment_time" />
                                                    @error('appointment_time')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Appointment Time-->
                                            </div>
                                        </div>
								    </div>
							    </div>
						    </div>
						    <!--end::Lead Information-->

                            <!--begin::Address Information-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="addressInfoHeader">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addressInfoCollapse" aria-expanded="false" aria-controls="addressInfoCollapse">
                                        Address Information
                                    </button>
                                </h2>
                                <div id="addressInfoCollapse" class="accordion-collapse collapse" aria-labelledby="addressInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!--begin::Street-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">Street</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="street" name="street" />
                                                    @error('street')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Street-->

                                                <!--begin::City-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">City</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="city" name="city" />
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::City-->

                                                <!--begin::State-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">State</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="state" name="state" />
                                                    @error('state')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::State-->
                                            </div>
                                            <div class="col-md-4">
                                                <!--begin::ZIP Code-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">ZIP Code</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="zip" name="zip" />
                                                    @error('zip')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::ZIP Code-->

                                                <!--begin::Country-->
                                                <div class="fv-row">
                                                    <label class="fs-6 fw-semibold ">Country</label>
                                                    <input type="text" class="form-control form-control-solid form-control-sm" wire:model="country" name="country" />
                                                    @error('country')
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                                <!--end::Country-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Address Information-->
                            
                            <!--begin::Description Information-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="descriptionInfoHeader">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#descriptionInfoCollapse" aria-expanded="false" aria-controls="descriptionInfoCollapse">
                                        Description Information
                                    </button>
                                </h2>
                                <div id="descriptionInfoCollapse" class="accordion-collapse collapse" aria-labelledby="descriptionInfoHeader" data-bs-parent="#leadAccordion">
                                    <div class="accordion-body">
                                        <!--begin::Appointment Notes-->
                                        <div class="fv-row">
                                            <label class="fs-6 fw-semibold ">Appointment Notes</label>
                                            <textarea class="form-control form-control-solid" rows="3" wire:model="appointment_notes" name="appointment_notes"></textarea>
                                            @error('appointment_notes')
                                                <span class="text-danger">{{ $message }}</span> 
                                            @enderror
                                        </div>
                                        <!--end::Appointment Notes-->

                                        <!--begin::Notes-->
                                        <div class="fv-row">
                                            <label class="fs-6 fw-semibold ">Notes</label>
                                            <textarea class="form-control form-control-solid" rows="3" wire:model="notes" name="notes"></textarea>
                                            @error('notes')
                                                <span class="text-danger">{{ $message }}</span> 
                                            @enderror
                                        </div>
                                        <!--end::Notes-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Description Information-->
                        </div>
					    <!--end::Accordion-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-lead-modal-action="submit">
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