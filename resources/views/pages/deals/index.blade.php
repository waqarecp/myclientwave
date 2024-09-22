<x-default-layout>

    @section('title')
    Deals
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('deals.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form method="GET" action="{{ route('deals.index') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control form-control-sm me-3">
                    <button type="submit" class="btn btn-primary btn-sm me-1">Search</button>
                    <a href="{{ route('deals.index') }}" class="btn btn-secondary btn-sm me-1">Clear</a>
                </form>
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-deal-table-toolbar="base">
                    <!--begin::Add deal-->
                    @if(auth()->user()->can('create deal'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_deal">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New Deal
                    </button>
                    @endif
                    <!--end::Add stage-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light-primary">
                            <th>ID</th>
                            <th>Deal Name</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($rows))
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>
                                {{ $row->deal_name }}
                            </td>
                            <td>
                                {{ $row->creator->name}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')}}
                            </td>
                            <td>
                                <!-- Include action buttons -->
                                @include('pages.deals.columns._actions', ['deal' => $row])
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td align="center" colspan="7">There are no records in this list currently! Thank you</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Pagination Links -->
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!-- Add modal -->
    <div class="modal fade" id="kt_modal_add_deal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_deal_header">
                    <h2 class="fw-bold">Create New Deal</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_add_deal_form" class="form" action="#" enctype="multipart/form-data">
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_deal_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_deal_header"
                            data-kt-scroll-wrappers="#kt_modal_add_deal_scroll" data-kt-scroll-offset="300px">

                            <!-- Begin: Row 1 (left and right) -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Project Administrator -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Project Administrator</label>
                                        <select name="project_administrator_id" id="project_administrator_id" class="form-control form-select form-control-solid">
                                            @foreach($roles as $role)
                                            <optgroup label="{{ ucwords($role->name) }}">
                                                @foreach($users as $user)
                                                @if($user->roles->contains($role))
                                                <option data-child-users="{{ $user->child_users }}" value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Deal Owner -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Deal Owner</label>
                                        <select name="owner_id" id="owner_id" class="form-control form-select form-control-solid">
                                            @foreach($roles as $role)
                                                <optgroup label="{{ ucwords($role->name) }}">
                                                    @foreach($users as $user)
                                                    @if($user->roles->contains($role))
                                                    <option data-child-users="{{ $user->child_users }}" value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- lead -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lead</label>
                                        <select name="lead_id" id="lead_id" onchange="populateLeadAddress(this)" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Lead">
                                            <option value="">--- Select a Lead ---</option>
                                            @foreach($leads as $lead)
                                            <option value="{{$lead->id}}" data-name="{{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}" data-phone1="{{ $lead->phone }}" data-email="{{ $lead->email }}" data-address="{{(implode(', ', array_filter([
                                                optional($lead->country)->name,
                                                optional($lead->state)->name,
                                                optional($lead->city)->name,
                                                $lead->address_1,
                                                $lead->address_2,
                                                $lead->street,
                                                $lead->zip
                                            ])))}}">
                                                {{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Deal Name -->
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Deal Name</label>
                                        <input type="text" name="deal_name" id="deal_name" class="form-control form-control-solid" />
                                        @error('deal_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Address</label>
                                        <input type="text" name="deal_address" id="deal_address" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Phone 1 -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone 1</label>
                                        <input type="text" name="deal_phone_1" id="deal_phone_1" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Email -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Email</label>
                                        <input type="email" name="deal_email" id="deal_email" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Financier -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Financier</label>
                                        <select name="financier_id" id="financier_id" class="form-control form-select form-control-solid">
                                            <option value="">None</option>
                                            <!-- Dynamic options here -->
                                        </select>
                                    </div>

                                    <!-- Type -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Home Type</label>
                                        <select name="home_type_id" id="home_type_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($homeTypes as $homeType)
                                                <option value="{{ $homeType->id }}">
                                                    {{ $homeType->home_type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Lead Source -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lead Source</label>
                                        <select name="source_id" id="source_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($leadSources as $leadSource)
                                                <option value="{{ $leadSource->id }}">
                                                    {{ $leadSource->source_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Amount -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Amount</label>
                                        <input type="text" name="deal_amount" id="deal_amount" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Closing Date -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Closing Date</label>
                                        <input type="date" name="deal_closing_date" id="deal_closing_date" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Pipeline -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Pipeline</label>
                                        <select name="deal_pipeline" id="deal_pipeline" class="form-control form-select form-control-solid">
                                            <!-- Dynamic options here -->
                                        </select>
                                    </div>

                                    <!-- Stage -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Stage</label>
                                        <select name="stage_id" id="stage_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Stage">
                                            <option value="">-- Select --</option>
                                            @foreach($dealStages as $dealStage)
                                                <option value="{{ $dealStage->id }}" data-color="{{ $dealStage->stage_color_code }}">
                                                    {{ $dealStage->stage_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Probability -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Probability (%)</label>
                                        <input type="number" name="deal_probability" id="deal_probability" class="form-control form-control-solid" value="100" />
                                    </div>

                                    <!-- Expected Revenue -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Expected Revenue</label>
                                        <input type="text" name="deal_expected_revenue" id="deal_expected_revenue" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Permit Number -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Permit No.</label>
                                        <input type="text" name="deal_permit_number" id="deal_permit_number" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Availability Start & End -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Availability Start</label>
                                        <input type="time" name="deal_availability_start" id="deal_availability_start" class="form-control form-control-solid" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Availability End</label>
                                        <input type="time" name="deal_availability_end" id="deal_availability_end" class="form-control form-control-solid" />
                                    </div>

                                    <!-- Organization -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Organization</label>
                                        <select name="organization_id" id="organization_id" class="form-control form-select form-control-solid">
                                            <option value="">None</option>
                                            <!-- Dynamic options here -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End: Row 1 -->
                        </div>

                        <!-- Begin: Actions -->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="add_deal" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                            </button>
                            <button id="wait_message" class="btn btn-primary d-none" disabled>
                                <span class="indicator-label">Please wait...</span>
                            </button>
                        </div>
                        <!-- End: Actions -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <!-- update modal -->
    <div class="modal fade" id="kt_modal_update_deal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_deal_header">
                    <h2 class="fw-bold">Update Deal</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_update_deal_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="deal_id" name="deal_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_update_deal_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_deal_header" data-kt-scroll-wrappers="#kt_modal_update_deal_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Deal Name</label>
                                    <input type="text" name="update_deal_name" id="update_deal_name" class="form-control form-control-solid border mb-3 mb-lg-0">
                                    @error('update_deal_name')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="update_deal" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                            </button>

                            <button id="update_wait_message" class="btn btn-primary d-none" disabled>
                                <span class="indicator-label">Please wait...</span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    @push('scripts')
    <script>
        document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function(element) {
            element.addEventListener('click', function() {
                Swal.fire({
                    text: 'Are you sure you want to delete?',
                    icon: 'warning',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var dealId = this.getAttribute('data-kt-deal-id');
                        var url = "{{ route('deals.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                dealId: dealId
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Close',
                                    customClass: {
                                        confirmButton: 'btn btn-light-success'
                                    }
                                });
                                location.reload();
                            },
                            error: function(xhr) {
                                // Parse the error response if any
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the Deal.';

                                Swal.fire({
                                    text: errorMessage,
                                    icon: 'error',
                                    confirmButtonText: 'Close',
                                    customClass: {
                                        confirmButton: 'btn btn-light-danger'
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });

        $('#kt_modal_add_deal_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#add_deal').addClass('d-none');
                $('#wait_message').removeClass('d-none');
                var formData = $(this).serialize();
                var url = "{{ route('deals.store') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_add_deal').modal('hide');
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-success'
                            }
                        });
                        // Reload or update your deals list here
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show submit button again and hide "Please wait" message
                        $('#add_deal').removeClass('d-none');
                        $('#wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to save the Deal.';

                        Swal.fire({
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-danger'
                            }
                        });
                    }
                });
            } else {
                // If validation fails, trigger native HTML5 form validation
                this.reportValidity();
            }
        });

        $('#kt_modal_update_deal_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#update_deal').addClass('d-none');
                $('#update_wait_message').removeClass('d-none');
                var formData = $(this).serialize();

                // Dynamically build the update route with the stage ID
                var url = "{{ route('deals.update') }}";

                $.ajax({
                    type: 'Post',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_update_deal').modal('hide');
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-success'
                            }
                        });
                        // Reload or update your home_type list here
                        location.reload();
                    },
                    error: function(xhr) {
                        $('#update_deal').removeClass('d-none');
                        $('#update_wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to update the Deal.';

                        Swal.fire({
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-danger'
                            }
                        });
                    }
                });
            } else {
                // If validation fails, trigger native HTML5 form validation
                this.reportValidity();
            }
        });

        function update_deal_modal(element) {
            var dealId = $(element).data('kt-deal-id');
            if (dealId) {
                var methodName = $(element).data('kt-deal-name');

                $('#deal_id').val(dealId);
                $('#update_deal_name').val(methodName);

                $('#kt_modal_update_deal').modal('show');
            }
        }

        function populateLeadAddress(element) {
            var selectedOption = $(element).find('option:selected');
            var leadName = selectedOption.data('name'); 
            var leadAddress = selectedOption.data('address');
            var leadPhone1 = selectedOption.data('phone1');
            var leadEmail = selectedOption.data('email');
            $("#deal_name").val(leadName); 
            $("#deal_address").val(leadAddress);
            $("#deal_phone_1").val(leadPhone1);
            $("#deal_email").val(leadEmail);
        }

        $(document).ready(function() {
            $('#stage_id').select2({
                templateResult: formatStage,
                templateSelection: formatStage,
                dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
            });

            // Function to format Select2 options with color
            function formatStage(stage) {
                if (!stage.id) {
                    return stage.text;
                }
                var $stage = $(
                    '<span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color:' + $(stage.element).data('color') + '"></span>' + stage.text + '</span>'
                );
                return $stage;
            }

            // Re-initialize Select2 when the modal is shown
            $('#kt_modal_add_deal').on('shown.bs.modal', function() {
                $('#stage_id').select2({
                    templateResult: formatStage,
                    templateSelection: formatStage,
                    dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
                });
            });
        });
    </script>
    @endpush

</x-default-layout>