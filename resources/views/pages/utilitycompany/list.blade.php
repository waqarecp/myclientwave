<x-default-layout>

    @section('title')
        Utility Company
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('utility-companies.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-utilitycompany-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Utility Company" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-utilitycompany-table-toolbar="base">
                    <!--begin::Add utilitycompany-->
                    @if(auth()->user()->can('create utility company'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_utilitycompany">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New utility company
                    </button>
                    @endif
                    <!--end::Add utilitycompany-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
            <!--begin::Modal-->
            <livewire:utilitycompany.add-utilitycompany-modal></livewire:utilitycompany.add-utilitycompany-modal>
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
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['utilitycompany-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_utilitycompany').modal('hide');
                    window.LaravelDataTables['utilitycompany-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_utilitycompany').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_utilitycompany');
                Livewire.dispatch('reset_form');
            });
        </script>
    @endpush

</x-default-layout>
