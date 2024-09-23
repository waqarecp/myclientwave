<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Actions
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-stage-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    @if(auth()->user()->can('read deal'))
        <div class="menu-item px-3">
            <a href="{{ route('deals.show', $deal) }}" class="menu-link px-3">
                View
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write deal'))
    <!--begin::Menu item-->
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-deal-id="{{ $deal->deal_id }}" data-kt-project-administrator-id="{{ $deal->project_administrator_id }}" 
                data-kt-owner-id="{{ $deal->owner_id }}" data-kt-lead-id="{{ $deal->lead_id }}" data-kt-deal-name="{{ $deal->deal_name }}" 
                data-kt-deal-address="{{ $deal->deal_address }}" data-kt-deal-phone-1="{{ $deal->deal_phone_1 }}" data-kt-deal-email="{{ $deal->deal_email }}" 
                data-kt-financier-id="{{ $deal->financier_id }}" data-kt-home-type-id="{{ $deal->home_type_id }}" data-kt-source-id="{{ $deal->source_id }}" 
                data-kt-deal-account-name="{{ $deal->deal_account_name }}" data-kt-deal-contact-name="{{ $deal->deal_contact_name }}" data-kt-deal-phone-burner-last-call-outcome="{{ $deal->deal_phone_burner_last_call_outcome }}"
                data-kt-deal-social-lead-id="{{ $deal->deal_social_lead_id }}" data-kt-deal-amount="{{ $deal->deal_amount }}" data-kt-deal-closing-date="{{ $deal->deal_closing_date }}"
                data-kt-deal-pipeline="{{ $deal->deal_pipeline }}" data-kt-communication-method-id="{{ $deal->communication_method_id }}" data-kt-stage-id="{{ $deal->stage_id }}" 
                data-kt-deal-probability="{{ $deal->deal_probability }}" data-kt-deal-expected-revenue="{{ $deal->deal_expected_revenue }}" data-kt-deal-permit-number="{{ $deal->deal_permit_number }}" 
                data-kt-deal-phone-burner-followup-date="{{ $deal->deal_phone_burner_followup_date }}" data-kt-deal-phone-burner-last-call-time="{{ $deal->deal_phone_burner_last_call_time }}" data-kt-deal-availability-start="{{ $deal->deal_availability_start }}" 
                data-kt-deal-availability-end="{{ $deal->deal_availability_end }}"  data-kt-organization-id="{{ $deal->organization_id }}" onclick="update_deal_modal(this)">
                Edit
            </a>
        </div>
    @endif
    <!--end::Menu item-->
    @if(auth()->user()->can('write deal') || auth()->user()->can('create deal'))
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="javascript:void(0)" class="menu-link px-3" data-kt-deal-id="{{ $deal->deal_id }}" data-kt-action="delete_row">
            Delete
        </a>
    </div>
    @endif
    <!--end::Menu item-->
    
    @if(auth()->user()->can('write deal') || auth()->user()->can('create deal'))
        <div class="menu-item px-3">
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-deal-id="{{ $deal->deal_id }}" onclick="viewDealTimeline('{{ $deal->deal_id }}')">
                Timeline
            </a>
        </div>
    @endif
</div>
<!--end::Menu-->
