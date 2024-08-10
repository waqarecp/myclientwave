<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content rounded">
			<!--begin::Modal header-->
			<div class="modal-header pb-0 border-0 justify-content-end">
				<!--begin::Close-->
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">{!! getIcon('cross', 'fs-1') !!}</div>
				<!--end::Close-->
			</div>
			<!--begin::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
				<!--begin:Form-->
				<form id="kt_modal_new_target_form" class="form" method="POST" >
					@csrf
					<!--begin::Heading-->
					<div class="mb-13 text-center">
						<!--begin::Title-->
						<h1 class="mb-3">Set Legal Policies</h1>
						<!--end::Title-->
						<!--begin::Description-->
						<div class="text-muted fw-semibold fs-5">For more details, please review CRM 
							<a href="#" class="fw-bold link-primary">Terms and Conditions</a> and 
							<a href="#" class="fw-bold link-primary">Privacy Policy</a>.</div>
						<!--end::Description-->
					</div>
					<!--end::Heading-->
					<!--begin::Input group-->
					<div class="d-flex flex-column mb-8 fv-row">
						<!--begin::Label-->
						<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
							<span class="required">Target Title</span>
							<span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></span>
						</label>
						<!--end::Label-->
						<input type="text" class="form-control form-control-solid" placeholder="Enter Target Title" name="target_title" value="{{ isset($document) ? $document->title : '' }}"  disabled/>
					</div>
					<!--end::Input group-->

					<!--begin::Input group-->
					<div class="d-flex flex-column mb-8">
						<label class="fs-6 fw-semibold mb-2">Target Details</label>
						<textarea class="form-control form-control-solid" rows="4" name="target_details" placeholder="Type Target Details" id="editor">{{ isset($document) ? $document->content : '' }}</textarea>

					</div>
					<!--end::Input group-->
					<!--begin::Actions-->
					<div class="text-center">
										<button type="submit"  class="btn btn-primary">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait... 
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end:Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->
