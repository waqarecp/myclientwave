<x-default-layout>

    @section('title')
        View Stage Details
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
                    <!--begin::stage Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <div class="symbol-label fs-1 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $stage->stage_name) }}">
                                {{ substr($stage->stage_name, 0, 1) }}
                            </div>
                        </div>
                        <!--begin::Name-->
                        <a href="javascript:void(0)" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $stage->stage_name }}</a>
                        <!--end::Name-->
                    </div>
                    <!--end::state Info-->
                    <!--end::Summary-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div id="kt_dealer_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Database ID</div>
                            <div class="text-gray-600">ID-{{ $stage->id }}</div>
                            <div class="fw-bold mt-5">State Created Date</div>
                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($stage->created_at)->format('d F Y, g:i a') }}</div>
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
