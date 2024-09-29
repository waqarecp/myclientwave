<x-default-layout>

    @section('title')
    Deal Communication Methods
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('communication_methods.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form method="GET" action="{{ route('communication_methods.index') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control form-control-sm me-3">
                    <button type="submit" class="btn btn-primary btn-sm me-1">Search</button>
                    <a href="{{ route('communication_methods.index') }}" class="btn btn-secondary btn-sm me-1">Clear</a>
                </form>
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-communication-method-table-toolbar="base">
                    <!--begin::Add communication_method-->
                    @if(auth()->user()->can('create communication method'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_communication_method">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New Communication Method
                    </button>
                    @endif
                    <!--end::Add state-->
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
                            <th>Sr. No.</th>
                            <th>Communication Method</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($rows))
                        <?php $counter = 1; ?>
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>
                                {{ $row->method_name }}
                            </td>
                            <td>
                                {{ $row->creator->name}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')}}
                            </td>
                            <td>
                                <!-- Include action buttons -->
                                @include('pages.communication_methods.columns._actions', ['communication_method' => $row])
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
    <div class="modal fade" id="kt_modal_add_communication_method" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_communication_method_header">
                    <h2 class="fw-bold">Add New Communication Method</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_add_communication_method_form" class="form" action="#" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_communication_method_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_communication_method_header" data-kt-scroll-wrappers="#kt_modal_add_communication_method_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Communication Method Name</label>
                                    <input type="text" name="method_name" id="method_name" class="form-control form-control-solid border mb-3 mb-lg-0">
                                    @error('method_name')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="add_communication_method" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                            </button>

                            <button id="wait_message" class="btn btn-primary d-none" disabled>
                                <span class="indicator-label">Please wait...</span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- update modal -->
    <div class="modal fade" id="kt_modal_update_communication_method" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_communication_method_header">
                    <h2 class="fw-bold">Update Communication Method</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_update_communication_method_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="communication_method_id" name="communication_method_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_update_communication_method_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_communication_method_header" data-kt-scroll-wrappers="#kt_modal_update_communication_method_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Communication Method Name</label>
                                    <input type="text" name="update_method_name" id="update_method_name" class="form-control form-control-solid border mb-3 mb-lg-0">
                                    @error('update_method_name')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="update_communication_method" class="btn btn-primary">
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
        document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
            element.addEventListener('click', function () {
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
                        var communicationMethodId = this.getAttribute('data-kt-communication-method-id');
                        var url = "{{ route('communication_methods.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                communicationMethodId: communicationMethodId
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
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the Communication Method.';

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

        $('#kt_modal_add_communication_method_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#add_communication_method').addClass('d-none');
                $('#wait_message').removeClass('d-none');
                var formData = $(this).serialize();
                var url = "{{ route('communication_methods.store') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_add_communication_method').modal('hide');
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
                        // Show submit button again and hide "Please wait" message
                        $('#add_communication_method').removeClass('d-none');
                        $('#wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to save the Communication Method.';

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

        $('#kt_modal_update_communication_method_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#update_communication_method').addClass('d-none');
                $('#update_wait_message').removeClass('d-none');
                var formData = $(this).serialize();

                // Dynamically build the update route with the stage ID
                var url = "{{ route('communication_methods.update') }}";

                $.ajax({
                    type: 'Post',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_update_communication_method').modal('hide');
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
                        $('#update_communication_method').removeClass('d-none');
                        $('#update_wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to update the Communication Method.';

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

        function update_communication_method_modal(element) {
            var communicationMethodId = $(element).data('kt-communication-method-id');
            if (communicationMethodId) {
                var methodName = $(element).data('kt-communication-method-name');

                $('#communication_method_id').val(communicationMethodId);
                $('#update_method_name').val(methodName);
                
                $('#kt_modal_update_communication_method').modal('show');
            }
        }
    </script>
    @endpush

</x-default-layout>