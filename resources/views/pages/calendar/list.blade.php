
<x-default-layout>
    <link rel="canonical" href="http://apps/calendar.html" />
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    @section('title')
     Calendar
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('calendars.index') }}
    @endsection
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">

        <!--begin::Modal-->
        <livewire:appointment.add-appointment-modal></livewire:appointment.add-appointment-modal>
        <!--end::Modal-->
    </div>
    <!--end::Card header-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <h2 class="card-title fw-bold d-none">Calendar</h2>
                    <div class="card-toolbar">
                        <!--begin::Add appointment-->
                        <!-- @if(auth()->user()->can('create appointment'))
                        <button class="btn btn-flex btn-primary" data-kt-calendar="add">
                            <i class="ki-duotone ki-plus fs-2"></i>Add Event</button>
                        @endif -->
                        <!--begin::Add appointment-->
                        @if(auth()->user()->can('create appointment'))
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_appointment">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Add New Event
                        </button>
                        @endif
                        <!--end::Add appointment-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <input type="hidden" id="calendar_data" value='{{ $calendarData }}'/>
                    <!--begin::Calendar-->
                    <div id="kt_calendar_app"></div>
                    <!--end::Calendar-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            <!--begin::Modal - New Product-->
            <div class="modal fade" id="kt_modal_add_event" tabindex-="1" aria-hidden="true" data-bs-focus="false">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="#" id="kt_modal_add_event_form">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Add Event</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold required mb-2">Event Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Event Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Event Location</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday" />
                                        <span class="form-check-label fw-semibold" for="kt_calendar_datepicker_allday">All Day</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2 required">Event Start Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Event Start Time</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2 required">Event End Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Event End Time</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">Cancel</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Modal - New Product-->
            <!--begin::Modal - New Product-->
            <div class="modal fade" id="kt_modal_view_event" tabindex="-1" data-bs-focus="false" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header border-0 justify-content-end">
                            <!--begin::Edit-->
                            <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Edit-->
                            <!--begin::Edit-->
                            <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </div>
                            <!--end::Edit-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-2x">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body pt-0 pb-20 px-lg-17">
                            <!--begin::Row-->
                            <div class="d-flex">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-calendar-8 fs-1 text-muted me-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                                <!--end::Icon-->
                                <div class="mb-9">
                                    <!--begin::Event name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></span>
                                        <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                    </div>
                                    <!--end::Event name-->
                                    <!--begin::Event description-->
                                    <div class="fs-6" data-kt-calendar="event_description"></div>
                                    <!--end::Event description-->
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-dot h-10px w-10px bg-success ms-2 me-7"></span>
                                <!--end::Bullet-->
                                <!--begin::Event start date/time-->
                                <div class="fs-6">
                                    <span class="fw-bold">Starts</span>
                                    <span data-kt-calendar="event_start_date"></span>
                                </div>
                                <!--end::Event start date/time-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="d-flex align-items-center mb-9 d-none">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-dot h-10px w-10px bg-danger ms-2 me-7"></span>
                                <!--end::Bullet-->
                                <!--begin::Event end date/time-->
                                <div class="fs-6">
                                    <span class="fw-bold">Ends</span>
                                    <span data-kt-calendar="event_end_date"></span>
                                </div>
                                <!--end::Event end date/time-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="d-flex align-items-center">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-geolocation fs-1 text-muted me-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Event location-->
                                <div class="fs-6" data-kt-calendar="event_location"></div>
                                <!--end::Event location-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                </div>
            </div>
            <!--end::Modal - New Product-->
            <!--end::Modals-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    @push('scripts')
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="assets/js/custom/apps/calendar/calendar.js"></script>
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_appointment').modal('hide');
                    window.location.reload();
                });
            });
            $('#kt_modal_add_appointment').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_appointment');
                Livewire.dispatch('reset_form');
            });
            // Listen for 'success' event emitted by Livewire
            Livewire.on('success', (message) => {
                // Reload the appointment-table datatable
                window.location.reload();
            });
             
        </script>
    @endpush

</x-default-layout>