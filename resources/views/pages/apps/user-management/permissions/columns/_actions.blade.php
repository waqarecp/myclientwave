@if(auth()->user()->can('write permission'))
    <button class="btn btn-icon btn-light-primary w-30px h-30px me-3 d-none" data-permission-id="{{ $permission->name }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
        {!! getIcon('pencil','fs-3') !!}
    </button>
@endif
@if(auth()->user()->can('write permission') || auth()->user()->can('create permission'))
<button class="btn btn-icon btn-light-danger w-30px h-30px d-none" data-permission-id="{{ $permission->name }}" data-kt-action="delete_row">
    {!! getIcon('trash','fs-3') !!}
</button>
@endif

<button type="button" onclick="alert('No need to perform this action! Thank you');" class="btn btn-icon btn-light-danger w-30px h-30px">
    <i class="fa fa-exclamation"></i>
</button>