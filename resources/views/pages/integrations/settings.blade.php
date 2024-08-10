<x-default-layout>

    @section('title')
    Settings
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('integrations') }}
    @endsection
    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <!--begin::API keys-->
        <div class="card">
            <!--begin::Header-->
            <div class="card-header card-header-stretch">
                <!--begin::Title-->
                <div class="card-title">
                    <h3>API Keys</h3>
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9" id="kt_api_keys_table">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                            <tr>
                                <th class="min-w-175px ps-9">Label</th>
                                <th class="min-w-250px px-0">API Key</th>
                                <th class="min-w-100px">Username</th>
                                <th class="min-w-100px">Password</th>
                                <th class="min-w-100px">Created</th>
                                <th class="min-w-100px">Status</th>
                                <th class="w-100px">Action</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            <tr>
                                <td class="ps-9">Google Anatytics</td>
                                <td data-bs-target="license" class="ps-0">fftt456765gjkkjhi83093985</td>
                                <td>---</td>
                                <td>---</td>
                                <td>April 20, 2024</td>
                                <td>
                                    <span class="badge badge-light-success fs-7 fw-semibold">Active</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9">Navitare</td>
                                <td data-bs-target="license" class="ps-0">ABJHJD787KKJBHJHJ88200DEF</td>
                                <td>---</td>
                                <td>---</td>
                                <td>Sep 27, 2023</td>
                                <td>
                                    <span class="badge badge-light-success fs-7 fw-semibold">Active</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9">Docs API Key</td>
                                <td data-bs-target="license" class="ps-0">fftt456765gjkkjhi83093985</td>
                                <td>---</td>
                                <td>---</td>
                                <td>Jul 09, 2023</td>
                                <td>
                                    <span class="badge badge-light-danger fs-7 fw-semibold">Inactive</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9">Twilio Account</td>
                                <td class="ps-0">---</td>
                                <td>twilioooadmin</td>
                                <td data-bs-target="license">pemm212nntwii!!</td>
                                <td>May 14, 2022</td>
                                <td>
                                    <span class="badge badge-light-success fs-7 fw-semibold">Active</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9">Remore Interface</td>
                                <td data-bs-target="license" class="ps-0">hhet6454788gfg555hhh4</td>
                                <td>---</td>
                                <td>---</td>
                                <td>Dec 30, 2019</td>
                                <td>
                                    <span class="badge badge-light-danger fs-7 fw-semibold">Inactive</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9">Github</td>
                                <td data-bs-target="license" class="ps-0">fftt456765gjkkjhi83093985</td>
                                <td>---</td>
                                <td>---</td>
                                <td>Dec 30, 2021</td>
                                <td>
                                    <span class="badge badge-light-success fs-7 fw-semibold">Active</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-9">Mail Chimp</td>
                                <td class="ps-0">---</td>
                                <td>user@mailchimp.com</td>
                                <td data-bs-target="license">ss8!81ckl3ss2023</td>
                                <td>Apr 25, 2024</td>
                                <td>
                                    <span class="badge badge-light-success fs-7 fw-semibold">Active</span>
                                </td>
                                <td>
                                    <button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light">
                                        <i class="ki-solid ki-copy fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::API keys-->
    </div>
    <!--end::Row-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="assets/js/custom/account/api-keys/api-keys.js"></script>
</x-default-layout>