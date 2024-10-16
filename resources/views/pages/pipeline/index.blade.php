<x-default-layout>

    @section('title')
    Manage Pipelines
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <form method="GET" action="{{ route('pipeline.index') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control form-control-sm me-3">
                    <button type="submit" class="btn btn-primary btn-sm me-1">Search</button>
                    <a href="{{ route('pipeline.index') }}" class="btn btn-secondary btn-sm me-1">Clear</a>
                </form>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-table-toolbar="base">
                    @if(auth()->user()->can('create pipeline'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New Pipelines
                    </button>
                    @endif
                </div>
            </div>
        </div>
        
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light-primary">
                            <th>Sr. No.</th>
                            <th>Pipeline Name</th>
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
                                <span class="badge badge-circle w-15px h-15px me-1" style="background-color: {{ $row->pipeline_color_code }};"></span> {{ $row->pipeline_name }}
                            </td>
                            <td>
                                {{ $row->creator->name}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')}}
                            </td>
                            <td>
                                @include('pages.pipeline.columns._actions', ['data' => $row])
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
        </div>
    </div>
    <!-- Add modal -->
    <div class="modal fade" id="modal_add" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="modal_add_header">
                    <h2 class="fw-bold">Add New Pipeline</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="modal_add_form" class="form" action="#" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="modal_add_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_add_header" data-kt-scroll-wrappers="#modal_add_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Pipeline Name</label>
                                    <input type="text" name="pipeline_name" id="pipeline_name" class="form-control form-control-solid border mb-3 mb-lg-0">
                                    @error('pipeline_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="fv-row mb-7 col-md-12">
                                        <label class="required fw-semibold fs-6 mb-2">Pick Color</label>
                                        <input type="color" id="stage_color_code" name="pipeline_color_code" class="form-control form-control-solid border mb-3 mb-lg-0" style="height: 50px; width: 50px; padding: 0px; border-radius: 50% !important" />
                                        @error('pipeline_color_code')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="add_pipeline" class="btn btn-primary">
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
    <div class="modal fade" id="modal_update" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="modal_update_header">
                    <h2 class="fw-bold">Update Pipeline</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="modal_update_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="modal_update_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_update_header" data-kt-scroll-wrappers="#modal_update_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Pipeline Name</label>
                                    <input type="text" name="pipeline_name" id="update_pipiline_name" class="form-control form-control-solid border mb-3 mb-lg-0">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Pick Color</label>
                                    <input type="color" name="pipeline_color_code" id="update_pipeline_color_code" class="form-control form-control-solid border mb-3 mb-lg-0" style="height: 50px; width: 50px; padding: 0px; border-radius: 50% !important" />
                                    @error('update_pipeline_color_code')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="update_pipeline" class="btn btn-primary">
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
        document.querySelectorAll('[data-action="delete_row"]').forEach(function (element) {
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
                        var id = this.getAttribute('data-id');
                        var url = "{{ route('pipeline.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                id: id
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
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the record. Try again';

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

        $('#modal_add_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#add_pipeline').addClass('d-none');
                $('#wait_message').removeClass('d-none');
                var formData = $(this).serialize();
                var url = "{{ route('pipeline.store') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#modal_add').modal('hide');
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-success'
                            }
                        });
                        // Reload or update your organization list here
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show submit button again and hide "Please wait" message
                        $('#add_pipeline').removeClass('d-none');
                        $('#wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to save the Pipeline.';

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

        $('#modal_update_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#update_pipeline').addClass('d-none');
                $('#update_wait_message').removeClass('d-none');
                var formData = $(this).serialize();

                // Dynamically build the update route with the organization ID
                var url = "{{ route('pipeline.update') }}";

                $.ajax({
                    type: 'Post',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#modal_update').modal('hide');
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-success'
                            }
                        });
                        location.reload();
                    },
                    error: function(xhr) {
                        $('#update_pipeline').removeClass('d-none');
                        $('#update_wait_message').addClass('d-none');
                        var errorMessage = xhr.responseJSON.error || 'Failed to update the Pipeline.';

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

        function update_pipeline_modal(element) {
            var id = $(element).data('id');
            if (id) {
                var name = $(element).data('name');
                var color = $(element).data('pipeline-color-code');

                $('#id').val(id);
                $('#update_pipiline_name').val(name);
                $('#update_pipeline_color_code').val(color);

                
                $('#modal_update').modal('show');
            }
        }
    </script>
    @endpush

</x-default-layout>