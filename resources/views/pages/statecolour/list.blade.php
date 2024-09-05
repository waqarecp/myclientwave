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
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-statecolour-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search state" id="mySearchInput" />
                </div>
                <!--end::Search-->
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
            <!--begin::Modal-->
            <livewire:statecolour.add-statecolour-modal></livewire:statecolour.add-statecolour-modal>
            <!--end::Modal-->
        </div>
        <!--end::Card header-->

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

    @push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        document.getElementById('mySearchInput').addEventListener('keyup', function() {
            window.LaravelDataTables['state-colour-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_state_colour').modal('hide');
                window.LaravelDataTables['state-colour-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_state_colour').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_statecolour');
            Livewire.dispatch('reset_form');
        });

        function getStates(element) {
            var countryId = $(element).val();
            var stateDropdown = $('select[name="state_id"]');
            var cityDropdown = $('select[name="city_id"]');
            stateDropdown.empty();
            cityDropdown.empty();
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

                    // Populate states dropdown
                    $.each(data.states, function(key, value) {
                        stateDropdown.append('<option value="' + key + '">' + value + '</option>');
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
    </script>
    @endpush

</x-default-layout>