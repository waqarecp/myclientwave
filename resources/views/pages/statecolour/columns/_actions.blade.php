<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-statecolour-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read state colour'))
        <div class="menu-item px-3 d-none">
            <a href="{{ route('state-colours.show', $statecolour) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write state colour'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3" data-kt-state-colour-id="{{ $statecolour->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_state_colour" data-kt-action="update_row">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write state colour') || auth()->user()->can('create state colour'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-state-colour-id="{{ $statecolour->id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
</div>
<!--end::Menu-->
