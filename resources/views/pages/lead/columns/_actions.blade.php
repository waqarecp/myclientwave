<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read lead'))
        <div class="menu-item px-3">
            <a href="{{ route('leads.show', $lead) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write lead'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-lead-id="{{ $lead->id }}" data-kt-owner-id="{{ $lead->owner_id }}" data-kt-first-name="{{ $lead->first_name }}" 
                data-kt-last-name="{{ $lead->last_name }}" data-kt-sale-representative="{{ $lead->sale_representative }}" data-kt-mobile="{{ $lead->mobile }}" data-kt-phone="{{ $lead->phone }}" data-kt-email="{{ $lead->email }}" 
                data-kt-utility-company-id="{{ $lead->utility_company_id }}" data-kt-call-center-representative="{{ $lead->call_center_representative }}" data-kt-lead-source-id="{{ $lead->lead_source_id }}" data-kt-street="{{ $lead->street }}" data-kt-country-id="{{ $lead->country_id }}" 
                data-kt-state-id="{{ $lead->state_id }}" data-kt-city-id="{{ $lead->city_id }}" data-kt-zip="{{ $lead->zip }}" data-kt-address-1="{{ $lead->address_1 }}" data-kt-address-2="{{ $lead->address_2 }}" 
                onclick="lead_modal(this)">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write lead') || auth()->user()->can('create lead'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="javascript:void(0)" class="menu-link px-3" data-kt-lead-id="{{ $lead->id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
    
    <!--end::Menu item-->
    @if(auth()->user()->can('read lead') || auth()->user()->can('write lead') || auth()->user()->can('create lead'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="javascript:void(0)" class="menu-link px-3" data-kt-lead-id="{{ $lead->id }}" onclick="viewLeadComments('{{ $lead->id }}')">
            Lead Comments
        </a>
    </div>
    @endif
    <!--end::Menu item-->
    
    @if(auth()->user()->can('write deal') || auth()->user()->can('create deal'))
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-lead-id="{{ $lead->id }}" data-kt-lead-name="{{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}" onclick="convertLeadToDealForm(this)">
                Convert To Deal
            </a>
        </div>
    @endif

</div>
<!--end::Menu-->
