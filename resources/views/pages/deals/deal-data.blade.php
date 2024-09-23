<div id="update_followup" class="">
    <div class="float-end btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
        <span class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></span>
    </div>
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" data-bs-target="#tab_timeline" href="javascript:void(0)">Update Deal Timeline</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" data-bs-target="#tab_notes" href="javascript:void(0)">Deal Timeline</a>
        </li>
    </ul>
    <div class="tab-content" id="deal-note-content">
        <div class="tab-pane fade show active" id="tab_timeline" role="tabpanel">
            <div class="card pt-4 mb-6 mb-xl-9">
                <h3>Update Deal Timeline</h3>
                <form id="formUpdateDealTimeline" method="post" enctype="multipart/form-data" action="{{ route('deals.updateTimeline') }}">
                    @csrf
                    <input type="hidden" name="deal_id" id="deal_id" class="form-control" required value="{{ $deal->id }}">
                    <input type="hidden" name="current_stage_id" id="current_stage_id" class="form-control" value="{{ $deal->stage_id ?? '' }}">
                    <input type="hidden" name="deal_timeline_id" id="dea_timeline_id" class="form-control" value="{{ $deal->dealTimeline->last()->id ?? '' }}">
                    <style>
                        .table_dep_stage td {
                            vertical-align: middle !important;
                        }
                    </style>

                    <table class="table table-bordered table_dep_stage">
                        <tr>
                            <td>Deal ID</td>
                            <td><b>{{ $deal->id ?? '---' }}</b></td>
                        </tr>
                        <tr>
                            <td>Deal Name</td>
                            <td>{{ ucwords($deal->deal_name) }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Current Stage</td>
                            <td>
                                <h3>{{ $deal->stage_id ? $deal->stage->stage_name : "No Stage Added Yet!" }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" class="bg-light-primary">
                                <h4>Update Timeline Stage of this Deal</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="50%">
                                            <label>Select Stage</label>
                                            <select name="stage_id" id="timeline_stage_id" class="form-select" required>
                                                @foreach ($stages as $stage)
                                                    <option data-color="{{ $stage->stage_color_code }}" value="{{ $stage->id }}" {{ $stage->id == $deal->stage_id ? 'selected' : '' }}>
                                                        {{ $stage->stage_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-primary" type="button" onclick="confirmSubmit(this)" name="btn_update_deal_timeline">Update Stage <i class="fa fa-check-circle"></i></button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="tab_notes" role="tabpanel">
            <div class="pt-4 mb-6 mb-xl-9">
                <!-- Comments -->
                <div class="mt-2" id="accordion_view_comments">
                    <div>
                        <div id="collapseViewComment" class="show active-timeline-comments" data-bs-parent="#accordion_view_comments">
                            @if (count($allDealTimeline) > 0)
                                @foreach ($allDealTimeline as $dealTimeline)
                                    <div class="ms-3">
                                        <a href="javascript:void(0)" class="fs-5 text-gray-900 text-hover-primary me-1"><small class="text-muted">Added by </small><i>{{ ucwords($users[$dealTimeline->created_by] ?? 'Unknown User') }} </i></a>
                                        <span class="text-muted fs-7 mb-1 float-end">{{ \Carbon\Carbon::parse($dealTimeline->created_at)->format('d F Y, g:i A') }}</span>
                                    </div>
                                    <div class="p-3 rounded bg-light-secondary text-gray-900 fw-semibold border" data-kt-element="message-text">
                                        <div class="d-inline-block">{!! $dealTimeline->stage->stage_name !!}</div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    <h4 class="text-center">There are no Timeline added for this Deal! Thank you</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Comments -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#timeline_stage_id').select2({
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
        $('#update_followup').on('shown.bs.modal', function() {
            $('#timeline_stage_id').select2({
                templateResult: formatStage,
                templateSelection: formatStage,
                dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
            });
        });
    });

    function confirmSubmit(element) {
        var button = $(element);
        $(button).attr('type', 'button');
        Swal.fire({
            title: 'Update Deal Stage',
            text: "Are you sure to update this Deal Stage?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(button).attr('type', 'submit');
                $("#formUpdateDealTimeline").submit();
            }
        });
    }
</script>