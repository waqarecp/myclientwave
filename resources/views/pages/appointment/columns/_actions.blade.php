<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read appointment'))
        <div class="menu-item px-3">
            <a href="{{ route('appointments.show', $appointment) }}" class="menu-link px-3">
                View Appointment
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write appointment'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-appointment-id="{{ $appointment->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_appointment" data-kt-action="update_row">
                Edit Appointment
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write appointment') || auth()->user()->can('create appointment'))
    <!--begin::Menu item-->
    <div class="menu-item px-3 d-none">
        <a href="#" class="menu-link px-3" data-kt-appointment-id="{{ $appointment->id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
    
    <!--end::Menu item-->
    @if(auth()->user()->can('write appointment') || auth()->user()->can('create appointment'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="javascript:void(0)" class="menu-link px-3" data-kt-appointment-id="{{ $appointment->id }}" onclick="updateAppointmentTimeline('{{ $appointment->id }}')">
            Update Timeline
        </a>
    </div>
    @endif
    <!--end::Menu item-->
</div>
<!--end::Menu-->

<script src="{{asset('assets/js/custom/apps/ecommerce/settings/settings.js')}}"></script>
<script>
    function updateAppointmentTimeline(appointment_id, activeCommentsTab = false) {
        $.ajax({
            url: "{{ route('appointments.updateTimeline') }}", // Use the URL from the data attribute
            method: 'post',
            data: {
                appointment_id: appointment_id,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
            },
            success: function(data) {
                $('.kt_modal_attach_appointment_notes').html(data);
                $('#kt_modal_update_appointment_timeline').modal('show');
                if (activeCommentsTab) {
                    $('#update_followup .nav-item a').removeClass('active');
                    $('#update_followup .nav-item a').eq(1).addClass('active');
                    $('#appointment-note-content .tab-pane').removeClass('active show');
                    $('#appointment-note-content .tab-pane').eq(1).addClass('active show');
                }
            },
            error: function(data) {
                Swal.fire({
                    text: 'Failed to view Notes for this appointment!', 
                    icon: 'error',
                    confirmButtonText: "Close",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: "btn btn-light-danger"
                    }
                });
            }
        });
    }
</script>
