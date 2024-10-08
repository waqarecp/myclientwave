<x-default-layout>

    @section('title')
    View Appointment Details
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('appointments.show', $appointment) }}
    @endsection
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" data-bs-target="#kt_appointment_information" href="javascript:void(0)">Appointment information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" data-bs-target="#kt_status_timeline" href="javascript:void(0)">Appointment Timeline</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_appointment_information" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $appointment->lead->first_name }} {{ $appointment->lead->last_name }}</h2>
                            <div class="fs-6 fw-semibold text-muted"> Appointment details for {{ $appointment->lead->first_name }} {{ $appointment->lead->last_name }}</div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">
                        <div class="separator"></div>
                        <div class="row">
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show col-md-6">
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Appointment ID</div>
                                    <div class="text-gray-600">{{ $appointment->id }}</div>
                                    <div class="fw-bold mt-5">Call Center Representative</div>
                                    <div class="text-gray-600">{{ $appointment->user->name }}</div>
                                    <div class="fw-bold mt-5">Appointment Created By</div>
                                    <div class="text-gray-600">{{ $appointment->user->name }}</div>
                                    <div class="fw-bold mt-5">Appointment Date</div>
                                    <div class="text-gray-600">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d F Y') }}</div>
                                    <div class="fw-bold mt-5">Appointment Time</div>
                                    <div class="text-gray-600">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i a') }}</div>
                                    <div class="fw-bold mt-5">Appointment Created Date</div>
                                    <div class="text-gray-600">{{ \Carbon\Carbon::parse($appointment->created_at)->format('d F Y, g:i a') }}</div>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_status_timeline" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $appointment->lead->first_name }} {{ $appointment->lead->last_name }}</h2>
                            <div class="fs-6 fw-semibold text-muted">Appointment status timeline</div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary align-self-center text-nowrap" data-kt-appointment-id="{{ $appointment->id }}" onclick="viewComments(this)" data-url="{{ route('appointments.viewComments') }}">Show All Comments</button>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">

                        <!--begin::Timeline-->
                        <div class="timeline timeline-border-dashed">
                            @foreach ($timelines as $timeline)                                                
                            <!--begin::Timeline item-->
                            <div class="timeline-item ">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                @if ($loop->last)
                                <div class="timeline-icon bg-light-primary">
                                    <i class="ki-duotone ki-calendar fs-2 text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                @else
                                <div class="timeline-icon bg-light">
                                    <i class="ki-duotone ki-check fs-2 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                @endif
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2 {{$loop->last ? 'fw-bolder text-primary' : ''}}">{{$timeline->status->status_name}}</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="me-2 fs-7">
                                                <span class="text-muted">
                                                    Added by
                                                </span>
                                                <b>{{ $timeline->user->name }}</b>
                                                <span class="text-muted">
                                                at {{\Carbon\Carbon::parse($timeline->created_at)->format('d F Y, g:i A')}}
                                                </span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                    <!--begin::Timeline details-->
                                    <div class="overflow-auto pb-5">
                                        <!--begin::Notice-->
                                        <div class="d-none notice d-flex {{$loop->last ? 'bg-light-primary border-primary' : 'border-gray-300'}} rounded border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-devices-2 fs-2tx text-primary me-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <!--end::Icon-->
                                            <!--begin::Comments-->
                                            <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                <div class="mb-3 mb-md-0 fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">Comments for {{$timeline->status->status_name}}</h4>
                                                    <div class="fs-6 text-gray-700 pe-7">Click to view comments while lead was at this stage!</div>
                                                </div>
                                            </div>
                                            <!--end::Comments-->
                                        </div>
                                        <!--end::Notice-->

                                        @if (count($timeline->timelineDocs) > 0)
                                        <div class="d-flex align-items-center p-5">
                                            @foreach ($timeline->timelineDocs as $index => $doc)
                                            @php
                                            $filePath = public_path('appointmentFileUploded/' . $doc->file_uploaded);
                                            $fileType = pathinfo($doc->file_uploaded, PATHINFO_EXTENSION);
                                            $fileSize = file_exists($filePath) ? number_format(filesize($filePath) / 1048576, 2) : '0.00'; // Convert bytes to MB if the file exists
                                            $icon = '';

                                            switch ($fileType) {
                                            case 'pdf':
                                            $icon = asset('assets/media/svg/files/pdf.svg');
                                            break;
                                            case 'doc':
                                            case 'docx':
                                            $icon = asset('assets/media/svg/files/doc.svg');
                                            break;
                                            case 'css':
                                            $icon = asset('assets/media/svg/files/css.svg');
                                            break;
                                            case 'jpg':
                                            case 'jpeg':
                                            $icon = asset('assets/media/svg/files/blank-image.svg');
                                            break;
                                            case 'png':
                                            $icon = asset('assets/media/svg/files/image.svg');
                                            break;
                                            default:
                                            $icon = asset('assets/media/svg/files/blank-image.svg'); // A default file icon
                                            break;
                                            }
                                            @endphp
                                            <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                                <img alt="" class="w-30px me-3" src="{{$icon}}">
                                                <div class="ms-1 fw-semibold" style="width: max-content;">
                                                    <a target="_blank" href="{{ asset('appointmentFileUploded/' . $doc->file_uploaded) }}" class="fs-6 text-hover-primary fw-bold">File Attachment {{ $index + 1 }}</a>
                                                    <div class="text-gray-500">{{ $fileSize }}mb</div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <!--end::Timeline details-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            @endforeach
                        </div>
                        <!--end::Timeline-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
    <!--begin::Modal - View Lead Details-->
    <div class="modal fade" id="kt_modal_view_comments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach_comments">
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - New Address-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getUrlParameter(name) {
                name = name.replace(/[\[\]]/g, '\\$&');
                const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
                const results = regex.exec(window.location.href);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }
            const showComments = getUrlParameter('show_comments');
            if (showComments !== null) {
                document.querySelector('a[data-bs-target="#kt_status_timeline"]').classList.add('active');
                document.querySelector('a[data-bs-target="#kt_appointment_information"]').classList.remove('active');
                document.getElementById('kt_status_timeline').classList.add('show', 'active');
                document.getElementById('kt_appointment_information').classList.remove('show', 'active');
                const buttons = document.querySelectorAll('button[data-kt-appointment-id]');
                if (buttons.length > 0) {
                    const lastButton = buttons[buttons.length - 1];
                    lastButton.click();
                }
            }
        });

        function viewComments(element) {
            var appointment_id = $(element).attr('data-kt-appointment-id');
            var url = $(element).data('url'); // Get the URL from the data-url attribute
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    appointment_id: appointment_id,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('.kt_modal_attach_comments').html(data);
                    $('#kt_modal_view_comments').modal('show');
                },
                error: function(data) {
                    alert("Error code : " + data.status + " , Error message : " + data.statusText);
                }
            });
        };
    </script>
</x-default-layout>