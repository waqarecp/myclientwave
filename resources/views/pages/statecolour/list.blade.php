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
    </script>
    @endpush

</x-default-layout>