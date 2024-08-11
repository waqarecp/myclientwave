<!--begin::appointment details-->
<div class="d-flex flex-column">
    <a href="{{ route('calendars.show', $appointment) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ strlen($appointment->appointment_date) > 30 ? substr($appointment->appointment_date, 0, 30) . " ..." : $appointment->appointment_date }}
    </a>
</div>
<!--begin::appointment details-->
