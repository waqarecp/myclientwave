<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-stage-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read communication method'))
        <div class="menu-item px-3 d-none">
            <a href="{{ route('communication_methods.show', $communication_method) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write communication method'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-communication-method-id="{{ $communication_method->communication_method_id }}"
                data-kt-communication-method-name="{{ $communication_method->method_name }}"  onclick="update_communication_method_modal(this)">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write communication method') || auth()->user()->can('create communication method'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-communication-method-id="{{ $communication_method->communication_method_id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
</div>
<!--end::Menu-->
