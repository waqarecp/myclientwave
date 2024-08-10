<x-default-layout>

    @section('title')
        View Setting Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('integrations.settings.show', $setting) }}
    @endsection

    <!--begin::Layout-->
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-lg-350px w-xl-450px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::setting Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <div class="symbol-label fs-1 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $setting->platform_name) }}">
                                {{ substr($setting->platform_name, 0, 1) }}
                            </div>
                        </div>
                        <!--begin::Name-->
                        <a href="javascript:void(0)" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $setting->platform_name }}</a>
                        <!--end::Name-->
                    </div>
                    <!--end::setting Info-->
                    <!--end::Summary-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div id="kt_dealer_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Database ID # {{ $setting->id }} <span class="badge badge-light-{{ $setting->status == 1 ? 'success' : 'danger' }} fs-7 fw-semibold float-end">{{ $setting->status == 1 ? "Active" : "Inactive" }}</div>
                            <div class="fw-bold mt-5">Platform Name <span class="text-gray-800 float-end">{{ $setting->platform_name }}</span></div>
                            <div class="fw-bold mt-5">Dealer Name 
                            @if ($setting->dealer)
                                <span class="text-gray-800 float-end"> {{ $setting->dealer->dealerName }}</span>
                            @else
                                <span class="text-gray-800 float-end"> Not available</span>
                            @endif
                            <div class="fw-bold mt-5">API Key <span class="text-gray-800 float-end">{{ $setting->api_key ?: "---" }}</span></div>
                            <div class="fw-bold mt-5">API URL <span class="text-gray-800 float-end">{{ $setting->api_url ?: "---" }}</span></div>
                            <div class="fw-bold mt-5">Username <span class="text-gray-800 float-end">{{ $setting->username ?: "---" }}</span></div>
                            <div class="fw-bold mt-5">Password <span class="text-gray-800 float-end">{{ $setting->password ?: "---" }}</span></div>
                            <div class="fw-bold mt-5">Created Date : <small class="fw-normal float-end">{{ \Carbon\Carbon::parse($setting->created_at)->format('d F Y, g:i a') }}</small></div>
                            <div class="fw-bold mt-5">Last Updated Date : <small class="fw-normal float-end">{{ \Carbon\Carbon::parse($setting->updated_at)->format('d F Y, g:i a') }}</small></div>
                        </div>
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
    </div>
    <!--end::Layout-->
</x-default-layout>
