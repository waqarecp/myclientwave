<!--begin::leadsource details-->
<div class="d-flex flex-column">
    <a href="{{ route('lead-sources.show', $leadsource) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ strlen($leadsource->source_name) > 30 ? substr($leadsource->source_name, 0, 30) . " ..." : $leadsource->source_name }}
    </a>
</div>
<!--begin::leadsource details-->
