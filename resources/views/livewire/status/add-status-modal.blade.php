
<div class="modal fade" id="kt_modal_add_status" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered mw-450px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_status_header">
                <h2 class="fw-bold">{{ $this->edit_mode ? 'Update Status' : 'Add New Status' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-2">
            <form
                    @if($this->edit_mode)
                        wire:submit.prevent="updateStatus(Object.fromEntries(new FormData($event.target)))"
                    @else
                        wire:submit="createStatus"
                    @endif
                     data-edit-mode="{{ $this->edit_mode ? 'edit' : 'add' }}" id="kt_modal_add_status_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" wire:model="status_id" name="status_id"/>
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_status_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_status_header" data-kt-scroll-wrappers="#kt_modal_add_status_scroll" data-kt-scroll-offset="300px">
                    <div class="row">
                            <div class="fv-row mb-7 col-md-12">
                                <label class="required fw-semibold fs-6 mb-2">Status Name</label>
                                <input placeholder="Enter Status Name" type="text" wire:model="status_name" name="status_name" class="form-control form-control-solid border mb-3 mb-lg-0"/>
                                @error('status_name')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="fv-row mb-7 col-md-12">
                                <label class="required fw-semibold fs-6 mb-2">Pick Color</label>
                                <input type="color" id="color" wire:model.defer="color_code" name="color_code" class="form-control form-control-solid border mb-3 mb-lg-0"  style="height: 50px; width: 50px; padding: 0px; border-radius: 50% !important"/>
                                @error('color_code')
                                <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-status-modal-action="submit">
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