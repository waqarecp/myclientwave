<!--begin::status details-->
<div class="d-flex flex-column">
    <a href="{{ route('lead-sources.show', $status) }}" class="text-gray-800 text-hover-primary mb-1">
    <span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color: {{ $status->color_code }};"></span> {{ strlen($status->status_name) > 30 ? substr($status->status_name, 0, 30) . " ..." : $status->status_name }}
    </a>
</div>
<!--begin::status details-->
