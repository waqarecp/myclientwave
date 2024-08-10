<x-default-layout>

    @section('title')
    Logs
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('system') }}
    @endsection
    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <!--begin::Card-->
        <div class="card pt-4">
            <!--begin::Card header-->
            <div class="card-header border-0">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Logs</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-cloud-download fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Download Report</button>
                    <!--end::Button-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body py-0">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5" id="kt_table_userss_logs">
                        <!--begin::Table body-->
                        <tbody>
                                @foreach($logEntries as $logEntry)
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Badge=-->
                                <td class="min-w-70px">
                                    @php
                                    $badgeColor = 'light';
                                    if ($logEntry['errorCode'] == '500') {
                                        $badgeColor = 'danger';
                                    } elseif ($logEntry['errorCode'] == '200') {
                                        $badgeColor = 'success';
                                    } elseif ($logEntry['errorCode'] == '404') {
                                        $badgeColor = 'warning';
                                    } elseif ($logEntry['errorCode'] == '503' || $logEntry['errorCode'] == '504') {
                                        $badgeColor = 'info';
                                    } elseif ($logEntry['errorCode'] == '403') {
                                        $badgeColor = 'primary';
                                    } elseif ($logEntry['errorCode'] == '498' || $logEntry['errorCode'] == '577') {
                                        $badgeColor = 'secondary'; 
                                    }
                                @endphp
                                    <div class="badge badge-{{ $badgeColor }}">{{ $logEntry['errorCode'] }}</div>
                                </td>
                                <!--end::Badge=-->
                                <!--begin::Status=-->
                                <td>{{ $logEntry['errorMessage'] }}</td>
                                <!--end::Status=-->
                                <!--begin::Timestamp=-->
                                <td class="pe-0 text-end min-w-200px">{{ $logEntry['date'] }}</td>
                                <!--end::Timestamp=-->
                            </tr>
                            <!--end::Table row-->
                             @endforeach
                       
                        </tbody>
                        <!--end::Table body-->
                         
                    </table>
                    <div class="pagination-container mb-4">
                    {{ $logEntries->withPath('/logs')->links('pagination::bootstrap-4', ['route' => 'logs']) }}
                </div>
                  
                    
                    <!--end::Table-->
                </div>
              
                <!--end::Table wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

        <!--begin::Login sessions-->
        <div class="card mb-5 mb-lg-10">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Heading-->
                <div class="card-title">
                    <h3>Login Sessions</h3>
                </div>
                <!--end::Heading-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <div class="my-1 me-4">
                        <!--begin::Select-->
                        <select class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Hours" data-hide-search="true">
                            <option value="1" selected="selected">1 Hours</option>
                            <option value="2">6 Hours</option>
                            <option value="3">12 Hours</option>
                            <option value="4">24 Hours</option>
                        </select>
                        <!--end::Select-->
                    </div>
                    <a href="#" class="btn btn-sm btn-primary my-1">View All</a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-0">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                            <tr>
                            
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-150px">Device</th>
                                <th class="min-w-150px">IP Address</th>
                                <th class="min-w-150px">Time</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="fw-6 fw-semibold text-gray-600">
                            @foreach($sessions as $session)
                            <tr>
            
                                <td>
                                    @php
                                    $badgeColor = 'light';
                                    if ($session->status == 'success') {
                                        $badgeColor = 'success';
                                    } elseif ($session->status == 'Ended') {
                                        $badgeColor = 'danger';
                                    } 
                                    @endphp
                                    <span class="badge badge-light-{{ $badgeColor }} fs-7 fw-bold">{{ $session->status }}</span>
                                </td>
                                <td>{{ $session->device }}</td>
                                <td>{{ $session->ip_address }}</td>
                                <td>{{ $session->login_time }}</td>
                            </tr>
                           
                            @endforeach
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Login sessions-->
    </div>
    <!--end::Row-->
</x-default-layout>