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
                    <input type="hidden" wire:model="lead_id" name="lead_id" />
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_lead_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_lead_header" data-kt-scroll-wrappers="#kt_modal_add_lead_scroll" data-kt-scroll-offset="300px">
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
                                                    <select class="form-select" wire:model="owner_id" name="owner_id" required>
                                                        <option value="">Choose</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                                                    <select class="form-select" wire:model="sale_representative" name="sale_representative" required>
                                                        <option value="">--- Select a User ---</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                                                    <select class="form-select" wire:model="lead_source_id" name="lead_source_id" required>
                                                        <option value="">--- Select Lead Source ---</option>
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
                                                    <input type="text" class="form-control" wire:model="first_name" name="first_name" required />
                                                    @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold">Last Name</label>
                                                    <input type="text" class="form-control" wire:model="last_name" name="last_name" required />
                                                    @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Mobile</label>
                                                    <input type="text" class="form-control" wire:model="mobile" name="mobile" required />
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Phone</label>
                                                    <input type="text" class="form-control" wire:model="phone"  minlength="5" maxlength="25" name="phone" />
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Email</label>
                                                    <input type="email" class="form-control" wire:model="email" name="email" required />
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Utility Company</label>
                                                    <select class="form-select" wire:model="utility_company_id" name="utility_company_id">
                                                        <option value="">Choose</option>
                                                        @foreach($utilitycompanies as $utilitycompany)
                                                        <option value="{{$utilitycompany->id}}">{{$utilitycompany->utility_company_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('utility_company_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Call Center Representative</label>
                                                    <select class="form-select" wire:model="call_center_representative" name="call_center_representative">
                                                        <option value="">--- Select a User ---</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                                                <select name="country_id" wire:model="country_id" onchange="getStates(this)" data-dropdown-parent="#kt_modal_add_lead" data-placeholder="Select a Country..." class="form-select select2">
                                                    <option value="">Select a Country...</option>
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
                                                <select class="form-control" id="state_id" name="state_id" wire:model="state_id" onchange="getCities(this)" data-placeholder="Select a state">
                                                    <option value="">Select a State...</option>
                                                    @foreach($states as $data)
                                                        <option {{$this->state_id==$data->id ? 'selected' : ''}} value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">City</label>
                                                <select class="form-control" name="city_id" wire:model="city_id" data-control="select2" data-dropdown-parent="#kt_modal_add_lead" data-placeholder="Select a city">
                                                    <option value="">Select a City...</option>
                                                    @foreach($cities as $id => $name)
                                                        <option {{$this->city_id==$id ? 'selected' : ''}} value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">Street</label>
                                                <input type="text" class="form-control" wire:model="street" name="street" />
                                                @error('street')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">Post Code</label>
                                                <input type="text" class="form-control" wire:model="zip" name="zip" />
                                                @error('zip')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                                <input type="text" class="form-control" wire:model="address_1" name="address_1" requried/>
                                                @error('address_1')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="fs-6 fw-semibold ">Address Line 2</label>
                                                <input type="text" class="form-control" wire:model="address_2" name="address_2" />
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