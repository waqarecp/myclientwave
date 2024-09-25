<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-stage-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->company_id == "1" && App\Models\Role::where('company_id', '1')->where('id', '1')->first())
        <div class="menu-item px-3">
            <a href="{{ route('companies.show', $company) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(!$loop->first)
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-company-id="{{ $company->id }}" data-kt-company-name="{{ $company->name }}" data-kt-company-address="{{ $company->address }}" data-kt-company-account-type="{{ $company->company_account_type }}"
                data-kt-company-employee-size="{{ $company->company_employee_size }}" data-kt-company-account-plan="{{ $company->company_account_plan }}" data-kt-company-business-type="{{ $company->company_business_type }}"
                data-kt-company-business-description="{{ $company->company_business_description }}" onclick="update_company_modal(this)">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(!$loop->first)
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="javascript:void(0)" class="menu-link px-3" data-kt-company-id="{{ $company->id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
</div>
<!--end::Menu-->
