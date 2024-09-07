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
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-appointment-id="{{ $appointment->id }}" data-kt-appointment-lead-id="{{ $appointment->lead_id }}" data-kt-appointment-representative-user="{{ $appointment->representative_user }}" data-kt-appointment-date="{{ $appointment->appointment_date }}" data-kt-appointment-time="{{ $appointment->appointment_time }}" data-kt-appointment-country-id="{{ $appointment->appointment_country_id }}" data-kt-appointment-state-id="{{ $appointment->appointment_state_id }}" data-kt-appointment-city-id="{{ $appointment->appointment_city_id }}" data-kt-appointment-street="{{ $appointment->appointment_street }}" data-kt-appointment-zip="{{ $appointment->appointment_zip }}" data-kt-appointment-address-1="{{ $appointment->appointment_address_1 }}" data-kt-appointment-address-2="{{ $appointment->appointment_address_2 }}" onclick="appointment_modal(this)">
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
