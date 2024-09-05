<!--begin::state-colours details-->
<div class="d-flex flex-column">
    <b class="text-gray-800 mb-1">
        <span class="badge badge-circle w-15px h-15px me-1" style="background-color: {{ $statecolour->color_code }};"></span> {{ strlen($statecolour->state->name) > 30 ? substr($statecolour->state->name, 0, 30) . " ..." : $statecolour->state->name }}
    </b>
</div>
<!--begin::state-colours details-->
