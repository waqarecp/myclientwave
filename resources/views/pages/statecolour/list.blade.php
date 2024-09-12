<x-default-layout>

    @section('title')
    State
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('state-colours.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form method="GET" action="{{ route('state-colours.index') }}" class="d-flex align-items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control form-control-sm me-3">
                    <button type="submit" class="btn btn-primary btn-sm me-1">Search</button>
                    <a href="/state-colours" class="btn btn-secondary btn-sm me-1">Clear</a>
                </form>
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-statecolour-table-toolbar="base">
                    <!--begin::Add statecolour-->
                    @if(auth()->user()->can('create state colour'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_state_colour">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New State
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
                            <th>ID</th>
                            <th>State Name</th>
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
                                <span class="badge badge-circle w-15px h-15px me-1" style="background-color: {{ $row->color_code }};"></span> {{ $row->state_name }}
                            </td>
                            <td>
                                {{ $row->user->name}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($row->created_at)->format('d F Y H:i')}}
                            </td>
                            <td>
                                <!-- Include action buttons -->
                                @include('pages.statecolour.columns._actions', ['statecolour' => $row])
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
    <div class="modal fade" id="kt_modal_add_state_colour" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_state_colour_header">
                    <h2 class="fw-bold">Add New State</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_add_state_colour_form" class="form" action="#" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_state_colour_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_state_colour_header" data-kt-scroll-wrappers="#kt_modal_add_state_colour_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Country</label>
                                    <select id="country_id" name="country_id" onchange="getStates()" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_state_colour" data-placeholder="Select a Country...">
                                        @foreach($countries as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">State</label>
                                    <select id="state_id" name="state_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_add_state_colour" data-placeholder="Select a State...">
                                        @if ($states)
                                        @foreach($states as $sId => $sName)
                                        <option value="{{ $sId }}">{{ $sName }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Pick Color</label>
                                    <input type="color" id="color" name="color_code" class="form-control form-control-solid border mb-3 mb-lg-0" style="height: 50px; width: 50px; padding: 0px; border-radius: 50% !important" />
                                    @error('color_code')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Create</span>
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
    <div class="modal fade" id="kt_modal_update_state_colour" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-450px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_state_colour_header">
                    <h2 class="fw-bold">Update State</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_update_state_colour_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="state_colour_id" name="state_colour_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_update_state_colour_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_state_colour_header" data-kt-scroll-wrappers="#kt_modal_update_state_colour_scroll" data-kt-scroll-offset="300px">
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Country</label>
                                    <select id="update_country_id" name="update_country_id" onchange="updateGetStates()" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_update_state_colour" data-placeholder="Select a Country...">
                                        @foreach($countries as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">State</label>
                                    <select id="update_state_id" name="update_state_id" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_update_state_colour" data-placeholder="Select a State...">
                                        @if ($states)
                                        @foreach($states as $sId => $sName)
                                        <option value="{{ $sId }}">{{ $sName }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="fv-row mb-7 col-md-12">
                                    <label class="required fw-semibold fs-6 mb-2">Pick Color</label>
                                    <input type="color" id="update_color_code" name="update_color_code" class="form-control form-control-solid border mb-3 mb-lg-0" style="height: 50px; width: 50px; padding: 0px; border-radius: 50% !important" />
                                    @error('color_code')
                                    <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
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
        $('#country_id, #state_id').select2({
            dropdownParent: $('#kt_modal_add_state_colour'),
        });

        $('#update_country_id, #update_state_id').select2({
            dropdownParent: $('#kt_modal_update_state_colour'),
        });

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
                        var stateColorId = this.getAttribute('data-kt-state-colour-id');
                        var url = "{{ route('state-colour.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                stateColorId: stateColorId
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
                                // Reload or update your appointments list here
                                location.reload();
                            },
                            error: function(xhr) {
                                // Parse the error response if any
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the state colour.';

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

        $('#kt_modal_add_state_colour_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = "{{ route('state-colour.store') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#kt_modal_add_state_colour').modal('hide');
                    Swal.fire({
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'Close',
                        customClass: {
                            confirmButton: 'btn btn-light-success'
                        }
                    });
                    // Reload or update your state colour list here
                    location.reload();
                },
                error: function(xhr) {
                    // Parse the error response if any
                    var errorMessage = xhr.responseJSON.error || 'Failed to save the state colour.';

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
        });

        $('#kt_modal_update_state_colour_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = "{{ route('state-colour.update') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#kt_modal_update_state_colour').modal('hide');
                    Swal.fire({
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'Close',
                        customClass: {
                            confirmButton: 'btn btn-light-success'
                        }
                    });
                    // Reload or update your state colour list here
                    location.reload();
                },
                error: function(xhr) {
                    // Parse the error response if any
                    var errorMessage = xhr.responseJSON.error || 'Failed to update the state colour.';

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
        });

        function update_state_color_modal(element) {
            var stateColorId = $(element).data('kt-state-colour-id');
            if (stateColorId) {
                var stateCountryId = $(element).data('kt-state-country-id');
                var stateId = $(element).data('kt-state-id');
                var stateColorCode = $(element).data('kt-state-colour-code');

                $('#state_colour_id').val(stateColorId);
                $('#update_country_id').val(stateCountryId).trigger('change');
                    updateGetStates(stateId);
                $('#update_state_id').val(stateId).trigger('change');
                $('#update_color_code').val(stateColorCode);
                
                $('#kt_modal_update_state_colour').modal('show');
            }
        }

        function getStates(selectedStateId = null) {
            var countryId = $('#country_id').val();
            var stateDropdown = $('select[name="state_id"]');
            stateDropdown.empty();
            $.ajax({
                url: "{{ route('stateColours.getStates') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    countryId: countryId,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.empty(); // Clear existing options

                    $('#state_id').select2({
                        dropdownParent: $('#kt_modal_add_state_colour'),
                        placeholder: 'Select a State...'
                    });
                    // Populate states dropdown
                    $.each(data.states, function(key, value) {
                        stateDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Set the selected state once the options are loaded
                    if (selectedStateId) {
                        stateDropdown.val(selectedStateId).trigger('change');
                    }
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
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

        function updateGetStates(selectedStateId = null) {
            var countryId = $('#update_country_id').val();
            var stateDropdown = $('select[name="update_state_id"]');
            stateDropdown.empty();
            $.ajax({
                url: "{{ route('stateColours.getStates') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    countryId: countryId,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.empty(); // Clear existing options

                    $('#state_id').select2({
                        dropdownParent: $('#kt_modal_update_state_colour'),
                        placeholder: 'Select a State...'
                    });
                    // Populate states dropdown
                    $.each(data.states, function(key, value) {
                        stateDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Set the selected state once the options are loaded
                    if (selectedStateId) {
                        stateDropdown.val(selectedStateId).trigger('change');
                    }
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
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
    @endpush

</x-default-layout>