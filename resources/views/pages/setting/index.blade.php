<x-default-layout>

    @section('title')
    Setting
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('settings') }}
    @endsection
    <div class="card" id="kt_setting">
        <!--begin::Card body-->
        <div class="row">
            @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
            @endif
        </div>
        <div class="card-body py-4">
            <form id="kt_setting_form" class="form" method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label class="required fs-6 fw-semibold ">Country</label>
                        <select class="form-select" name="country_id[]" id="country_id" multiple data-control="select2" data-dropdown-parent="#kt_setting" data-placeholder="Select a country">
                            @foreach($countries as $id => $name)
                                <option value="{{ $id }}" {{ in_array($id, $selectedCountryIds ?? []) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 pt-9">
                        <button type="button" onclick="confirmSubmit(this)" name="btn_update_setting" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>

    <script>
        function confirmSubmit(element) {
            var button = $(element);
            $(button).attr('type', 'button');
            Swal.fire({
                title: 'Update Setting',
                text: "Are you sure to update the setting?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(button).attr('type', 'submit');
                    $("#kt_setting_form").submit();
                }
            });
        }
        $('#country_id').select2({
            dropdownParent: $('#kt_setting'),
        });
    </script>

</x-default-layout>
