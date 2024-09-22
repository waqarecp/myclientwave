<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-stage-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read home type'))
        <div class="menu-item px-3 d-none">
            <a href="{{ route('home_types.show', $home_type) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write home type'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-home-type-id="{{ $home_type->home_type_id }}"
                data-kt-home-type-name="{{ $home_type->home_type_name }}"  onclick="update_home_type_modal(this)">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write home type') || auth()->user()->can('create home type'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-home-type-id="{{ $home_type->home_type_id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
</div>
<!--end::Menu-->
