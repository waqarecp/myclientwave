<x-default-layout>

    @section('title')
    Lead
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('leads.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-lead-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Lead" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end d-none" data-kt-lead-table-toolbar="base">
                    <!--begin::Add lead-->
                    @if(auth()->user()->can('create lead source'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_lead">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New lead
                    </button>
                    @endif
                    <!--end::Add lead-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
            <!--begin::Modal-->
            <livewire:lead.add-lead-modal></livewire:lead.add-lead-modal>
            <!--end::Modal-->
        </div>
        <!--end::Card header-->
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    <!--begin::Modal - View Lead Details-->
    <div class="modal fade" id="kt_modal_view_lead_comments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach">

                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Modal - New Address-->

    @push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        document.getElementById('mySearchInput').addEventListener('keyup', function() {
            window.LaravelDataTables['lead-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_lead').modal('hide');
                window.LaravelDataTables['lead-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_lead').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_lead');
            Livewire.dispatch('reset_form');
        });
        function getStates(element) {
            var countryId = $(element).val();
            var stateDropdown = $('select[name="state_id"]');
            var cityDropdown = $('select[name="city_id"]');
            stateDropdown.empty();
            cityDropdown.empty();
            $.ajax({
                url: "{{ route('leads.getStates') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    countryId: countryId,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.empty(); // Clear existing options

                    stateDropdown.select2({
                        dropdownParent: $('#kt_modal_add_lead') // Ensure dropdown appends to modal
                    });

                    // Populate states dropdown with color data attributes
                    $.each(data.states, function(index, state) {
                        var option = $('<option></option>')
                            .val(state.id)
                            .text(state.name)
                            .attr('data-color', state.color_code); // Set data-color attribute

                        stateDropdown.append(option);
                    });

                    // Re-initialize Select2 for #state_id to apply the formatting
                    stateDropdown.select2({
                        templateResult: formatStateColour,
                        templateSelection: formatStateColour,
                        dropdownParent: $('#kt_modal_add_lead') // Ensure dropdown appends to modal
                    });
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
        // Function to format Select2 options with color
        function formatStateColour(state) {
            if (!state.id) {
                return state.text;
            }

            var color = $(state.element).data('color'); // Get the color from the data attribute

            // Create the formatted state element with a color badge
            var $state = $(
                '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + state.text + '</span>'
            );

            return $state;
        }
        // Re-initialize Select2 when the modal is shown
        $('#kt_modal_add_lead').on('shown.bs.modal', function() {
            // Initialize Select2 for #state_id on page load and when modal is shown
            $('#state_id').select2({
                templateResult: formatStateColour,
                templateSelection: formatStateColour,
                dropdownParent: $('#kt_modal_add_lead') // Ensure dropdown appends to modal
            });
        });
        function getCities(element) {
            var stateId = $(element).val();
            var cityDropdown = $('select[name="city_id"]');
            $.ajax({
                url: "{{ route('leads.getCities') }}", // Make sure this route matches your routes/web.php
                method: 'post',
                data: {
                    stateId: stateId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    cityDropdown.empty(); // Clear existing options

                    // Populate states dropdown
                    $.each(data.states, function(key, value) {
                        cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to get cities for this states!',
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