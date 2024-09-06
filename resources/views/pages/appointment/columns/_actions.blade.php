<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
    @if(auth()->user()->can('read appointment'))
        <div class="menu-item px-3">
            <a href="{{ route('appointments.show', $appointment->id) }}" class="menu-link px-3">
                View Appointment
            </a>
        </div>
    @endif
    @if(auth()->user()->can('write appointment'))
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-appointment-id="{{ $appointment->id }}" onclick="appointment_modal(this)">
                Edit Appointment
            </a>
        </div>
    @endif
    @if(auth()->user()->can('write appointment') || auth()->user()->can('create appointment'))
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-appointment-id="{{ $appointment->id }}" onclick="updateAppointmentTimeline('{{ $appointment->id }}')">
                Update Timeline
            </a>
        </div>
    @endif
</div>
<!--end::Menu-->
