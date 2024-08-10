<div class="modal fade" id="kt_modal_add_setting" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_setting_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update Settings' : 'Add New Settings' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-2">
            <form
                    @if($this->edit_mode)
                        wire:submit.prevent="updateSetting(Object.fromEntries(new FormData($event.target)))"
                    @else
                        wire:submit="createSetting"
                    @endif
                     data-edit-mode="{{ $this->edit_mode ? 'edit' : 'add' }}" id="kt_modal_add_setting_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="setting_id" name="setting_id"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_setting_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_setting_header" data-kt-scroll-wrappers="#kt_modal_add_setting_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            @error('dealer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="fv-row mb-7 col-md-6" wire:ignore>
                                <label for="dealer_id" class="required fw-semibold fs-6 mb-2">Select Dealer Account</label>
                                <select data-dropdown-parent="#kt_modal_add_setting" wire:model.lazy="dealer_id" tabindex="-1" id="dealer_id" name="dealer_id" aria-label="Select a Dealer" data-control="select2" data-placeholder="Select a Dealer..." class="form-select form-select-solid border fw-semibold">
                                    @foreach($dealers as $dealer)
                                        <option value="{{$dealer->id}}">{{$dealer->dealerName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Platform Name</label>
                                <input placeholder="Enter Platform Name" type="text" wire:model="platform_name" name="platform_name" class="form-control form-control-solid mb-3 mb-lg-0 border"/>
                                @error('platform_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">API Key</label>
                                <input placeholder="Enter API Key" type="text" wire:model="api_key" name="api_key" class="form-control form-control-solid mb-3 mb-lg-0 border"/>
                                @error('api_key')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6">
                                <label class="fw-semibold fs-6 mb-2">API URL</label>
                                <input placeholder="Enter API URL" type="text" wire:model="api_url" name="api_url" class="form-control form-control-solid mb-3 mb-lg-0 border"/>
                                @error('api_url')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6">
                                <label class="{{ $edit_mode && !$api_key ? 'required' : '' }} fw-semibold fs-6 mb-2">Username</label>
                                <input placeholder="Enter Username" type="text" wire:model="username" name="username" class="form-control form-control-solid mb-3 mb-lg-0 border"/>
                                @error('username')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7 col-md-6">
                                <label class="{{ $edit_mode && !$api_key ? 'required' : '' }} fw-semibold fs-6 mb-2">Password</label>
                                <input placeholder="Enter Password" type="text" wire:model="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0 border"/>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Status</label>
                                <select wire:model="status" name="status" class="form-control form-control-solid mb-3 mb-lg-0 border" style="appearance: auto;">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-setting-modal-action="submit">
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