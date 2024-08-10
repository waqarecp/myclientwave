<!--begin::Form-->
<form data-kt-search-element="form" class="w-100 position-relative mb-3" autocomplete="off">
<!--begin::Icon-->
{!! getIcon('magnifier', 'fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-0') !!} 
<!--end::Icon-->
<!--begin::Input-->
<input type="text" id="searchInput" class="search-input form-control form-control-flush ps-10" name="search" value="" placeholder="Search..." data-kt-search-element="input" />
<!--end::Input-->
<!--begin::Spinner-->
<span class="search-spinner position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1" data-kt-search-element="spinner">
	<span class="spinner-border h-15px w-15px align-middle text-gray-500"></span>
</span>
<!--end::Spinner-->
<!--begin::Reset-->
<span class="search-reset btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none" data-kt-search-element="clear">{!! getIcon('cross', 'fs-2 fs-lg-1 me-0') !!}</span>
<!--end::Reset-->
</form>
<!--end::Form-->
<!--begin::Separator-->
<div class="separator border-gray-200 mb-6"></div>
<!--end::Separator-->
