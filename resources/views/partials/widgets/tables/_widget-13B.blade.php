		<!--begin::Tables Widget 13-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Campaign Breakdown</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Mar 1 - Mar 12</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted">
                                
                                <th class="min-w-150px">Campaign</th>
                                <th class="min-w-140px">Cost</th>
                                <th class="min-w-120px">vs 1M ago</th>
                                <th class="min-w-120px">Impressions</th>
                                <th class="min-w-120px">vs 1M ago</th>
                                <th class="min-w-120px">Clicks</th>
                                <th class="min-w-120px">vs 1M ago</th>
                                <th class="min-w-120px">CTR by Campaign</th>
                                <th class="min-w-120px">vs 1M ago</th>
                                <th class="min-w-120px">Avg. CPC</th>
                                <th class="min-w-120px text-end">vs 1M ago</th>
                                <th class="min-w-120px">Conv.</th>
                                <th class="min-w-120px text-end">vs 1M ago</th>
                                <th class="min-w-120px">Conversion Rate by Campaign</th>
                                <th class="min-w-120px text-end">vs 1M ago</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">{{ $item['dimension'] }}</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['sessions'] }}</a>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $item['sessions_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['sessions_comparison'] }} fs-5 text-{{ $item['sessions_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['sessions_difference'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['users'] }}</a>
                                </td>
                                <td class="text-gray-900 fw-bold text-hover-primary fs-6">
                                    <span class="badge badge-light-{{ $item['users_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['users_comparison'] }} fs-5 text-{{ $item['users_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['users_difference'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['views_per_session'] }}</a>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $item['views_per_session_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['views_per_session_comparison'] }} fs-5 text-{{ $item['views_per_session_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['views_per_session_difference'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['engagement_rate'] }}</a>
                                </td>
                                <td class="text-gray-900 fw-bold text-hover-primary fs-6">
                                    <span class="badge badge-light-{{ $item['engagement_rate_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['engagement_rate_comparison'] }} fs-5 text-{{ $item['engagement_rate_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['engagement_rate_difference'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['conversions'] }}</a>
                                </td>
                                <td class="text-end">
                                    <span class="badge badge-light-{{ $item['conversions_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['conversions_comparison'] }} fs-5 text-{{ $item['conversions_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['conversions_difference'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['conv'] }}</a>
                                </td>
                                <td class="text-end">
                                    <span class="badge badge-light-{{ $item['conv_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['conv_comparison'] }} fs-5 text-{{ $item['conv_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['conv_difference'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item['CRBC'] }}</a>
                                </td>
                                <td class="text-end">
                                    <span class="badge badge-light-{{ $item['CRBC_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['CRBC_comparison'] }} fs-5 text-{{ $item['CRBC_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['CRBC_difference'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            
                
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Tables Widget 13-->