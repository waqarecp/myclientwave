<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-stage-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read stage'))
        <div class="menu-item px-3 d-none">
            <a href="{{ route('stages.show', $stage) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write stage'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-stage-id="{{ $stage->stage_id }}"
                data-kt-stage-name="{{ $stage->stage_name }}" data-kt-stage-colour-code="{{ $stage->stage_color_code }}" onclick="update_stage_modal(this)">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write stage') || auth()->user()->can('create stage'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-stage-id="{{ $stage->stage_id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
</div>
<!--end::Menu-->
