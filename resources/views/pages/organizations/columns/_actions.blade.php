<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-stage-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">

    @if(auth()->user()->can('write organization'))
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-id="{{ $data->organization_id }}"
                data-name="{{ $data->organization_name }}"  onclick="update_organization_modal(this)">
                Edit
            </a>
        </div>
    @endif

    @if(auth()->user()->can('write organization') || auth()->user()->can('create organization'))
    <div class="menu-item px-3">
        <a href="javascript:void(0)" class="menu-link px-3" data-id="{{ $data->organization_id }}" data-action="delete_row">
            Delete
        </a>
    </div>
    @endif

</div>