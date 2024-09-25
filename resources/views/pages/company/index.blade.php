<x-default-layout>

    @section('title')
    Companies
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('companies.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form method="GET" action="{{ route('companies.index') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control form-control-sm me-3">
                    <select name="status" id="status" class="form-select form-select-sm me-3">
                        <option value="">Filter By Status</option>
                        <option {{ isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : ''}} value="1">Active</option>
                        <option {{ isset($_GET['status']) && $_GET['status'] == '2' ? 'selected' : ''}} value="2">Disabled</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm me-1">Search</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-sm me-1">Clear</a>
                </form>
            </div>
            <!--begin::Card title-->
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
                            <th>Company Name</th>
                            <th>Company Phone</th>
                            <th>Company Email</th>
                            <th>Company Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($rows))
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>
                                {{ $row->name }} <br>
                            </td>
                            <td>
                                {{ $row->phone }}
                            </td>
                            <td>
                                {{ $row->email }}
                            </td>
                            <td  class="status-badge">
                                @if($row->deleted_at)
                                    <span class="badge badge-danger">Disabled</span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </td>

                            <td>
                                {{\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')}}
                            </td>
                            <td>
                                <!-- Include action buttons -->
                                @include('pages.company.columns._actions', ['company' => $row])
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

    <!-- update modal -->
    <div class="modal fade" id="kt_modal_update_company" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_company_header">
                    <h2 class="fw-bold">Update Company</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_update_company_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="company_id" name="company_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_update_company_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_company_header" data-kt-scroll-wrappers="#kt_modal_update_company_scroll" data-kt-scroll-offset="300px">
                            <!-- Begin: Row 1 (left and right) -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-12">
                                    <div class="w-100">
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-6">
                                                    <!--begin::Option-->
                                                    <input type="radio" class="btn-check" name="account_type" value="1" checked="checked" id="kt_create_account_form_account_type_personal" />
                                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_personal">
                                                        <i class="ki-duotone ki-badge fs-3x me-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                        <!--begin::Info-->
                                                        <span class="d-block fw-semibold text-start">
                                                            <span class="text-gray-900 fw-bold d-block fs-4 mb-2">Basic Account</span>
                                                            <span class="text-muted fw-semibold fs-6">Limited access to CRM</span>
                                                        </span>
                                                        <!--end::Info-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-lg-6">
                                                    <!--begin::Option-->
                                                    <input type="radio" class="btn-check" name="account_type" value="2" id="kt_create_account_form_account_type_corporate" />
                                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="kt_create_account_form_account_type_corporate">
                                                        <i class="ki-duotone ki-briefcase fs-3x me-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <!--begin::Info-->
                                                        <span class="d-block fw-semibold text-start">
                                                            <span class="text-gray-900 fw-bold d-block fs-4 mb-2">Advance Account</span>
                                                            <span class="text-muted fw-semibold fs-6">Full access to CRM</span>
                                                        </span>
                                                        <!--end::Info-->
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row">
                                            <div class="fv-row mb-10">
                                                <label class="form-label required">Write Business Name</label>
                                                <input name="name" id="name" required class="form-control form-control-lg" placeholder="Enter Company/Business Name" />
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center form-label">
                                                    <span class="required">Write Company Address</span>
                                                    <span class="lh-1 ms-1">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <input name="address" id="address" placeholder="Write company address ..." class="form-control form-control-lg" required />
                                            </div>
                                            <div class="row">
                                                <!--begin::Row-->
                                                <div class="row mb-10 col-md-6">
                                                    <label class="form-label required">Select Company Size</label>
                                                    <select name="employee_size" id="employee_size" class="form-select form-select-lg">
                                                        <option value="">select</option>
                                                        <option value="1">1-10</option>
                                                        <option value="2">10-50</option>
                                                        <option value="3">50-100</option>
                                                        <option value="4">100+</option>
                                                    </select>
                                                </div>
                                                <!--end::Row-->
                                                <div class="fv-row mb-10 col-md-6">
                                                    <label class="form-label required">Select Business Type</label>
                                                    <select name="business_type" id="business_type" class="form-select form-select-lg">
                                                        <option value="">---select---</option>
                                                        <option value="1">S Corporation</option>
                                                        <option value="2">C Corporation</option>
                                                        <option value="3">Sole Proprietorship</option>
                                                        <option value="4">Non-profit</option>
                                                        <option value="5">Limited Liability</option>
                                                        <option value="6">General Partnership</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <div class="row mt-3">
                                                <div class="fv-row mb-10">
                                                    <label class="form-label">About Business/ Company Information</label>
                                                    <textarea name="description" id="description" placeholder="Enter details about the company" class="form-control form-control-lg" rows="7"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End: Row 1 -->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="update_company" class="btn btn-primary">
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
                        var companyId = this.getAttribute('data-kt-company-id');
                        var url = "{{ route('companies.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                companyId: companyId
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

                                // Find the row and update its status and button
                                var rowElement = document.querySelector(`[data-kt-company-id="${companyId}"]`).closest('tr');
                                rowElement.querySelector('.status-badge').innerHTML = '<span class="badge badge-danger">Disabled</span>'; // Update the badge

                                var buttonElement = rowElement.querySelector('[data-kt-action="delete_row"]');
                                buttonElement.setAttribute('data-kt-action', 'active_row'); // Change action to activate
                                buttonElement.innerHTML = 'Active'; // Update button text
                                buttonElement.classList.remove('menu-link-danger'); // Optional: adjust button styling if needed
                                buttonElement.classList.add('menu-link-success'); // Optional: adjust button styling if needed
                            },
                            error: function(xhr) {
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the Company.';
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

        document.querySelectorAll('[data-kt-action="active_row"]').forEach(function(element) {
            element.addEventListener('click', function() {
                Swal.fire({
                    text: 'Are you sure you want to Active?',
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
                        var companyId = this.getAttribute('data-kt-company-id');
                        var url = "{{ route('companies.active') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                companyId: companyId
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

                                // Find the row and update its status and button
                                var rowElement = document.querySelector(`[data-kt-company-id="${companyId}"]`).closest('tr');
                                rowElement.querySelector('.status-badge').innerHTML = '<span class="badge badge-success">Active</span>'; // Update the badge

                                var buttonElement = rowElement.querySelector('[data-kt-action="active_row"]');
                                buttonElement.setAttribute('data-kt-action', 'delete_row'); // Change action to delete
                                buttonElement.innerHTML = 'Disabled'; // Update button text
                                buttonElement.classList.remove('menu-link-success'); // Optional: adjust button styling if needed
                                buttonElement.classList.add('menu-link-danger'); // Optional: adjust button styling if needed
                            },
                            error: function(xhr) {
                                var errorMessage = xhr.responseJSON.error || 'Failed to active the Company.';
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


        $('#kt_modal_update_company_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#update_company').addClass('d-none');
                $('#update_wait_message').removeClass('d-none');
                var formData = $(this).serialize();
                var url = "{{ route('companies.update') }}";
                $.ajax({
                    type: 'Post',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_update_company').modal('hide');
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
                        $('#update_company').removeClass('d-none');
                        $('#update_wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to update the Company.';

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

        function update_company_modal(element) {
            var companyId = $(element).data('kt-company-id');
            
            if (companyId) {
                var companyName = $(element).data('kt-company-name');
                var companyAddress = $(element).data('kt-company-address');
                var companyAccountType = $(element).data('kt-company-account-type');
                var companyEmployeeSize = $(element).data('kt-company-employee-size');
                var companyBusinessType = $(element).data('kt-company-business-type');
                var companyBusinessDescription = $(element).data('kt-company-business-description');

                // Set the values in the modal form
                $('#company_id').val(companyId);
                $('#name').val(companyName);
                $('#address').val(companyAddress);
                $('#employee_size').val(companyEmployeeSize);
                $('#business_type').val(companyBusinessType).trigger('change'); // for select2 dropdown
                $('#description').val(companyBusinessDescription);

                // Set the company account type radio button
                $('input[name="account_type"]').prop('checked', false); // uncheck all first
                $('input[name="account_type"][value="' + companyAccountType + '"]').prop('checked', true);

                // Show the modal
                $('#kt_modal_update_company').modal('show');
            }
        }

    </script>
    @endpush

</x-default-layout>