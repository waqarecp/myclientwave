<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}" method="post">
        @csrf
        <input type="hidden" name="fcm_token" id="fcm_token" value="">
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <h1 class="text-gray-900 fw-bolder mb-3">Sign In To MyClientWave Dashboard</h1>
            <div class="text-gray-500 fw-semibold fs-6">Unlock Your Business Potential with MyClientWave's Dynamic Dashboard</div>
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value="" />
        </div>
        <!--end::Input group-->

        <div class="fv-row mb-5">
            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
        </div>
        <!--end::Input group-->

        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Sign In To CRM'])
            </button>
        </div>

        <div class="text-gray-500 text-center fw-semibold fs-6 mt-8">
            <br><br>
            Looking to Sign In to our CRM & don't have any account yet?
            <br><br>
        </div>
        
        <div class="text-gray-500 text-center fw-semibold fs-6">
            <a href="/" class="btn btn-sm btn-light-primary fw-semibold border border-dark">
                <i class="fa fa-home"></i> Visit our Website
            </a>
            <a href="{{route('register-company')}}" class="btn btn-sm btn-light-success flaot-end fw-semibold border border-success">
            <i class="fa fa-check-circle"></i> Register your Company
            </a>
        </div>
        <br>
    </form>
    <!--end::Form-->
</x-auth-layout>