
<!--begin::lead details-->
<div class="d-flex align-items-center">
    <a href="{{ route('leads.show', $lead) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ strlen($lead->first_name) > 30 ? substr($lead->first_name, 0, 30) . " ..." : $lead->first_name }}{{$lead->last_name}}
    </a>
</div>
<!--begin::lead details-->
