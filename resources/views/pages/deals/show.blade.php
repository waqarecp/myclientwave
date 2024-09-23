<x-default-layout>

    @section('title')
    View Deal Details
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('deals.show', $deal) }}
    @endsection
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" data-bs-target="#kt_deal_information" href="javascript:void(0)">Deal information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" data-bs-target="#kt_stage_timeline" href="javascript:void(0)">Deal Timeline</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_deal_information" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $deal->deal_name }}</h2>
                            <div class="fs-6 fw-semibold text-muted"> Deal details for {{ $deal->deal_name }}</div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">
                        <div class="separator"></div>
                        <div class="row">
                            <!--begin::Details content-->
                            <div id="kt_dealer_view_details" class="collapse show ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Deal ID</div>
                                        <div class="text-gray-600">{{ $deal->id }}</div>
                                        <div class="fw-bold mt-5">Project Administrator</div>
                                        <div class="text-gray-600">{{ $deal->projectAdministrator->name }}</div>
                                        <div class="fw-bold mt-5">Deal Owner</div>
                                        <div class="text-gray-600">{{ $deal->owner->name }}</div>
                                        <div class="fw-bold mt-5">Lead Name</div>
                                        <div class="text-gray-600">{{ $deal->lead->first_name }} {{ $deal->lead->last_name }}</div>
                                        <div class="fw-bold mt-5">Deal Name</div>
                                        <div class="text-gray-600">{{ $deal->deal_name }}</div>
                                        <div class="fw-bold mt-5">Address</div>
                                        <div class="text-gray-600">{{ $deal->deal_address }}</div>
                                        <div class="fw-bold mt-5">Phone</div>
                                        <div class="text-gray-600">{{ $deal->deal_phone_1 }}</div>
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">{{ $deal->deal_email }}</div>
                                        <div class="fw-bold mt-5">Financier</div>
                                        <div class="text-gray-600">{{ $deal->financier_id?:'N/A' }}</div>
                                        <div class="fw-bold mt-5">Home Type</div>
                                        <div class="text-gray-600">{{ $deal->homeType->home_type_name }}</div>
                                        <div class="fw-bold mt-5">Lead Source</div>
                                        <div class="text-gray-600">{{ $deal->source->source_name }}</div>
                                        <div class="fw-bold mt-5">Account Name</div>
                                        <div class="text-gray-600">{{ $deal->deal_account_name }}</div>
                                        <div class="fw-bold mt-5">Contact Name</div>
                                        <div class="text-gray-600">{{ $deal->deal_contact_name }}</div>
                                        <div class="fw-bold mt-5">Phone Burner Last Call Outcome</div>
                                        <div class="text-gray-600">{{ $deal->deal_phone_burner_last_call_outcome }}</div>
                                        <div class="fw-bold mt-5">Social Lead Id</div>
                                        <div class="text-gray-600">{{ $deal->deal_social_lead_id }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold mt-5">Amount</div>
                                            <div class="text-gray-600">{{ $deal->deal_amount }}</div>
                                            <div class="fw-bold mt-5">Closing Date</div>
                                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($deal->deal_closing_date)->format('d F Y') }}</div>
                                            <div class="fw-bold mt-5">Pipeline</div>
                                            <div class="text-gray-600">{{ $deal->deal_pipeline?:'N/A' }}</div>
                                            <div class="fw-bold mt-5">Communication Method</div>
                                            <div class="text-gray-600">{{ $deal->communicationMethod->method_name }}</div>
                                            <div class="fw-bold mt-5">Stage</div>
                                            <div class="text-gray-600">{{ $deal->stage->stage_name }}</div>
                                            <div class="fw-bold mt-5">Probability (%)</div>
                                            <div class="text-gray-600">{{ $deal->deal_probability }}</div>
                                            <div class="fw-bold mt-5">Expected Revenue</div>
                                            <div class="text-gray-600">{{ $deal->deal_expected_revenue }}</div>
                                            <div class="fw-bold mt-5">Permit No</div>
                                            <div class="text-gray-600">{{ $deal->deal_permit_number }}</div>
                                            <div class="fw-bold mt-5">Phone Burner Followup Date</div>
                                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($deal->deal_phone_burner_followup_date)->format('d F Y') }}</div>
                                            <div class="fw-bold mt-5">Phone Burner Last Call Time</div>
                                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($deal->deal_phone_burner_last_call_time)->format('d F Y, g:i a') }}</div>
                                            <div class="fw-bold mt-5">Availability Start</div>
                                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($deal->deal_availability_start)->format('g:i a') }}</div>
                                            <div class="fw-bold mt-5">Availability End</div>
                                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($deal->deal_availability_end)->format('g:i a') }}</div>
                                            <div class="fw-bold mt-5">Organization</div>
                                            <div class="text-gray-600">{{ $deal->organization_id?:'N/A' }}</div>
                                            <div class="fw-bold mt-5">Deal Created By</div>
                                            <div class="text-gray-600">{{ $deal->creator->name }}</div>
                                            <div class="fw-bold mt-5">Deal Created Date</div>
                                            <div class="text-gray-600">{{ \Carbon\Carbon::parse($deal->created_at)->format('d F Y, g:i a') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_stage_timeline" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>{{ $deal->deal_name }}</h2>
                            <div class="fs-6 fw-semibold text-muted">Deal stage timeline</div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body">

                        <!--begin::Timeline-->
                        <div class="timeline timeline-border-dashed">
                            @foreach ($dealTimelines as $timeline)
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                @if ($loop->last)
                                <div class="timeline-icon bg-light-primary">
                                    <i class="ki-duotone ki-calendar fs-2 text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                @else
                                <div class="timeline-icon bg-light">
                                    <i class="ki-duotone ki-check fs-2 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                @endif
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2 {{$loop->last ? 'fw-bolder text-primary' : ''}}">{{$timeline->stage->stage_name}}</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Added at {{\Carbon\Carbon::parse($timeline->created_at)->format('d F Y, g:i A')}} by <b>{{ $timeline->creator->name }}</b></div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            @endforeach
                        </div>
                        <!--end::Timeline-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
</x-default-layout>