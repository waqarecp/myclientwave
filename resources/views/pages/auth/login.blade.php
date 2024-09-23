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
        <div class="fv-row mb-8">
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value="" />
        </div>
        <!--end::Input group-->

        <div class="fv-row mb-3">
            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
        </div>
        <!--end::Input group-->

        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Sign In'])
            </button>
        </div>
        <!--end::Submit button-->
        
        <div class="text-gray-500 text-center fw-semibold fs-6">
            <a href="/" class="btn btn-sm btn-primary fw-semibold">
                Go To Website
            </a>&nbsp;
            <a href="{{route('password.request')}}" class=" fw-semibold">
                Forgot Password?
            </a>
        </div>
        <br>
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Register Your Company

            <a href="{{route('register-company')}}" class="btn btn-sm btn-secondary flaot-end fw-semibold">
                Register Now
            </a>
        </div>
    </form>
    <!--end::Form-->
</x-auth-layout>