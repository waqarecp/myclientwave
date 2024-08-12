<x-default-layout>

    @section('title')
        Lead Status
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('lead-statuses.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-leadstatus-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Lead status" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-leadstatus-table-toolbar="base">
                    <!--begin::Add leadstatus-->
                    @if(auth()->user()->can('create lead status'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_leadstatus">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New Lead Status
                    </button>
                    @endif
                    <!--end::Add leadstatus-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
            <!--begin::Modal-->
            <livewire:leadstatus.add-leadstatus-modal></livewire:leadstatus.add-leadstatus-modal>
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
                window.LaravelDataTables['leadstatus-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_leadstatus').modal('hide');
                    window.LaravelDataTables['leadstatus-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_leadstatus').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_leadstatus');
                Livewire.dispatch('reset_form');
            });
        </script>
    @endpush

</x-default-layout>
