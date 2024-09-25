<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../" />
	<title>CRM - MyClientWave</title>
	<meta charset="utf-8" />
	<meta name="description" content="CRM - MyClientWave" />
	<meta name="keywords" content="CRM - MyClientWave" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="CRM - MyClientWave" />
	<meta property="og:url" content="https://myclientwave.com" />
	<meta property="og:site_name" content="CRM - MyClientWave" />
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<script>
		// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
	</script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
	<!--begin::Header-->
	<div class="d-flex flex-center ">
		<!--begin::Logo-->
		<a href="/">
			<img alt="Logo" src="assets/media/logos/favicon.ico" class="h-70px" />
		</a>
		<h3 class=" fs-2">Company Registration Form</h3>
		<!--end::Logo-->
	</div>
	@if (session('success'))
	<div class="alert alert-success text-center">
		{{ session('success') }}
	</div>
	@endif

	@if (session('error'))
	<div class="alert alert-danger text-center">
		{{ session('error') }}
	</div>
	@endif
	<!--end::Header-->
	<!--begin::Wrapper-->
	<div class="container">
		<div class="row mx-auto">
			<!--begin::Form-->
			<form class="my-auto pb-5" method="POST" action="{{route('store-company')}}" id="kt_create_account_form">
				@csrf
				<input type="hidden" name="fcm_token" id="fcm_token" value="">
				<div class="row">
					<!--begin::Step 1-->
					<div class="col-md-6">
						<!--begin::Wrapper-->
						<div class="w-100">
							<!--begin::Input group-->
							<div class="fv-row">
								<!--begin::Row-->
								<div class="row">
									<!--begin::Col-->
									<div class="col-lg-6">
										<!--begin::Option-->
										<input type="radio" class="btn-check" name="company_account_type" value="1" checked="checked" id="kt_create_account_form_account_type_personal" />
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_personal">
											<i class="ki-duotone ki-badge fs-3x me-5">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
											<!--begin::Info-->
											<span class="d-block fw-semibold text-start">
												<span class="text-gray-900 fw-bold d-block fs-4 mb-2">Basic Account</span>
												<span class="text-muted fw-semibold fs-6">Limited access to CRM</span>
											</span>
											<!--end::Info-->
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-lg-6">
										<!--begin::Option-->
										<input type="radio" class="btn-check" name="company_account_type" value="2" id="kt_create_account_form_account_type_corporate" />
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="kt_create_account_form_account_type_corporate">
											<i class="ki-duotone ki-briefcase fs-3x me-5">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
											<!--begin::Info-->
											<span class="d-block fw-semibold text-start">
												<span class="text-gray-900 fw-bold d-block fs-4 mb-2">Advance Account</span>
												<span class="text-muted fw-semibold fs-6">Full access to CRM</span>
											</span>
											<!--end::Info-->
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Input group-->

							<!--begin::Input group-->
							<div class="row">
								<!--begin::Label-->
								<label class="d-flex align-items-center form-label mb-3">Specify Company Size
									<span class="ms-1" data-bs-toggle="tooltip" title="Provide company team size/ total employees count">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span></label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row mb-10" data-kt-buttons="true">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="company_employee_size" value="1" />
											<span class="fw-bold fs-3">1-10</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
											<input type="radio" class="btn-check" name="company_employee_size" checked="checked" value="2" />
											<span class="fw-bold fs-3">10-50</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="company_employee_size" value="3" />
											<span class="fw-bold fs-3">50-100</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="company_employee_size" value="4" />
											<span class="fw-bold fs-3">100+</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<div class="fv-row mb-10">
									<label class="form-label required">Write Business Name</label>
									<input name="company_business_name" required class="form-control form-control-lg" placeholder="Enter Company/Business Name" />
									@error('company_business_name')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								<div class="fv-row mb-10">
									<label class="d-flex align-items-center form-label">
										<span class="required">Write Company Address</span>
										<span class="lh-1 ms-1">
											<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</span>
									</label>
									<input name="company_address" placeholder="Write company address ..." class="form-control form-control-lg" required/>
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label required">Select Business Type</label>
								<select name="company_business_type" class="form-select form-select-lg" data-control="select2" data-placeholder="Select an option ..." data-allow-clear="true" data-hide-search="true">
									<option value=""></option>
									<option value="1">S Corporation</option>
									<option value="2">C Corporation</option>
									<option value="3">Sole Proprietorship</option>
									<option value="4">Non-profit</option>
									<option value="5">Limited Liability</option>
									<option value="6">General Partnership</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="w-100">
							<div class="row">
								<div class="fv-row mb-10 col-md-6">
									<label class="form-label">Contact Person Name</label>
									<input type="text" class="form-control form-control-lg" name="name" placeholder="Your Name or Contact Person Name" required />
									@error('name')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								<div class="fv-row mb-10 col-md-6">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label required">Contact Email</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input id="company_business_email" name="email" required class="form-control form-control-lg" placeholder="Enter Email Address" />
									@error('email')
									<span class="text-danger">{{ $message }}</span>
									@enderror
									<!--end::Input-->
								</div>
							</div>
							<div class="row">
								<div class="fv-row mb-10 col-md-6">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
										<span class="required">Business Phone</span>
									</label>
									<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required/>
									@error('phone')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								<div class="fv-row mb-10 col-md-6">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
										<span class="required">Enter a Password</span>
									</label>
									<!--end::Label-->
									<input type="text" class="form-control" placeholder="Enter your password" name="password" required/>
									@error('password')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="row mt-3">
								<div class="fv-row mb-10">
									<label class="form-label">About Business/ Company Information</label>
									<textarea name="company_business_description" placeholder="Enter details about the company" class="form-control form-control-lg" rows="7"></textarea>
								</div>
								<div class="col-md-12">
									<div class="fv-row mb-10">
										<label class="form-label required">Select Countries of operation</label>
										<select name="country_id[]" class="form-select form-select-lg" required multiple data-control="select2" data-placeholder="Select countries ..." data-allow-clear="true" data-hide-search="true">
											@foreach ($countries as $country)
											<option value="{{$country->id}}">{{$country->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="d-flex flex-stack">
										<div>
											<button type="button" id="register_company" class="btn btn-primary">
												<span class="indicator-label"><i class="fa fa-check-circle"></i> Create an Account</span>
											</button>

											<button id="wait_message" class="btn btn-primary d-none" disabled>
												<span class="indicator-label">Please wait...</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--end::Wrapper-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/";
		document.getElementById('register_company').addEventListener('click', function(e) {
			let form = document.getElementById('kt_create_account_form');

			// Disable the submit button and show "Please wait" only after validation
			if (form.checkValidity()) {
				$('#register_company').addClass('d-none');
				$('#wait_message').removeClass('d-none');
				// Submit the form after validation
				form.submit();
			} else {
				// If validation fails, trigger native form validation
				form.reportValidity();
			}
		});
	</script>

	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->

	<script src="{{ mix('js/app.js') }}"></script>
</body>
<!--end::Body-->

</html>