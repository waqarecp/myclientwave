		<!--begin::Tables Widget 13-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Top Pages</span>
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
                                
                                <th class="min-w-550px">Dimension</th>
                                <th class="min-w-120px">Views</th>
                                <th class="min-w-120px">vs 1M ago</th>
                                <th class="min-w-120px">Total Users</th>
                                <th class="min-w-120px">vs 1M ago</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($paginator as $item)
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
                                <td   class="text-gray-900 fw-bold text-hover-primary fs-6">
                                    <span class="badge badge-light-{{ $item['users_comparison'] === 'down' ? 'danger' : 'success' }}  fs-base">
                                        <i class="ki-duotone ki-arrow-{{ $item['users_comparison'] }} fs-5 text-{{ $item['users_comparison'] === 'down' ? 'danger' : 'success' }} ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ $item['users_difference'] }}
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
                @if ($paginator->hasPages())
                <nav aria-label="Pagination">
                    <ul class="pagination">
            
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                            </li>
                        @endif
            
                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                        @endif
            
                        {{-- Pagination Elements --}}
                        {{-- Loop through $paginator->links() instead of $elements --}}
                        @foreach ($paginator->links() as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            @endif
            
            
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Tables Widget 13-->