		<!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-500">{{ $card['dateRange'] }}</span>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ format_number((float) $card['number']) }}</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">{{ $card['title'] }}</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                <span class="badge badge-light-{{ $card['percentageChange'] < 1 ? 'danger' : 'success' }}  fs-base">
                <i class="ki-duotone ki-arrow-{{ $card['percentageChange'] < 1 ? 'down' : 'up' }} fs-5 text-{{ $card['percentageChange'] < 1 ? 'danger' : 'success' }} ms-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>{{ $card['percentageChange'] }}</span>
                <span class="fw-semibold fs-6 text-gray-500">{{ $card['comparisonText'] }}</span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->