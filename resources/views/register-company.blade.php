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
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="CRM - MyClientWave" />
	<link rel="canonical" href="http://authentication/extended/multi-steps-sign-up.html" />
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
							<div class="mb-10 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center form-label mb-3">Specify Team Size
									<span class="ms-1" data-bs-toggle="tooltip" title="Provide your team size.">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span></label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row mb-2" data-kt-buttons="true">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="company_employee_size" value="1-1" />
											<span class="fw-bold fs-3">1-1</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
											<input type="radio" class="btn-check" name="company_employee_size" checked="checked" value="2-10" />
											<span class="fw-bold fs-3">2-10</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="company_employee_size" value="10-50" />
											<span class="fw-bold fs-3">10-50</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="company_employee_size" value="50+" />
											<span class="fw-bold fs-3">50+</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<!--begin::Hint-->
								<div class="form-text">Customers will see this shortened version of your statement descriptor</div>
								<!--end::Hint-->
							</div>
							<!--end::Input group-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Step 1-->
					<!--begin::Step 2-->
					<div class="col-md-6">
						<!--begin::Wrapper-->
						<div class="w-100">
							<!--begin::Input group-->
							<div class="mb-10 fv-row">
								<!--begin::Label-->
								<label class="form-label mb-3">Team Account Name</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" class="form-control form-control-lg form-control-solid" name="name" />
								@error('name')
								<span class="text-danger">{{ $message }}</span>
								@enderror
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-0 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center form-label mb-5">Select Account Plan
									<span class="ms-1" data-bs-toggle="tooltip" title="CRM will be based on your account plan">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span></label>
								<!--end::Label-->
								<!--begin::Options-->
								<div class="mb-0">
									<!--begin:Option-->
									<label class="d-flex flex-stack mb-5 cursor-pointer">
										<!--begin:Label-->
										<span class="d-flex align-items-center me-2">
											<!--begin::Icon-->
											<span class="symbol symbol-50px me-6">
												<span class="symbol-label">
													<i class="ki-duotone ki-bank fs-1 text-gray-600">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
											</span>
											<!--end::Icon-->
											<!--begin::Description-->
											<span class="d-flex flex-column">
												<span class="fw-bold text-gray-800 text-hover-primary fs-5">Company Account</span>
											</span>
											<!--end:Description-->
										</span>
										<!--end:Label-->
										<!--begin:Input-->
										<span class="form-check form-check-custom form-check-solid">
											<input class="form-check-input" type="radio" name="company_account_plan" value="1" />
										</span>
										<!--end:Input-->
									</label>
									<!--end::Option-->
									<!--begin:Option-->
									<label class="d-flex flex-stack mb-5 cursor-pointer">
										<!--begin:Label-->
										<span class="d-flex align-items-center me-2">
											<!--begin::Icon-->
											<span class="symbol symbol-50px me-6">
												<span class="symbol-label">
													<i class="ki-duotone ki-chart fs-1 text-gray-600">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
											</span>
											<!--end::Icon-->
											<!--begin::Description-->
											<span class="d-flex flex-column">
												<span class="fw-bold text-gray-800 text-hover-primary fs-5">Developer Account</span>
												<span class="fs-6 fw-semibold text-muted">Use images to your post time</span>
											</span>
											<!--end:Description-->
										</span>
										<!--end:Label-->
										<!--begin:Input-->
										<span class="form-check form-check-custom form-check-solid">
											<input class="form-check-input" type="radio" checked="checked" name="company_account_plan" value="2" />
										</span>
										<!--end:Input-->
									</label>
									<!--end::Option-->
									<!--begin:Option-->
									<label class="d-flex flex-stack mb-0 cursor-pointer">
										<!--begin:Label-->
										<span class="d-flex align-items-center me-2">
											<!--begin::Icon-->
											<span class="symbol symbol-50px me-6">
												<span class="symbol-label">
													<i class="ki-duotone ki-chart-pie-4 fs-1 text-gray-600">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span>
											</span>
											<!--end::Icon-->
											<!--begin::Description-->
											<span class="d-flex flex-column">
												<span class="fw-bold text-gray-800 text-hover-primary fs-5">Testing Account</span>
												<span class="fs-6 fw-semibold text-muted">Use images to enhance time travel rivers</span>
											</span>
											<!--end:Description-->
										</span>
										<!--end:Label-->
										<!--begin:Input-->
										<span class="form-check form-check-custom form-check-solid">
											<input class="form-check-input" type="radio" name="company_account_plan" value="3" />
										</span>
										<!--end:Input-->
									</label>
									<!--end::Option-->
								</div>
								<!--end::Options-->
							</div>
							<!--end::Input group-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Step 2-->
				</div>
				<div class="row">
					<!--begin::Step 3-->
					<div class="col-md-6">
						<!--begin::Wrapper-->
						<div class="w-100">
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label required">Business Name</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input name="company_business_name" class="form-control form-control-lg form-control-solid" />
								@error('company_business_name')
								<span class="text-danger">{{ $message }}</span>
								@enderror
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="d-flex align-items-center form-label">
									<span class="required">Shortened Descriptor</span>
									<span class="lh-1 ms-1">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span>
								</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input name="company_business_descriptor" class="form-control form-control-lg form-control-solid" />
								<!--end::Input-->
								<!--begin::Hint-->
								<div class="form-text">Customers will see this shortened version of your statement descriptor</div>
								<!--end::Hint-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label required">Corporation Type</label>
								<!--end::Label-->
								<!--begin::Input-->
								<select name="company_business_type" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
									<option></option>
									<option value="1">S Corporation</option>
									<option value="2">C Corporation</option>
									<option value="3">Sole Proprietorship</option>
									<option value="4">Non-profit</option>
									<option value="5">Limited Liability</option>
									<option value="6">General Partnership</option>
								</select>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--end::Label-->
								<label class="form-label">Business Description</label>
								<!--end::Label-->
								<!--begin::Input-->
								<textarea name="company_business_description" class="form-control form-control-lg form-control-solid" rows="3"></textarea>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-0">
								<!--begin::Label-->
								<label class="fs-6 fw-semibold form-label required">Contact Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input name="email" class="form-control form-control-lg form-control-solid" />
								@error('email')
								<span class="text-danger">{{ $message }}</span>
								@enderror
								<!--end::Input-->
							</div>
							<!--end::Input group-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Step 3-->
					<!--begin::Step 4-->
					<div class="col-md-6">
						<!--begin::Wrapper-->
						<div class="w-100">
							<!--begin::Input group-->
							<div class="d-flex flex-column mb-7 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="required">Business Phone</span>
									<span class="ms-1" data-bs-toggle="tooltip" title="Specify a card holder's name">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" name="phone" />
								@error('phone')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="d-flex flex-column mb-7 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
									<span class="required">Password</span>
									<span class="ms-1">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="" name="password" />
								@error('password')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label required">Country</label>
								<!--end::Label-->
								<!--begin::Input-->
								<select name="country_id[]" class="form-select form-select-lg form-select-solid" multiple data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
									@foreach ($countries as $country)
									<option value="{{$country->id}}">{{$country->name}}</option>
									@endforeach
								</select>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<div class="d-flex flex-stack">
								<div>
									<button type="button" id="register_company" class="btn btn-primary">
										<span class="indicator-label">Submit</span>
									</button>

									<button id="wait_message" class="btn btn-primary d-none" disabled>
										<span class="indicator-label">Please wait...</span>
									</button>
								</div>
							</div>
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Step 4-->
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
	<!--end::Wrapper-->
	<!--begin::Javascript-->
	{!! NoCaptcha::renderJs() !!}
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