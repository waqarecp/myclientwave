<x-default-layout>

    @section('title')
        Roles
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('user-management.roles.index') }}
    @endsection

    @if (session('error'))
        <div class="alert alert-danger col-md-6 offset-md-3">
            {{ session('error') }}
        </div>
    @endif
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <livewire:permission.role-list></livewire:permission.role-list>
    </div>
    <!--end::Content container-->

    <!--begin::Modal-->
    <livewire:permission.role-modal></livewire:permission.role-modal>
    <!--end::Modal-->

</x-default-layout>
