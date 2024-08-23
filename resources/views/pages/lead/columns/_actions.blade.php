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
            <a href="javascript:void(0)" class="menu-link px-3" data-kt-lead-id="{{ $lead->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_lead" data-kt-action="update_row">
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
</div>
<!--end::Menu-->
<script>
    function viewLeadComments(lead_id, activeCommentsTab = false) {
        $.ajax({
            url: "{{ route('leads.viewLeadComments') }}", // Use the URL from the data attribute
            method: 'post',
            data: {
                lead_id: lead_id,
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
            },
            success: function(data) {
                $('.kt_modal_attach').html(data);
                $('#kt_modal_view_lead_comments').modal('show');
                if (activeCommentsTab) {
                    $('#update_followup .nav-item a').removeClass('active');
                    $('#update_followup .nav-item a').eq(1).addClass('active');
                    $('#lead-comments-content .tab-pane').removeClass('active show');
                    $('#lead-comments-content .tab-pane').eq(1).addClass('active show');
                }
            },
            error: function(data) {
                Swal.fire({
                    text: 'Failed to view comments for this lead!', 
                    icon: 'error',
                    confirmButtonText: "Close",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: "btn btn-light-danger"
                    }
                });
            }
        });
    }
</script>
