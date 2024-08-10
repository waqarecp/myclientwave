<x-default-layout>

    @section('title')
        Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('integrations.settings.index') }}
    @endsection
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-setting-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search settings here ..." id="mySearchInput"/>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-setting-table-toolbar="base">
                    @if(auth()->user()->can('create settings'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_setting">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add New settings
                    </button>
                    @endif
                </div>
            </div>

            <!--begin::Modal-->
            <livewire:setting.add-setting-modal></livewire:setting.add-setting-modal>
            <!--end::Modal-->

        </div>
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}


        <script src="{{ asset('assets/js/custom/account/api-keys/api-keys.js') }}"></script>
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['setting-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_setting').modal('hide');
                    window.LaravelDataTables['setting-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_setting').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_setting');
                Livewire.dispatch('reset_form');
            });

            $('#kt_modal_add_setting').on('shown.bs.modal', function () {
                $('#dealer_id').select2();
                $('#dealer_id').trigger('change');
            });

            document.addEventListener('livewire:init', () => {
                $('#dealer_id').on('change', function (e) {
                    Livewire.dispatch('setDealerId', { selectedDealerId: $(this).val() });
                });
            });
        </script>
    @endpush

</x-default-layout>
