<!--begin::stage details-->
<div class="d-flex flex-column">
    <b class="text-gray-800 mb-1">
        <span class="badge badge-circle w-15px h-15px me-1" style="background-color: {{ $stage->stage_color_code }};"></span> {{ strlen($stage->state_name) > 30 ? substr($stage->state_name, 0, 30) . " ..." : $stage->stage_name }}
    </b>
</div>
<!--begin::stage details-->
