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
	<div class="d-flex flex-center m-4">
		<!--begin::Logo-->
		<a href="/">
			<img alt="Logo" src="assets/media/logos/favicon.ico" class="h-80px" />
		</a>
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
					<!--begin::card-->
					<div class="card">
						<div class="card-body py-4">
							<!--begin::Plans-->
							<div class="d-flex flex-column">
								<!--begin::Heading-->
								<div class="mb-13 text-center">
									<h1 class="fs-2hx fw-bold mb-5">Choose Your Plan</h1>
								</div>
								<!--end::Heading-->
								<div class="row g-10">
										<label for="start_trial" class="btn btn-outline-primary"><input type="checkbox" name="start_trial" id="start_trial" value="1"> Start 14-day free trial</label>
									<!--begin::Col-->
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
												<!--begin::Heading-->
												<div class="mb-7 text-center">
													<!--begin::Title-->
													<h1 class="text-gray-900 mb-5 fw-bolder">Basic Plan</h1>
													<!--end::Title-->
													<!--begin::Description-->
													<div class="text-gray-600 fw-semibold mb-5">Optimal for 1-5 team size
														<br />and small businesses
													</div>
													<!--end::Description-->
													<!--begin::Price-->
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bold text-primary">15</span>
														<span class="fs-7 fw-semibold opacity-50">/
															<span>Mon</span></span>
													</div>
													<!--end::Price-->
												</div>
												<!--end::Heading--><!--begin::Features-->
												<div class="w-100 mb-10">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 10 Active Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 30 Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Features-->
												<!--begin::Select-->
												<input type="radio" class="btn-check" name="account_type" value="1" id="basic_plan" />
												<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="basic_plan">
													Choose Basic Plan
												</label>
												<!--end::Select-->
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->

									<!--begin::Col-->
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
												<!--begin::Heading-->
												<div class="mb-7 text-center">
													<!--begin::Title-->
													<h1 class="text-gray-900 mb-5 fw-bolder">Deluxe Plan</h1>
													<!--end::Title-->
													<!--begin::Description-->
													<div class="text-gray-600 fw-semibold mb-5">Optimal for 10+ team size
														<br />and growing companies
													</div>
													<!--end::Description-->
													<!--begin::Price-->
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bold text-primary">35</span>
														<span class="fs-7 fw-semibold opacity-50">/
															<span>Mon</span></span>
													</div>
													<!--end::Price-->
												</div>
												<!--end::Heading--><!--begin::Features-->
												<div class="w-100 mb-10">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 10 Active Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 30 Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Features-->
												<!--begin::Select-->
												<input type="radio" class="btn-check" name="account_type" value="2" id="deluxe_plan" />
												<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="deluxe_plan">
													Choose Deluxe Plan
												</label>
												<!--end::Select-->
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->

									<!--begin::Col-->
									<div class="col-xl-4">
										<div class="d-flex h-100 align-items-center">
											<!--begin::Option-->
											<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
												<!--begin::Heading-->
												<div class="mb-7 text-center">
													<!--begin::Title-->
													<h1 class="text-gray-900 mb-5 fw-bolder">Exclusive Plan</h1>
													<!--end::Title-->
													<!--begin::Description-->
													<div class="text-gray-600 fw-semibold mb-5">Optimal for 50+ team size
														<br />and large organizations
													</div>
													<!--end::Description-->
													<!--begin::Price-->
													<div class="text-center">
														<span class="mb-2 text-primary">$</span>
														<span class="fs-3x fw-bold text-primary">50</span>
														<span class="fs-7 fw-semibold opacity-50">/
															<span>Mon</span></span>
													</div>
													<!--end::Price-->
												</div>
												<!--end::Heading--><!--begin::Features-->
												<div class="w-100 mb-10">
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 10 Active Users</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Up to 30 Project Integrations</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Analytics Module</span>
													<i class="ki-duotone ki-check-circle fs-1 text-success">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Finance Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Accounting Module</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center mb-5">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Network Platform</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Unlimited Cloud Space</span>
													<i class="ki-duotone ki-cross-circle fs-1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</div>
												<!--end::Item-->
											</div>
											<!--end::Features-->
												<!--begin::Select-->
												<input type="radio" class="btn-check" name="account_type" value="3" id="exclusive_plan" />
												<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="exclusive_plan">
													Choose Exclusive Plan
												</label>
												<!--end::Select-->
											</div>
											<!--end::Option-->
										</div>
									</div>
									<!--end::Col-->
								</div>
							</div>
						</div>
					</div>
					<!--end::card-->
					<!--begin::Step 1-->
					<div class="col-md-6 mt-4">
						<!--begin::Wrapper-->
						<div class="w-100">
							<!--begin::Input group-->
							<div class="row mt-4">
								<!--begin::Label-->
								<label class="d-flex align-items-center form-label mb-3">Specify Company Size
									<span class="ms-1" data-bs-toggle="tooltip" title="Provide company team size/ total employees count">
										<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</span>
								</label>
								<!--end::Label-->
								<!--begin::Row-->
								<div class="row mb-10" data-kt-buttons="true">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="employee_size" value="1" />
											<span class="fw-bold fs-3">1-10</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
											<input type="radio" class="btn-check" name="employee_size" checked="checked" value="2" />
											<span class="fw-bold fs-3">10-50</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="employee_size" value="3" />
											<span class="fw-bold fs-3">50-100</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Option-->
										<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
											<input type="radio" class="btn-check" name="employee_size" value="4" />
											<span class="fw-bold fs-3">100+</span>
										</label>
										<!--end::Option-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
								<div class="fv-row mb-10">
									<label class="form-label required">Write Business Name</label>
									<input name="name" required class="form-control form-control-lg" placeholder="Enter Company/Business Name" />
									@error('name')
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
									<input name="address" placeholder="Write company address ..." class="form-control form-control-lg" required />
								</div>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label required">Select Business Type</label>
								<select name="business_type" class="form-select form-select-lg" data-control="select2" data-placeholder="Select an option ..." data-allow-clear="true" data-hide-search="true">
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
									<input type="text" class="form-control form-control-lg" name="contact_person_name" placeholder="Your Name or Contact Person Name" required />
									@error('name')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								<div class="fv-row mb-10 col-md-6">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label required">Contact Email</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input id="email" name="email" required class="form-control form-control-lg" placeholder="Enter Email Address" />
									@error('email')
									<span class="text-danger">{{ $message }}</span>
									@enderror
									<!--end::Input-->
								</div>
							</div>
							<div class="row">
								<div class="fv-row mb-6 col-md-6">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
										<span class="required">Business Phone</span>
									</label>
									<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required />
									@error('phone')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								<div class="fv-row mb-6 col-md-6">
									<!--begin::Label-->
									<label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
										<span class="required">Enter a Password</span>
									</label>
									<!--end::Label-->
									<input type="text" class="form-control" placeholder="Enter your password" name="password" required />
									@error('password')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="row mt-3">
								<div class="fv-row mb-10">
									<label class="form-label">About Business/ Company Information</label>
									<textarea name="description" placeholder="Enter details about the company" class="form-control form-control-lg" rows="8"></textarea>
								</div>
								<div class="col-md-12">
									<div class="fv-row mb-4">
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