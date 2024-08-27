<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update User' : 'Add New User' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form @if($this->edit_mode)
                    wire:submit.prevent="updateAccount(Object.fromEntries(new FormData($event.target)))" data-edit-mode="edit"
                    @else
                    wire:submit="createAccount" data-edit-mode="add"
                    @endif
                     id="kt_modal_add_user_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="edit_mode" name="edit_mode"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{ image("svg/files/blank-image.svg") }}');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('{{ image("svg/files/blank-image-dark.svg") }}');
                                }
                            </style>
                            <div class="image-input image-input-outline image-input-placeholder {{ $avatar || $saved_avatar ? '' : 'image-input-empty' }}" data-kt-image-input="true">
                                @if($avatar)
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $avatar ? $avatar->temporaryUrl() : '' }});"></div>
                                @else
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $saved_avatar }});"></div>
                                @endif
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    {!! getIcon('pencil','fs-7') !!}
                                    <input type="file" wire:model="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    {!! getIcon('cross','fs-2') !!}
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    {!! getIcon('cross','fs-2') !!}
                                </span>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            @error('avatar')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                            <input type="text" wire:model="name" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" wire:model="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="{{ $this->edit_mode ? '' : 'required' }} fw-semibold fs-6 mb-2">Password</label> {{$this->edit_mode ? " (Leave empty if you don't want to update the password)" : ""}}
                            <input type="text" wire:model="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Enter account password" />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row mb-7">
                            <label class="required fw-semibold fs-6 mb-5">Role</label>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span> @enderror
                            @foreach($roles as $role)
                            <div class="col-md-6">
                                <div class="form-check form-check-custom form-check-solid btn btn-outline btn-outline-dashed p-3">
                                    <input class="form-check-input me-3" id="kt_modal_update_role_option_{{ $role->id }}" wire:model="role" name="role" type="radio" value="{{ $role->name }}" checked="checked" />
                                    <label class="form-check-label" for="kt_modal_update_role_option_{{ $role->id }}">
                                        <div class="fw-bold text-gray-800">
                                            {{ ucwords($role->name) }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row mb-7" wire:ignore>
                            <label for="child_users">Select Child Users</label>
                            <select data-dropdown-parent="body" wire:model.lazy="child_users" name="child_users[]" id="child_users" class="form-control form-select"  data-control="select2" data-search="true" data-placeholder="Select a User..." data-allow-clear="true" multiple="multiple">
                                @foreach($allUsers as $user)
                                    <option {{ in_array($user->id, (array) $child_users) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('child_users') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>Submit</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>