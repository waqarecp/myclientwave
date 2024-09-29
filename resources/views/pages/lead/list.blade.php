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
                <form method="POST" action="{{ route('leads.export') }}" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                    <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                    <input type="hidden" name="filter_source" value="{{ request('filter_source') }}">
                    <input type="hidden" name="filter_utility" value="{{ request('filter_utility') }}">
                    <button type="submit" class="btn btn-primary btn-sm me-1">Export</button>
                </form>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Filter</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6606385758292">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <form method="GET" action="{{ route('leads.index') }}">
                                <div class="px-7 py-5">
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Search Lead:</label>
                                        <div>
                                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name,Phone,Email" class="form-control form-control-sm me-3">
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Date From:</label>
                                        <div>
                                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" placeholder="Date From..." class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Date To:</label>
                                        <div>
                                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" placeholder="Date To..." class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Source:</label>
                                        <div>
                                            <select name="filter_source" class="form-select form-select-solid" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select Source" data-dropdown-parent="#kt_menu_6606385758292" data-allow-clear="true">
                                                <option value="">--- Filter By Source ---</option>
                                                @foreach($sources as $source)
                                                    <option {{$request->filter_source == $source->id ? 'selected' : ''}} value="{{$source->id}}">{{$source->source_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Utility Company:</label>
                                        <div>
                                            <select name="filter_utility" class="form-select form-select-solid" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select Source" data-dropdown-parent="#kt_menu_6606385758292" data-allow-clear="true">
                                                <option value="">--- Filter By Utility Company ---</option>
                                                @foreach($utilityCompanies as $ucompany)
                                                <option {{$request->filter_utility == $ucompany->id ? 'selected' : ''}} value="{{$ucompany->id}}">{{$ucompany->utility_company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <a href="/leads" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</a>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Card toolbar-->
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
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light-primary">
                            <th>Sr. No.</th>
                            <th>Lead Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>State</th>
                            <th>Source</th>
                            <th>Utility Company</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($rows))
                        <?php $counter = 1; ?>
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $row->first_name . ' ' . $row->last_name }}</td>
                            <td>{{ $row->email}}</td>
                            <td>{{ $row->phone}}</td>
                            <td>{{ $row->state_name}}</td>
                            <td>{{ $row->leadSource->source_name}}</td>
                            <td>{{ $row->utilityCompany ? $row->utilityCompany->utility_company_name :'Nil'}}</td>
                            <td>
                                {{ $row->user->name }}&nbsp;<small>{{\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')}}</small>
                            </td>

                            <td>
                                <!-- Include action buttons -->
                                @include('pages.lead.columns._actions', ['lead' => $row])
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td align="center" colspan="9">There are no records in this list currently! Thank you</td>
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

    <!-- lead modal -->
    <div class="modal fade" id="kt_modal_lead" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_lead_header">
                    <h2 class="fw-bold">Update Lead Information</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_lead_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="lead_id" name="lead_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_lead_scroll">
                            <!--begin::Accordion-->
                            <div class="accordion" id="leadAccordion">
                                <!--begin::Lead Information-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="leadInfoHeader">
                                        <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#leadInfoCollapse" aria-expanded="true" aria-controls="leadInfoCollapse">
                                            Lead Information
                                        </button>
                                    </h2>
                                    <div id="leadInfoCollapse" class="accordion-collapse collapse show" aria-labelledby="leadInfoHeader" data-bs-parent="#leadAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-md-4 mt-3">
                                                        <!--begin::Lead Owner-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                            <span class="required">Lead Owner</span>
                                                        </label>
                                                        <select class="form-select" id="owner_id" name="owner_id" required data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Owner">
                                                            @foreach($roles as $role)
                                                            <optgroup label="{{ ucwords($role->name) }}">
                                                                @foreach($users as $user)
                                                                @if($user->roles->contains($role))
                                                                <option data-child-users="{{ $user->child_users }}" value="{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </option>
                                                                @endif
                                                                @endforeach
                                                            </optgroup>
                                                            @endforeach
                                                        </select>
                                                        @error('owner_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <!--end::Lead Owner-->
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <!--begin::Sales Representative-->
                                                        <label class="d-flex align-items-center fs-6 fw-semibold ">
                                                            <span class="required">Sales Representative</span>
                                                        </label>
                                                        <select class="form-select" id="sale_representative" name="sale_representative" required data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Sale Representative">
                                                            @foreach($roles as $role)
                                                            <optgroup label="{{ ucwords($role->name) }}">
                                                                @foreach($users as $user)
                                                                @if($user->roles->contains($role))
                                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </optgroup>
                                                            @endforeach
                                                        </select>
                                                        @error('sale_representative')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <!--end::Sales Representative-->
                                                    </div>

                                                    <!--begin::Lead Source-->
                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">Lead Source</label>
                                                        <select class="form-select" id="lead_source_id" name="lead_source_id" required data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Source">
                                                        @foreach($sources as $source)
                                                        <option value="{{$source->id}}">{{$source->source_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('lead_source_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!--end::Lead Source-->

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" required />
                                                        @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" required />
                                                        @error('last_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">Mobile</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" required />
                                                        @error('mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="fs-6 fw-semibold ">Phone</label>
                                                        <input type="text" class="form-control" id="phone" minlength="5" maxlength="25" name="phone" />
                                                        @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="required fs-6 fw-semibold ">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" required />
                                                        @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mt-3">
                                                        <label class="fs-6 fw-semibold ">Utility Company</label>
                                                        <select class="form-select" id="utility_company_id" name="utility_company_id" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Company">
                                                            @foreach($utilityCompanies as $utilitycompany)
                                                            <option value="{{$utilitycompany->id}}">{{$utilitycompany->utility_company_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('utility_company_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <label class="fs-6 fw-semibold ">Call Center Representative</label>
                                                        <select class="form-select" id="call_center_representative" name="call_center_representative" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a Representative">
                                                            @foreach($roles as $role)
                                                            <optgroup label="{{ ucwords($role->name) }}">
                                                                @foreach($users as $user)
                                                                @if($user->roles->contains($role))
                                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </optgroup>
                                                            @endforeach
                                                        </select>
                                                        @error('call_center_representative')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Lead Information-->

                                <!--begin::Address Information-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="addressInfoHeader">
                                        <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addressInfoCollapse" aria-expanded="false" aria-controls="addressInfoCollapse">
                                            Address Information
                                        </button>
                                    </h2>
                                    <div id="addressInfoCollapse" class="accordion-collapse collapse" aria-labelledby="addressInfoHeader" data-bs-parent="#leadAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Country</label>
                                                    <select name="country_id" id="country_id" onchange="getStates(this)" class="form-select" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a country">
                                                        @foreach($countries as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">State / Province</label>
                                                    <select class="form-control" id="state_id" name="state_id" onchange="getCities()" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a state">
                                                        @foreach($states as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">City</label>
                                                    <select class="form-control" name="city_id" id="city_id" data-control="select2" data-dropdown-parent="#kt_modal_lead" data-placeholder="Select a city">
                                                        @foreach($cities as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('city_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Street</label>
                                                    <input type="text" class="form-control" id="street" name="street" />
                                                    @error('street')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Post Code</label>
                                                    <input type="text" class="form-control" id="zip" name="zip" />
                                                    @error('zip')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="required fs-6 fw-semibold ">Address Line 1</label>
                                                    <input type="text" class="form-control" id="address_1" name="address_1" requried />
                                                    @error('address_1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="fs-6 fw-semibold ">Address Line 2</label>
                                                    <input type="text" class="form-control" id="address_2" name="address_2" />
                                                    @error('address_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Address Information-->
                            </div>
                            <!--end::Accordion-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end lead modal -->

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

    <!--begin::Modal - Convert Lead to deal-->
    <div class="modal fade" id="kt_modal_convert_lead_to_deal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Convert <span class="badge badge-lg bg-secondary" id="convert_lead_name_header"></span> to Deal</h2>
                </div>
                <div class="modal-body py-10 px-lg-17">
                <form id="kt_modal_convert_lead_to_deal_form" class="form" action="#" enctype="multipart/form-data">
                    <input type="hidden" id="convert_lead_id" name="convert_lead_id" />
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_convert_lead_to_deal_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_convert_lead_to_deal_header"
                            data-kt-scroll-wrappers="#kt_modal_convert_lead_to_deal_scroll" data-kt-scroll-offset="300px">
                            <!-- Begin: Row 1 (left and right) -->
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Project Administrator -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Project Administrator</label>
                                            <select name="project_administrator_id" id="project_administrator_id" class="form-control form-select form-control-solid">
                                                @foreach($roles as $role)
                                                <optgroup label="{{ ucwords($role->name) }}">
                                                    @foreach($users as $user)
                                                    @if($user->roles->contains($role))
                                                    <option data-child-users="{{ $user->child_users }}" value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>
                                            @error('project_administrator_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Deal Owner -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Deal Owner</label>
                                            <select name="owner_id" id="owner_id" class="form-control form-select form-control-solid">
                                                @foreach($roles as $role)
                                                <optgroup label="{{ ucwords($role->name) }}">
                                                    @foreach($users as $user)
                                                    @if($user->roles->contains($role))
                                                    <option data-child-users="{{ $user->child_users }}" value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>
                                            @error('owner_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Financier -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Financier</label>
                                            <select name="financier_id" id="financier_id" class="form-control form-select form-control-solid">
                                                <option value="">None</option>
                                                <!-- Dynamic options here -->
                                            </select>
                                            @error('financier_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Type -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Home Type</label>
                                            <select name="home_type_id" id="home_type_id" class="form-control form-select form-control-solid">
                                                <option value="">-- Select --</option>
                                                @foreach($homeTypes as $homeType)
                                                <option value="{{ $homeType->id }}">
                                                    {{ $homeType->home_type_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('home_type_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Deal Account name -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Account Name</label>
                                            <input type="text" name="deal_account_name" id="deal_account_name" class="form-control form-control-solid" />
                                            @error('deal_account_name')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- deal_contact_name -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Contact Name</label>
                                            <input type="text" name="deal_contact_name" id="deal_contact_name" class="form-control form-control-solid" />
                                            @error('deal_contact_name')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- deal_phone_burner_last_call_outcome -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Phone Burner Last Call Outcome</label>
                                            <input type="text" name="deal_phone_burner_last_call_outcome" id="deal_phone_burner_last_call_outcome" class="form-control form-control-solid" />
                                            @error('deal_phone_burner_last_call_outcome')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- deal_social_lead_id -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Social Lead Id</label>
                                            <input type="text" name="deal_social_lead_id" id="deal_social_lead_id" class="form-control form-control-solid" />
                                            @error('deal_social_lead_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Amount -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Amount</label>
                                            <input type="number" name="deal_amount" id="deal_amount" class="form-control form-control-solid" />
                                            @error('deal_amount')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Closing Date -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Closing Date</label>
                                            <input type="date" name="deal_closing_date" id="deal_closing_date" class="form-control form-control-solid" />
                                            @error('deal_closing_date')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Pipeline -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Pipeline</label>
                                            <select name="deal_pipeline" id="deal_pipeline" class="form-control form-select form-control-solid">
                                                <option value="">-- Select --</option>
                                                <!-- Dynamic options here -->
                                            </select>
                                            @error('deal_pipeline')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- communication_method_id -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Communication Method Id</label>
                                            <select name="communication_method_id" id="communication_method_id" class="form-control form-select form-control-solid">
                                                <option value="">-- Select --</option>
                                                @foreach($communicationMethods as $communicationMethod)
                                                <option value="{{ $communicationMethod->id }}">
                                                    {{ $communicationMethod->method_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('communication_method_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Stage -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Stage</label>
                                            <select name="stage_id" id="stage_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_convert_lead_to_deal" data-placeholder="Select a Stage">
                                                <option value="">-- Select --</option>
                                                @foreach($dealStages as $dealStage)
                                                <option value="{{ $dealStage->id }}" data-color="{{ $dealStage->stage_color_code }}">
                                                    {{ $dealStage->stage_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('stage_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Probability -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Probability (%)</label>
                                            <input type="number" name="deal_probability" id="deal_probability" class="form-control form-control-solid" value="100" />
                                            @error('deal_probability')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Expected Revenue -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Expected Revenue</label>
                                            <input type="number" name="deal_expected_revenue" id="deal_expected_revenue" class="form-control form-control-solid" />
                                            @error('deal_expected_revenue')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- Permit Number -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Permit No.</label>
                                            <input type="text" name="deal_permit_number" id="deal_permit_number" class="form-control form-control-solid" />
                                            @error('deal_permit_number')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- deal_phone_burner_followup_date -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Phone Burner Followup Date</label>
                                            <input type="date" name="deal_phone_burner_followup_date" id="deal_phone_burner_followup_date" class="form-control form-control-solid" />
                                            @error('deal_phone_burner_followup_date')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- deal_phone_burner_last_call_time -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Phone Burner Last Call Time</label>
                                            <input type="datetime-local" name="deal_phone_burner_last_call_time" id="deal_phone_burner_last_call_time" class="form-control form-control-solid" />
                                            @error('deal_phone_burner_last_call_time')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="row">   
                                    <div class="col-md-4">
                                        <!-- Availability Start & End -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Availability Start</label>
                                            <input type="time" name="deal_availability_start" id="deal_availability_start" class="form-control form-control-solid" />
                                            @error('deal_availability_start')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Availability End</label>
                                            <input type="time" name="deal_availability_end" id="deal_availability_end" class="form-control form-control-solid" />
                                            @error('deal_availability_end')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <!-- Organization -->
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Organization</label>
                                            <select name="organization_id" id="organization_id" class="form-control form-select form-control-solid">
                                                <option value="">None</option>
                                                <!-- Dynamic options here -->
                                            </select>
                                            @error('organization_id')
                                            <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End: Row 1 -->
                        </div>

                        <!-- Begin: Actions -->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="convert_deal" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                            </button>
                            <button id="wait_message" class="btn btn-primary d-none" disabled>
                                <span class="indicator-label">Please wait...</span>
                            </button>
                        </div>
                        <!-- End: Actions -->
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Modal - Convert Lead to deal -->

    @push('scripts')
    <script>
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
                        var leadId = this.getAttribute('data-kt-lead-id');
                        var url = "{{ route('leads.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                leadId: leadId
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
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the appointment.';

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

        $('#kt_modal_lead_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = "{{ route('leads.update') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#kt_modal_lead').modal('hide');
                    Swal.fire({
                        text: response.success,
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
                    var errorMessage = xhr.responseJSON.error || 'Failed to save the appointment.';

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

        function lead_modal(element) {
            var leadId = $(element).data('kt-lead-id');
            var ownerId = $(element).data('kt-owner-id');
            var leadSourceId = $(element).data('kt-lead-source-id');
            var utitlityCompany = $(element).data('kt-utility-company-id');
            var firstName = $(element).data('kt-first-name');
            var lastName = $(element).data('kt-last-name');
            var saleRepresentative = $(element).data('kt-sale-representative');
            var callRepresentative = $(element).data('kt-call-center-representative');
            var mobile = $(element).data('kt-mobile');
            var phone = $(element).data('kt-phone');
            var email = $(element).data('kt-email');
            var countryId = $(element).data('kt-country-id');
            var stateId = $(element).data('kt-state-id');
            var cityId = $(element).data('kt-city-id');
            var street = $(element).data('kt-street');
            var zip = $(element).data('kt-zip');
            var address1 = $(element).data('kt-address-1');
            var address2 = $(element).data('kt-address-2');

            $('#lead_id').val(leadId);
            $('#owner_id').val(ownerId).trigger('change');
            $('#lead_source_id').val(leadSourceId).trigger('change');
            $('#utility_company_id').val(utitlityCompany).trigger('change');
            $('#call_center_representative').val(callRepresentative).trigger('change');
            $('#first_name').val(firstName);
            $('#last_name').val(lastName);
            $('#sale_representative').val(saleRepresentative).trigger('change');
            $('#mobile').val(mobile);
            $('#phone').val(phone);
            $('#email').val(email);
            $('#country_id').val(countryId).trigger('change');
                getStates(stateId);
            $('#state_id').on('change', function() {
                getCities(cityId);
            });
            $('#street').val(street);
            $('#zip').val(zip);
            $('#address_1').val(address1);
            $('#address_2').val(address2);
            $('#kt_modal_lead').modal('show');
        }

        // Function to get states based on selected country
        function getStates(selectedStateId = null) {
            var countryId = $('#country_id').val();
            var stateDropdown = $('#state_id');
            var cityDropdown = $('#city_id');
            stateDropdown.empty();
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getStates') }}",
                method: 'post',
                data: {
                    countryId: countryId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    stateDropdown.select2({
                        dropdownParent: $('#kt_modal_lead'),
                        templateResult: formatStateColour,
                        templateSelection: formatStateColour
                    });

                    $.each(data.states, function(index, state) {
                        var option = $('<option></option>')
                            .val(state.id)
                            .text(state.name)
                            .attr('data-color', state.color_code); // Add color to option
                        stateDropdown.append(option);
                    });
                    // Set the selected state once the options are loaded
                    if (selectedStateId) {
                        stateDropdown.val(selectedStateId).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get states for this country!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        // Function to format state options with color
        function formatStateColour(state) {
            if (!state.id) {
                return state.text;
            }

            var color = $(state.element).data('color'); // Get color from option data
            var $state = $(
                '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + state.text + '</span>'
            );

            return $state;
        }

        // Function to get cities based on selected state
        function getCities(selectedCityId = null) {
            var stateId = $('#state_id').val();
            var cityDropdown = $('#city_id');
            cityDropdown.empty();

            $.ajax({
                url: "{{ route('leads.getCities') }}",
                method: 'post',
                data: {
                    stateId: stateId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $.each(data.states, function(key, value) {
                        cityDropdown.append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Set the selected city once the options are loaded
                    if (selectedCityId) {
                        cityDropdown.val(selectedCityId).trigger('change');
                    }
                },
                error: function() {
                    Swal.fire({
                        text: 'Failed to get cities for this state!',
                        icon: 'error',
                        confirmButtonText: "Close",
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            });
        }

        // Reinitialize Select2 for all relevant fields
        $('#owner_id, #sale_representative, #lead_source_id, #utility_company_id, #call_center_representative, #country_id, #state_id, #city_id').select2({
            dropdownParent: $('#kt_modal_lead')
        });

        function ucwords(str) {
            return str.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
        }
        $(document).ready(function() {
            $('#owner_id').on('change', function() {
                var childUsers = $('#owner_id option:selected').data('child-users');
                var allUsers = @json($users); // Assuming $users includes role relationship

                // Clear existing options except the first one and keep the structure intact
                $('#sale_representative optgroup, #call_center_representative optgroup').remove();

                if (!childUsers || childUsers === "") {
                    // If no child users, enable and populate with all users grouped by role
                    $('#sale_representative, #call_center_representative').prop('disabled', false);

                    // Group users by roles
                    var usersByRole = {};
                    allUsers.forEach(function(user) {
                        var roleName = ucwords(user.roles[0].name); // Assuming each user has a single role
                        if (!usersByRole[roleName]) {
                            usersByRole[roleName] = [];
                        }
                        usersByRole[roleName].push(user);
                    });

                    // Append users grouped by roles
                    $.each(usersByRole, function(roleName, users) {
                        if (users.length > 0) {
                            var optgroup = $('<optgroup>', {
                                label: roleName
                            });
                            users.forEach(function(user) {
                                optgroup.append($('<option>', {
                                    value: user.id,
                                    text: user.name
                                }));
                            });
                            $('#sale_representative, #call_center_representative').append(optgroup);
                        }
                    });

                } else {
                    // If there are child users, enable and populate with specific users grouped by role
                    var childUserIds = childUsers.toString().split(',');

                    $('#sale_representative, #call_center_representative').prop('disabled', false);

                    // Filter child users by their role
                    var usersByRole = {};
                    childUserIds.forEach(function(userId) {
                        var user = allUsers.find(u => u.id == userId);
                        if (user) {
                            var roleName = ucwords(user.roles[0].name); // Assuming each user has a single role
                            if (!usersByRole[roleName]) {
                                usersByRole[roleName] = [];
                            }
                            usersByRole[roleName].push(user);
                        }
                    });

                    // Append users grouped by roles
                    $.each(usersByRole, function(roleName, users) {
                        if (users.length > 0) {
                            var optgroup = $('<optgroup>', {
                                label: roleName
                            });
                            users.forEach(function(user) {
                                optgroup.append($('<option>', {
                                    value: user.id,
                                    text: user.name
                                }));
                            });
                            $('#sale_representative, #call_center_representative').append(optgroup);
                        }
                    });
                }
            });
        });
        
        function viewLeadComments(lead_id, activeCommentsTab = false) {
            $.ajax({
                url: "{{ route('leads.viewLeadComments') }}", // Use the URL from the data attribute
                method: 'post',
                data: {
                    lead_id: lead_id,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
                },
                success: function(data) {
                    $('.kt_modal_attach').html(data);
                    $('#kt_modal_view_lead_comments').modal('show');
                    if (activeCommentsTab) {
                        $('#update_followup .nav-item a').removeClass('active');
                        $('#update_followup .nav-item a').eq(1).addClass('active');
                        $('#lead-comments-content .tab-pane').removeClass('active show');
                        $('#lead-comments-content .tab-pane').eq(1).addClass('active show');
                    }
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to view comments for this lead!', 
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
        
        function convertLeadToDealForm(element) {
            var leadId = $(element).data('kt-lead-id');
            var leadName = $(element).data('kt-lead-name');
            $('#convert_lead_name_header').text(leadName);
            $('#convert_lead_id').val(leadId);
            $('#stage_id').select2({
                    dropdownParent: $('#kt_modal_convert_lead_to_deal'),
                    templateResult: formatStageColour,
                    templateSelection: formatStageColour
                });
            $('#kt_modal_convert_lead_to_deal').modal('show');
                
        }
        $('#stage_id').select2({
            templateResult: formatStageColour,
            templateSelection: formatStageColour,
            dropdownParent: $('#kt_modal_convert_lead_to_deal')
        });

        function formatStageColour(stage) {
            if (!stage.id) {
                return stage.text;
            }

            var color = $(stage.element).data('color'); // Get color from option data
            var $stage = $(
                '<span><span class="badge badge-circle w-15px h-15px me-1" style="background-color:' + color + '"></span>' + stage.text + '</span>'
            );

            return $stage;
        }
        $('#kt_modal_convert_lead_to_deal_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#convert_deal').addClass('d-none');
                $('#wait_message').removeClass('d-none');
                var formData = $(this).serialize();
                var url = "{{ route('leads.convertLeadToDeal') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_convert_lead_to_deal').modal('hide');
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-success'
                            }
                        });
                        // Reload or update your deals list here
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show submit button again and hide "Please wait" message
                        $('#convert_deal').removeClass('d-none');
                        $('#wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to convert lead to Deal.';

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
    </script>
    @endpush
</x-default-layout>