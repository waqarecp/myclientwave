<!--begin::Modal - Upgrade plan-->
<div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-xl">
		<!--begin::Modal content-->
		<div class="modal-content rounded">
			<!--begin::Modal header-->
			<div class="modal-header justify-content-end border-0 pb-0">
				<!--begin::Close-->
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">{!! getIcon('cross', 'fs-1') !!}</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
				<!--begin::Heading-->
				<div class="mb-13 text-center">
					
					<h1 class="mb-3" id="target_title">{{ isset($document) ? $document->title : '' }}</h1>

				</div>
				<div class="text-muted fw-semibold fs-5" id="target_details">{{ isset($document) ? $document->content : '' }}</div>

				<!--end::Heading-->
				<!--begin::Actions-->
				<div class="d-flex flex-center flex-row-fluid pt-12">
					<button type="reset" class="btn btn-primary me-3" data-bs-dismiss="modal">Cancel</button>

				</div>
				<!--end::Actions-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - Upgrade plan-->
