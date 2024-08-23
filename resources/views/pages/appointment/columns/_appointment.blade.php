<!--begin::appointment details-->
<div class="d-flex flex-column">
    <a href="{{ route('appointments.show', $appointment) }}" class="text-gray-800 text-hover-primary mb-1">
        {{\Carbon\Carbon::parse($appointment->appointment_date)->format('d F Y')}}
    </a>
</div>
<!--begin::appointment details-->
