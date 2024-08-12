<!--begin::leadstatus details-->
<div class="d-flex flex-column">
    <a href="{{ route('lead-sources.show', $leadstatus) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ strlen($leadstatus->status_name) > 30 ? substr($leadstatus->status_name, 0, 30) . " ..." : $leadstatus->status_name }}
    </a>
</div>
<!--begin::leadstatus details-->
