<x-default-layout>

    @section('title')
    Deals
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('deals.index') }}
    @endsection
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <form action="{{ route('deals.export') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="amount" value="{{ request('amount') }}">
                    <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                    <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                    <input type="hidden" name="filter_stage" value="{{ request('filter_stage') }}">
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
                            <form method="GET" action="{{ route('deals.index') }}">
                                <div class="px-7 py-5">
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Search Deal:</label>
                                        <div>
                                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name,Phone,Email" class="form-control form-control-sm me-3">
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold">Deal Amount:</label>
                                        <div>
                                            <input type="number" name="amount" value="{{ request('amount') }}" placeholder="Amount..." class="form-control form-control-sm me-3">
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
                                        <label class="form-label fw-semibold">Stage:</label>
                                        <div>
                                            <select name="filter_stage" class="form-select form-select-solid" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select Stage" data-dropdown-parent="#kt_menu_6606385758292" data-allow-clear="true">
                                                <option value="">--- Filter By Stage ---</option>
                                                @foreach($dealStages as $stage)
                                                <option {{ (isset($_GET['filter_stage']) && $_GET['filter_stage'] == $stage->id) ? 'selected' : ''}} value="{{$stage->id}}">{{$stage->stage_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <a href="{{route('deals.index')}}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</a>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                        <!--begin::Add deal-->
                        @if(auth()->user()->can('create deal'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_deal">
                                {!! getIcon('plus', 'fs-2', '', 'i') !!}
                                Create New Deal
                            </button>
                        @endif
                        <!--end::Add deal-->
                    </div>
                    <!--end::Filter menu-->
                </div>
                <!--end::Actions-->
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
                            <th>Sr. No.</th>
                            <th>Deal Name</th>
                            <th>Deal Email</th>
                            <th>Deal Amount</th>
                            <th>Deal Stage</th>
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
                            <td>
                                {{ $row->deal_name }} <br>
                                <span class="badge bg-secondary">{{ $row->deal_phone_1 }}</span>
                            </td>
                            <td>
                                {{ $row->deal_email }}
                            </td>
                            <td>
                                {{ $row->deal_amount ? '$'.number_format($row->deal_amount, 2) : 'N/A' }}
                            </td>
                            <td>
                                <span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color: {{ $row->stage->stage_color_code }};"></span>{{ $row->stage->stage_name }}
                            </td>
                            <td>
                                {{ $row->creator->name}} <br>
                                <span class="badge bg-secondary">{{\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')}}</span>
                            </td>
                            <td>
                                <!-- Include action buttons -->
                                @include('pages.deals.columns._actions', ['deal' => $row])
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
    <div class="modal fade" id="kt_modal_add_deal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_deal_header">
                    <h2 class="fw-bold">Create New Deal</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_add_deal_form" class="form" action="#" enctype="multipart/form-data">
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_add_deal_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_deal_header"
                            data-kt-scroll-wrappers="#kt_modal_add_deal_scroll" data-kt-scroll-offset="300px">

                            <!-- Begin: Row 1 (left and right) -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Project Administrator -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Project Administrator</label>
                                        <select name="project_administrator_id" id="project_administrator_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Administrator">
                                            <option value="">Select</option>
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

                                    <!-- Deal Owner -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Deal Owner</label>
                                        <select name="owner_id" id="owner_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Deal Owner">
                                            <option value="">Select</option>
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

                                    <!-- lead -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lead</label>
                                        <select name="lead_id" id="lead_id" onchange="populateLeadAddress(this)" class="form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Lead">
                                            <option value="">--- Select a Lead ---</option>
                                            @foreach($leads as $lead)
                                            <option value="{{$lead->id}}" data-name="{{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}" data-phone1="{{ $lead->phone }}" data-email="{{ $lead->email }}" data-source="{{ $lead->lead_source_id }}" data-address="{{(implode(', ', array_filter([
                                                optional($lead->country)->name,
                                                optional($lead->state)->name,
                                                optional($lead->city)->name,
                                                $lead->address_1,
                                                $lead->address_2,
                                                $lead->street,
                                                $lead->zip
                                            ])))}}">
                                                {{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('lead_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Deal Name -->
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Deal Name</label>
                                        <input type="text" name="deal_name" id="deal_name" class="form-control form-control-solid" />
                                        @error('deal_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Address</label>
                                        <input type="text" name="deal_address" id="deal_address" class="form-control form-control-solid" />
                                        @error('deal_address')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Phone 1 -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone 1</label>
                                        <input type="text" name="deal_phone_1" id="deal_phone_1" class="form-control form-control-solid" />
                                        @error('deal_phone_1')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Email</label>
                                        <input type="email" name="deal_email" id="deal_email" class="form-control form-control-solid" />
                                        @error('deal_email')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Financier -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Financier</label>
                                        <select name="financier_id" id="financier_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Financier">
                                            <option value="">Select</option>
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
                                        @error('financier_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

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

                                    <!-- Lead Source -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lead Source</label>
                                        <select name="source_id" id="source_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($leadSources as $leadSource)
                                            <option value="{{ $leadSource->id }}">
                                                {{ $leadSource->source_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('source_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Deal Account name -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Account Name</label>
                                        <input type="text" name="deal_account_name" id="deal_account_name" class="form-control form-control-solid" />
                                        @error('deal_account_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_contact_name -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Contact Name</label>
                                        <input type="text" name="deal_contact_name" id="deal_contact_name" class="form-control form-control-solid" />
                                        @error('deal_contact_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_phone_burner_last_call_outcome -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone Burner Last Call Outcome</label>
                                        <input type="text" name="deal_phone_burner_last_call_outcome" id="deal_phone_burner_last_call_outcome" class="form-control form-control-solid" />
                                        @error('deal_phone_burner_last_call_outcome')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_social_lead_id -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Social Lead Id</label>
                                        <input type="text" name="deal_social_lead_id" id="deal_social_lead_id" class="form-control form-control-solid" />
                                        @error('deal_social_lead_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Amount -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Amount</label>
                                        <input type="number" name="deal_amount" id="deal_amount" class="form-control form-control-solid" />
                                        @error('deal_amount')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Closing Date -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Closing Date</label>
                                        <input type="date" name="deal_closing_date" id="deal_closing_date" class="form-control form-control-solid" />
                                        @error('deal_closing_date')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Pipeline -->
                                    <div class="fv-row mb-7">
                                        
                                        <label class="fw-semibold fs-6 mb-2">Pipeline</label>
                                        <select name="deal_pipeline" id="deal_pipeline" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select Pipeline">
                                            <option value="">-- Select Pipeline--</option>
                                            @foreach($dealPipelines as $dealPipeline)
                                            <option value="{{ $dealPipeline->id }}" data-color="{{ $dealPipeline->stage_color_code }}">
                                                {{ $dealPipeline->pipeline_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('deal_pipeline')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- communication_method_id -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Select Communication</label>
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

                                    <!-- Stage -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Stage</label>
                                        <select name="stage_id" id="stage_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select a Stage">
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

                                    <!-- Probability -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Probability (%)</label>
                                        <input type="number" name="deal_probability" id="deal_probability" class="form-control form-control-solid" value="100" />
                                        @error('deal_probability')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Expected Revenue -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Expected Revenue</label>
                                        <input type="number" name="deal_expected_revenue" id="deal_expected_revenue" class="form-control form-control-solid" />
                                        @error('deal_expected_revenue')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Permit Number -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Permit No.</label>
                                        <input type="text" name="deal_permit_number" id="deal_permit_number" class="form-control form-control-solid" />
                                        @error('deal_permit_number')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_phone_burner_followup_date -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone Burner Followup Date</label>
                                        <input type="date" name="deal_phone_burner_followup_date" id="deal_phone_burner_followup_date" class="form-control form-control-solid" />
                                        @error('deal_phone_burner_followup_date')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_phone_burner_last_call_time -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone Burner Last Call Time</label>
                                        <input type="datetime-local" name="deal_phone_burner_last_call_time" id="deal_phone_burner_last_call_time" class="form-control form-control-solid" />
                                        @error('deal_phone_burner_last_call_time')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Availability Start & End -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Availability Start</label>
                                        <input type="time" name="deal_availability_start" id="deal_availability_start" class="form-control form-control-solid" />
                                        @error('deal_availability_start')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Availability End</label>
                                        <input type="time" name="deal_availability_end" id="deal_availability_end" class="form-control form-control-solid" />
                                        @error('deal_availability_end')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Organization -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Organization</label>
                                        <select name="organization_id" id="organization_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_deal" data-placeholder="Select organization">                                        
                                            <option value="">select organization</option>  
                                            @foreach($organizations as $organization)
                                            <option value="{{ $organization->id }}">
                                                {{ $organization->organization_name }}
                                            </option>
                                            @endforeach
                                            <!-- Dynamic options here -->
                                        </select>
                                        @error('organization_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End: Row 1 -->
                        </div>

                        <!-- Begin: Actions -->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="add_deal" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                            </button>
                            <button id="wait_message" class="btn btn-primary d-none" disabled>
                                <span class="indicator-label">Please wait...</span>
                            </button>
                        </div>
                        <!-- End: Actions -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->

    <!-- update modal -->
    <div class="modal fade" id="kt_modal_update_deal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_deal_header">
                    <h2 class="fw-bold">Update Deal</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                </div>
                <div class="modal-body px-5 my-2">
                    <form id="kt_modal_update_deal_form" class="form" action="#" enctype="multipart/form-data">
                        <input type="hidden" id="deal_id" name="deal_id" />
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-2 px-lg-10" id="kt_modal_update_deal_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_deal_header" data-kt-scroll-wrappers="#kt_modal_update_deal_scroll" data-kt-scroll-offset="300px">
                            <!-- Begin: Row 1 (left and right) -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Project Administrator -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Project Administrator</label>
                                        <select name="update_project_administrator_id" id="update_project_administrator_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_update_deal" data-placeholder="Select a Administrator">
                                            <option value="">Select</option>
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
                                        @error('update_project_administrator_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Deal Owner -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Deal Owner</label>
                                        <select name="update_owner_id" id="update_owner_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_update_deal" data-placeholder="Select a Owner">
                                            <option value="">Select</option>
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
                                        @error('update_owner_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- lead -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lead</label>
                                        <select name="update_lead_id" id="update_lead_id" onchange="updatePopulateLeadAddress(this)" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_update_deal" data-placeholder="Select a Lead">
                                            <option value="">--- Select a Lead ---</option>
                                            @foreach($leads as $lead)
                                            <option value="{{$lead->id}}" data-name="{{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}" data-phone1="{{ $lead->phone }}" data-email="{{ $lead->email }}" data-source="{{ $lead->lead_source_id }}" data-address="{{(implode(', ', array_filter([
                                                optional($lead->country)->name,
                                                optional($lead->state)->name,
                                                optional($lead->city)->name,
                                                $lead->address_1,
                                                $lead->address_2,
                                                $lead->street,
                                                $lead->zip
                                            ])))}}">
                                                {{(implode(' ', array_filter([$lead->first_name, $lead->last_name])))}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_lead_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Deal Name -->
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Deal Name</label>
                                        <input type="text" name="update_deal_name" id="update_deal_name" class="form-control form-control-solid" />
                                        @error('update_deal_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Address</label>
                                        <input type="text" name="update_deal_address" id="update_deal_address" class="form-control form-control-solid" />
                                        @error('update_deal_address')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Phone 1 -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone 1</label>
                                        <input type="text" name="update_deal_phone_1" id="update_deal_phone_1" class="form-control form-control-solid" />
                                        @error('update_deal_phone_1')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Email</label>
                                        <input type="email" name="update_deal_email" id="update_deal_email" class="form-control form-control-solid" />
                                        @error('update_deal_email')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Financier -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Financier</label>
                                        <select name="update_financier_id" id="update_financier_id" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_update_deal" data-placeholder="Select a Financier">
                                            <option value="">Select</option>
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
                                        @error('update_financier_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Type -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Home Type</label>
                                        <select name="update_home_type_id" id="update_home_type_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($homeTypes as $homeType)
                                            <option value="{{ $homeType->id }}">
                                                {{ $homeType->home_type_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_home_type_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Lead Source -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Lead Source</label>
                                        <select name="update_source_id" id="update_source_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($leadSources as $leadSource)
                                            <option value="{{ $leadSource->id }}">
                                                {{ $leadSource->source_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_source_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Deal Account name -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Account Name</label>
                                        <input type="text" name="update_deal_account_name" id="update_deal_account_name" class="form-control form-control-solid" />
                                        @error('update_deal_account_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_contact_name -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Contact Name</label>
                                        <input type="text" name="update_deal_contact_name" id="update_deal_contact_name" class="form-control form-control-solid" />
                                        @error('update_deal_contact_name')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_phone_burner_last_call_outcome -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone Burner Last Call Outcome</label>
                                        <input type="text" name="update_deal_phone_burner_last_call_outcome" id="update_deal_phone_burner_last_call_outcome" class="form-control form-control-solid" />
                                        @error('update_deal_phone_burner_last_call_outcome')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- deal_social_lead_id -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Social Lead Id</label>
                                        <input type="text" name="update_deal_social_lead_id" id="update_deal_social_lead_id" class="form-control form-control-solid" />
                                        @error('update_deal_social_lead_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Amount -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Amount</label>
                                        <input type="number" name="update_deal_amount" id="update_deal_amount" class="form-control form-control-solid" />
                                        @error('update_deal_amount')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Closing Date -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Closing Date</label>
                                        <input type="date" name="update_deal_closing_date" id="update_deal_closing_date" class="form-control form-control-solid" />
                                        @error('update_deal_closing_date')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Pipeline -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Pipeline</label>
                                        <select name="update_deal_pipeline" id="update_deal_pipeline" class="form-control form-select form-control-solid" data-control="select2" data-dropdown-parent="#kt_modal_update_deal" data-placeholder="Select Pipeline">
                                            <option value="">-- Select Pipeline--</option>
                                            @foreach($dealPipelines as $dealpipeline)
                                            <option value="{{ $dealPipeline->id }}">
                                                {{ $dealPipeline->pipeline_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_deal_pipeline')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- update_communication_method_id -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Select Communication</label>
                                        <select name="update_communication_method_id" id="update_communication_method_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($communicationMethods as $communicationMethod)
                                            <option value="{{ $communicationMethod->id }}">
                                                {{ $communicationMethod->method_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_communication_method_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Stage -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Stage</label>
                                        <select name="update_stage_id" id="update_stage_id" class="form-control form-select form-control-solid">
                                            <option value="">-- Select --</option>
                                            @foreach($dealStages as $dealStage)
                                            <option value="{{ $dealStage->id }}" data-color="{{ $dealStage->stage_color_code }}">
                                                {{ $dealStage->stage_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_stage_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Probability -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Probability (%)</label>
                                        <input type="number" name="update_deal_probability" id="update_deal_probability" class="form-control form-control-solid" value="100" />
                                        @error('update_deal_probability')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Expected Revenue -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Expected Revenue</label>
                                        <input type="number" name="update_deal_expected_revenue" id="update_deal_expected_revenue" class="form-control form-control-solid" />
                                        @error('update_deal_expected_revenue')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Permit Number -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Permit No.</label>
                                        <input type="text" name="update_deal_permit_number" id="update_deal_permit_number" class="form-control form-control-solid" />
                                        @error('update_deal_permit_number')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- update_deal_phone_burner_followup_date -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone Burner Followup Date</label>
                                        <input type="date" name="update_deal_phone_burner_followup_date" id="update_deal_phone_burner_followup_date" class="form-control form-control-solid" />
                                        @error('update_deal_phone_burner_followup_date')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- update_deal_phone_burner_last_call_time -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Phone Burner Last Call Time</label>
                                        <input type="datetime-local" name="update_deal_phone_burner_last_call_time" id="update_deal_phone_burner_last_call_time" class="form-control form-control-solid" />
                                        @error('update_deal_phone_burner_last_call_time')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Availability Start & End -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Availability Start</label>
                                        <input type="time" name="update_deal_availability_start" id="update_deal_availability_start" class="form-control form-control-solid" />
                                        @error('update_deal_availability_start')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Availability End</label>
                                        <input type="time" name="update_deal_availability_end" id="update_deal_availability_end" class="form-control form-control-solid" />
                                        @error('update_deal_availability_end')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Organization -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Organization</label>
                                        <select name="update_organization_id" id="update_organization_id" class="form-control form-select form-control-solid"  data-control="select2" data-dropdown-parent="#kt_modal_update_deal" data-placeholder="Select organization">
                                            <option value="">-- Select Organization--</option>
                                            @foreach($organizations as $organization)
                                            <option value="{{ $organization->id }}" data-color="{{ $organization->organization_name}}">
                                                {{ $organization->organization_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('update_organization_id')
                                        <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End: Row 1 -->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            <button type="submit" id="update_deal" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                            </button>

                            <button id="update_wait_message" class="btn btn-primary d-none" disabled>
                                <span class="indicator-label">Please wait...</span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!--begin::Modal - View Deal Details-->
    <div class="modal fade" id="kt_modal_update_deal_timeline" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body py-10 px-lg-17 kt_modal_attach_deal">

                </div>
                <!--end::Modal body-->
            </div>
        </div>
    </div>
    <!--end::Modal - View Deal Details-->

    @push('scripts')
    <script>
        document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function(element) {
            element.addEventListener('click', function() {
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
                        var dealId = this.getAttribute('data-kt-deal-id');
                        var url = "{{ route('deals.destroy') }}";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                dealId: dealId
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
                                location.reload();
                            },
                            error: function(xhr) {
                                // Parse the error response if any
                                var errorMessage = xhr.responseJSON.error || 'Failed to delete the Deal.';

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

        $('#kt_modal_add_deal_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#add_deal').addClass('d-none');
                $('#wait_message').removeClass('d-none');
                var formData = $(this).serialize();
                var url = "{{ route('deals.store') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_add_deal').modal('hide');
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
                        $('#add_deal').removeClass('d-none');
                        $('#wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to save the Deal.';

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

        $('#kt_modal_update_deal_form').on('submit', function(e) {
            e.preventDefault();
            if (this.checkValidity()) {
                // Hide the submit button and show "Please wait" message
                $('#update_deal').addClass('d-none');
                $('#update_wait_message').removeClass('d-none');
                var formData = $(this).serialize();

                // Dynamically build the update route with the stage ID
                var url = "{{ route('deals.update') }}";

                $.ajax({
                    type: 'Post',
                    url: url,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#kt_modal_update_deal').modal('hide');
                        Swal.fire({
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-light-success'
                            }
                        });
                        // Reload or update your home_type list here
                        location.reload();
                    },
                    error: function(xhr) {
                        $('#update_deal').removeClass('d-none');
                        $('#update_wait_message').addClass('d-none');
                        // Parse the error response if any
                        var errorMessage = xhr.responseJSON.error || 'Failed to update the Deal.';

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
        
        function update_deal_modal(element) {
            var dealId = $(element).data('kt-deal-id');
            if (dealId) {
                var projectAdministratorId = $(element).data('kt-project-administrator-id');
                var dealOwnerId = $(element).data('kt-owner-id');
                var dealLeadId = $(element).data('kt-lead-id');
                var dealName = $(element).data('kt-deal-name');
                var dealAddress = $(element).data('kt-deal-address');
                var dealPhone1 = $(element).data('kt-deal-phone-1');
                var dealEmail = $(element).data('kt-deal-email');
                var financierId = $(element).data('kt-financier-id');
                var homeTypeId = $(element).data('kt-home-type-id');
                var sourceId = $(element).data('kt-source-id');
                var dealAccountName = $(element).data('kt-deal-account-name');
                var dealContactName = $(element).data('kt-deal-contact-name');
                var dealPhoneBurnerOutcome = $(element).data('kt-deal-phone-burner-last-call-outcome');
                var dealSocialLeadId = $(element).data('kt-deal-social-lead-id');
                var dealAmount = $(element).data('kt-deal-amount');
                var dealClosingDate = $(element).data('kt-deal-closing-date');
                var dealPipeline = $(element).data('kt-deal-pipeline');
                var communicationMethodId = $(element).data('kt-communication-method-id');
                var stageId = $(element).data('kt-stage-id');
                var dealProbability = $(element).data('kt-deal-probability');
                var dealExpectedRevenue = $(element).data('kt-deal-expected-revenue');
                var dealPermitNumber = $(element).data('kt-deal-permit-number');
                var dealFollowupDate = $(element).data('kt-deal-phone-burner-followup-date');
                var dealLastCallTime = $(element).data('kt-deal-phone-burner-last-call-time');
                var dealAvailabilityStart = $(element).data('kt-deal-availability-start');
                var dealAvailabilityEnd = $(element).data('kt-deal-availability-end');
                var organizationId = $(element).data('kt-organization-id');

                $('#deal_id').val(dealId);
                $('#update_project_administrator_id').val(projectAdministratorId).trigger('change');
                $('#update_owner_id').val(dealOwnerId).trigger('change');
                $('#update_lead_id').val(dealLeadId).trigger('change');
                $('#update_deal_name').val(dealName);
                $('#update_deal_address').val(dealAddress);
                $('#update_deal_phone_1').val(dealPhone1);
                $('#update_deal_email').val(dealEmail);
                $('#update_financier_id').val(financierId).trigger('change');
                $('#update_home_type_id').val(homeTypeId);
                $('#update_source_id').val(sourceId);
                $('#update_deal_account_name').val(dealAccountName);
                $('#update_deal_contact_name').val(dealContactName);
                $('#update_deal_phone_burner_last_call_outcome').val(dealPhoneBurnerOutcome);
                $('#update_deal_social_lead_id').val(dealSocialLeadId);
                $('#update_deal_amount').val(dealAmount);
                $('#update_deal_closing_date').val(dealClosingDate);
                $('#update_deal_pipeline').select2({
                        dropdownParent: $('#kt_modal_update_deal'),
                        templateResult: formatStageColour,
                        templateSelection: formatStageColour
                    });
                $('#update_communication_method_id').val(communicationMethodId);
                $('#update_stage_id').val(stageId).trigger('change');
                $('#update_stage_id').select2({
                        dropdownParent: $('#kt_modal_update_deal'),
                        templateResult: formatStageColour,
                        templateSelection: formatStageColour
                    });
                $('#update_deal_probability').val(dealProbability);
                $('#update_deal_expected_revenue').val(dealExpectedRevenue);
                $('#update_deal_permit_number').val(dealPermitNumber);
                $('#update_deal_phone_burner_followup_date').val(dealFollowupDate);
                $('#update_deal_phone_burner_last_call_time').val(dealLastCallTime);
                $('#update_deal_availability_start').val(dealAvailabilityStart);
                $('#update_deal_availability_end').val(dealAvailabilityEnd);
                $('#update_organization_id').val(organizationId).trigger('change');

                $('#kt_modal_update_deal').modal('show');
            }
        }

        $('#update_stage_id').select2({
            templateResult: formatStageColour,
            templateSelection: formatStageColour,
            dropdownParent: $('#kt_modal_update_deal')
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

        function populateLeadAddress(element) {
            var selectedOption = $(element).find('option:selected');
            var leadName = selectedOption.data('name');
            var leadAddress = selectedOption.data('address');
            var leadPhone1 = selectedOption.data('phone1');
            var leadEmail = selectedOption.data('email');
            var leadSource = selectedOption.data('source');
            $("#deal_name").val(leadName);
            $("#deal_address").val(leadAddress);
            $("#deal_phone_1").val(leadPhone1);
            $("#deal_email").val(leadEmail);
            $("#source_id").val(leadSource);
        }
        
        function updatePopulateLeadAddress(element) {
            var selectedOption = $(element).find('option:selected');
            var leadName = selectedOption.data('name');
            var leadAddress = selectedOption.data('address');
            var leadPhone1 = selectedOption.data('phone1');
            var leadEmail = selectedOption.data('email');
            var leadSource = selectedOption.data('source');
            $("#update_deal_name").val(leadName);
            $("#update_deal_address").val(leadAddress);
            $("#update_deal_phone_1").val(leadPhone1);
            $("#update_deal_email").val(leadEmail);
            $("#update_source_id").val(leadSource);
        }

        $(document).ready(function() {
            $('#stage_id').select2({
                templateResult: formatStage,
                templateSelection: formatStage,
                dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
            });

            // Function to format Select2 options with color
            function formatStage(stage) {
                if (!stage.id) {
                    return stage.text;
                }
                var $stage = $(
                    '<span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color:' + $(stage.element).data('color') + '"></span>' + stage.text + '</span>'
                );
                return $stage;
            }

            // Re-initialize Select2 when the modal is shown
            $('#kt_modal_add_deal').on('shown.bs.modal', function() {
                $('#stage_id').select2({
                    templateResult: formatStage,
                    templateSelection: formatStage,
                    dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
                });
            });
        });

        function viewDealTimeline(deal_id, activeCommentsTab = false) {
            $.ajax({
                url: "{{ route('deals.viewTimeline') }}", // Use the URL from the data attribute
                method: 'post',
                data: {
                    deal_id: deal_id,
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
                },
                success: function(data) {
                    $('.kt_modal_attach_deal').html(data);
                    $('#kt_modal_update_deal_timeline').modal('show');
                    if (activeCommentsTab) {
                        $('#update_followup .nav-item a').removeClass('active');
                        $('#update_followup .nav-item a').eq(1).addClass('active');
                        $('#deal-note-content .tab-pane').removeClass('active show');
                        $('#deal-note-content .tab-pane').eq(1).addClass('active show');
                    }
                },
                error: function(data) {
                    Swal.fire({
                        text: 'Failed to view timeline for this deal!',
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