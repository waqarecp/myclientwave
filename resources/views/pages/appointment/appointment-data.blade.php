<div id="update_followup" class="">
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" data-bs-target="#tab_timeline" href="javascript:void(0)">Update Appointment Timeline</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" data-bs-target="#tab_notes" href="javascript:void(0)">Appointment Comments</a>
        </li>
    </ul>
    <div class="tab-content" id="appointment-note-content">
        <div class="tab-pane fade show active" id="tab_timeline" role="tabpanel">
            <div class="card pt-4 mb-6 mb-xl-9">
                <h3>Update Appointment Timeline</h3>
                <form id="formUpdateAppointmentTimeline" method="post" enctype="multipart/form-data" action="{{ route('appointments.updateTimeline') }}">
                    @csrf
                    <input type="hidden" name="appointment_id" id="appointment_id" class="form-control" required value="{{ $appointment->id }}">
                    <input type="hidden" name="current_status_id" id="current_status_id" class="form-control" value="{{ $appointment->status_id ?? '' }}">
                    <input type="hidden" name="timeline_id" id="timeline_id" class="form-control" value="{{ $appointment->timeline->last()->id ?? '' }}">
                    <style>
                        .table_dep_status td {
                            vertical-align: middle !important;
                        }
                    </style>

                    <table class="table table-bordered table_dep_status">
                        <tr>
                            <td>Appointment ID</td>
                            <td><b>{{ $appointment->id ?? '---' }}</b></td>
                        </tr>
                        <tr>
                            <td>Lead Name</td>
                            <td>{{ ucwords($appointment->lead->first_name . ' ' . $appointment->lead->last_name) }}</td>
                        </tr>
                        <tr>
                            <td>Timeline Date</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->timeline_date)->format('d F Y') ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Current Status</td>
                            <td>
                                <h3>{{ $appointment->status_id ? $statuses[$appointment->status_id]['status_name'] : "No Status Added Yet!" }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" class="bg-light-primary">
                                <h4>Update Timeline Status of this Appointment</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="50%">
                                            <label>Select Status</label>
                                            <select data-bs-parent="update_followup" name="status_id" id="status_id" class="form-select" required>
                                                @foreach ($statuses as $status_id => $status)
                                                <option value="{{ $status_id }}" data-color="{{ $status->color_code }}" {{ $status_id == $appointment->status_id ? 'selected' : '' }}>
                                                    {{ $status['status_name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <label>Timeline Date</label>
                                            <input type="date" name="timeline_date" class="form-control" value="{{$appointment->timeline_date}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" title="Upload any important file for this appointment if needed!">
                                            <label>Upload Appointment Files <small>(if any)</small></label>
                                            <input type="file" style="width: 350px;" name="new_file_uploaded[]" class="form-control" multiple>
                                            <br>
                                            @if ($appointment->file_uploaded)
                                            <?php $files = explode(',', $appointment->file_uploaded); ?>
                                            <p class="text-primary">List of files uploaded for this appointment</p>
                                            @if ($files[0])
                                            @foreach ($files as $key => $file)
                                            <a class="btn btn-sm btn-active-primary border border border-primary" href="{{ url('appointmentFileUploded/' . $file) }}" target='_blank'> View File {{++$key}}</a>
                                            @endforeach
                                            @endif
                                            @else
                                            <small class="text-danger">No Files Uploaded Yet!</small>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-primary" type="button" onclick="confirmSubmit(this)" name="btn_update_lead_timeline">Update Status <i class="fa fa-check-circle"></i></button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="tab_notes" role="tabpanel">
            <div class="pt-4 mb-6 mb-xl-9">
                <div class="accordion" id="accordion_new_comment">
                    <div class="accordion-item border border-primary border-dashed">
                        <h2 class="accordion-header">
                            <button class="accordion-button fs-4 fw-semibold collapsed bg-light-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNewComment" aria-expanded="false" aria-controls="collapseNewComment">
                                {!! getIcon('plus', 'fs-2', '', 'i') !!} Add New Comment
                            </button>
                        </h2>
                        <div id="collapseNewComment" class="collapse" data-bs-parent="#accordion_new_comment">
                            <div class="card-body p-2">
                                <form method="post" enctype="multipart/form-data" id="AddLeadNote">
                                    @csrf
                                    <input type="hidden" name="appointment_id" id="new_comment_appointment_id" class="form-control" required value="{{ $appointment->id }}">
                                    <input type="hidden" name="current_status_id" id="current_status_id" class="form-control" value="{{ $appointment->status_id ?? '' }}">
                                    <input type="hidden" name="lead_id" id="lead_id" value="{{ $appointment->lead_id }}">
                                    <div class="fv-row mb-3">
                                        <label class="fw-semibold m-4">Tag users in comment</label>
                                        <label for="notify" class="btn btn-sm btn-secondary border p-2 float-end m-2"><input type="checkbox" name="notify" id="notify" value="1"> Notify Tagged Users</label>
                                        <select onchange="selectAll(this)" id="tag_users" name="user_ids[]" class="form-select select2" data-control="select2" data-search="true" multiple>
                                            <option value="all">Tag All Users</option>
                                            @foreach($users as $userId => $userName)
                                            @if ($userId != auth()->user()->id)
                                            <option value="{{$userId}}">{{ucwords($userName)}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('user_ids')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <textarea name="appointment_notes" id="appointment_notes" class="form-control mt-2"></textarea>
                                    @error('appointment_notes')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <button type="button" id="btnAddComment" data-url="{{ route('appointments.noteStore') }}" class="btn btn-sm btn-primary mt-2">Add Comment</button>
                                    <button type="reset" class="btn btn-sm btn-warning mt-2 d-none">Clear All</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    /* Styling the comment box */
                    .comment-box {
                        background-color: #f8f9fa !important; /* Light background */
                        transition: background-color 0.3s ease !important; /* Smooth transition for hover */
                        border-radius: 8px !important; /* Rounded corners */
                        padding: 20px !important;
                        position: relative !important;
                    }

                    .comment-box:hover {
                        background-color: #e2e6ea !important; /* Change background on hover */
                    }

                    .reaction-icon {
                        position: absolute; 
                        margin: -12px;
                        padding: 2px;
                        border-radius: 100%;
                    }

                    /* For reactions */
                    .reactions-container {
                        margin-top: 10px !important;
                    }

                    .reactions-container .badge {
                        margin-right: 5px !important;
                    }

                    .emoji-menu {
                        display: inline;
                        gap: 10px;
                    }

                    .emoji-item {
                        font-size: 20px;
                        cursor: pointer;
                        transition: transform 0.2s ease;
                    }

                    .emoji-item:hover {
                        transform: scale(1.2);
                    }
                </style>
                <!-- Comments -->
                <div class="mt-2" id="accordion_view_comments">
                    <div>
                        <div id="collapseViewComment" class="show active-timeline-comments" data-bs-parent="#accordion_view_comments">
                            @if (count($allAppointmentNotes) > 0)
                                @foreach ($allAppointmentNotes as $comment)
                                    <?php
                                        $taggedUsers = $comment->user_ids ? explode(",", $comment->user_ids) : [];
                                        $unreadUsers = $comment->unread_ids ? explode(",", $comment->unread_ids) : [];
                                        $reactions = json_decode($comment->reactions, true) ?? [];
                                        $userReacted = false;
                                        foreach ($reactions as $reaction) {
                                            if ($reaction['user_id'] == auth()->user()->id) {
                                                $userReacted = true;
                                                break;
                                            }
                                        }
                                    ?>
                                    <div class="comment-box mt-1 ms-3 p-3 rounded bg-light-secondary position-relative">
                                        <!-- Comment Header -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="javascript:void(0)" class="fs-6 text-gray-900 text-hover-primary me-1">
                                                <small class="text-muted">Comment added by </small>
                                                <i>{{ ucwords($users[$comment->created_by] ?? 'Unknown User') }}</i>
                                            </a>
                                            <span class="text-muted fs-7">{{ \Carbon\Carbon::parse($comment->created_at)->format('d F Y, g:i A') }}</span>
                                        </div>
                                        <div data-note-comment="{{ $comment->id }}" class="p-2 rounded text-gray-900 fw-semibold mt-2">
                                            <div class="d-inline-block">{!! $comment->notes !!}</div>
                                            @if (in_array(Auth::user()->id, $unreadUsers))
                                                <div data-unread-id="{{ $comment->id }}" class="badge badge-light-danger border border-danger float-end">Unread</div>
                                            @endif
                                        </div>
                                        <div class="mt-1">
                                            @if (in_array(Auth::user()->id, $unreadUsers))
                                                <a data-note-id="{{ $comment->id }}" href="javascript:void(0)" class="float-start badge bg-light-success" onclick="markAsRead(this, {{ $comment->id }})">
                                                    <i class="ki-duotone ki-check fs-3"></i> Mark as read
                                                </a><br><br>
                                            @endif
                                            <div class="float-end">
                                                @if($taggedUsers)
                                                    <small class="text-muted">Tagged Users: </small>
                                                    @foreach ($taggedUsers as $taggedUser)
                                                        <span class="badge bg-light-warning">
                                                            {{ ucwords($users[$taggedUser] ?? 'Unknown User') }}
                                                        </span>
                                                        @foreach($reactions as $reaction)
                                                            @if($reaction['user_id'] == $taggedUser)
                                                                <i class="reaction-icon text-primary bg-white border border-dark">
                                                                    {{ getReactionEmojis()[$reaction['reactionType']] }}
                                                                </i>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        @if (!$userReacted)
                                            <div class="reaction-options position-relative">
                                                <a href="javascript:void(0)" class="text-dark me-2" style="font-size: 20px;" data-bs-toggle="tooltip" title="Add Your Reaction..." onclick="toggleEmojiMenu(this)">
                                                    ☺
                                                </a>
                                                <div class="emoji-menu position-absolute d-none" style="top: 20px; right: 0; background: #fff; border: 1px solid #ddd; padding: 10px; border-radius: 6px; z-index: 100;">
                                                    @foreach (getReactionEmojis() as $emojiKey => $emojiIcon)
                                                        <a href="javascript:void(0)" onclick="reactToComment(this, {{ $comment->id }}, '{{ $emojiKey }}')" class="emoji-item">
                                                            {!! $emojiIcon !!}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    <h4 class="text-center">There are no comments added for this appointment! Thank you</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#status_id').select2({
            templateResult: formatState,
            templateSelection: formatState,
            dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
        });

        // Function to format Select2 options with color
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color:' + $(state.element).data('color') + '"></span>' + state.text + '</span>'
            );
            return $state;
        }

        // Re-initialize Select2 when the modal is shown
        $('#update_followup').on('shown.bs.modal', function() {
            $('#status_id').select2({
                templateResult: formatState,
                templateSelection: formatState,
                dropdownParent: $('#update_followup') // Ensure dropdown appends to modal
            });
        });
    });
    CKEDITOR.replace('appointment_notes', {
        height: '150px',
    });
    $('.select2').select2({
        placeholder: "Select users to tag", // Add placeholder
        allowClear: true // Allows clearing of the selection
    });

    function selectAll(element) {
        if ($(element).val() == 'all') {
            $("#tag_users option").each(function() {
                if ($(this).val() !== 'all') { // Exclude the option with value 'all'
                    $(this).prop("selected", true);
                } else {
                    $(this).prop("selected", false);
                }
            });
            $("#tag_users").trigger("change");
        }
    }

    function confirmSubmit(element) {
        var button = $(element);
        $(button).attr('type', 'button');
        Swal.fire({
            title: 'Update Appointment Status',
            text: "Are you sure to update this appointment status?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(button).attr('type', 'submit');
                $("#formUpdateAppointmentTimeline").submit();
            }
        });
    }

    $('#btnAddComment').on('click', function(e) {
        e.preventDefault();

        // Fetch the button and form data
        var formData = new FormData($('#AddLeadNote')[0]);
        var url = $(this).data('url');
        formData.append('appointment_notes', CKEDITOR.instances.appointment_notes.getData());

        // Perform the AJAX request
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
            },
            success: function(response) {
                if (response.success) {
                    viewAppointmentTimeline($("#new_comment_appointment_id").val(), true);
                } else {
                    Swal.fire({
                        text: 'Failed to add your comment! Try again later',
                        icon: 'error',
                        confirmButtonText: "Close",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-light-danger"
                        }
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    text: 'Failed to add your comment! Try again later',
                    icon: 'error',
                    confirmButtonText: "Close",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: "btn btn-light-danger"
                    }
                });
            }
        });
    });

    function markAsRead(element, noteId) {
        $.ajax({
            url: "{{route('appointments.markAsRead')}}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
            },
            data: {
                noteId: noteId
            },
            success: function(response) {
                if (response.success) {
                    $(element).remove();
                    $('[data-unread-id="' + noteId + '"]').remove();
                    $('[data-note-comment="' + noteId + '"]').removeClass("bg-light-primary").addClass("bg-light-secondary");
                }
            },
            error: function(data) {
                Swal.fire({
                    text: 'Failed to mark this comment as read! Try again later',
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
    var users = @json($users);
    var reactionEmojis = @json(getReactionEmojis());

    function reactToComment(element, commentId, reactionType) {
        $.ajax({
            url: "{{ route('appointments.reactToComment') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                commentId: commentId,
                reactionType: reactionType
            },
            success: function(response) {
                if (response.success) {
                    var reactionContainer = $(element).closest('.comment-box').find('.float-end');
                    reactionContainer.find('.reaction-icon').remove();
                    response.reactions.forEach(function(reaction) {
                        var userBadge = reactionContainer.find('.badge').filter(function() {
                            return $(this).text().trim() === users[reaction.user_id];
                        });

                        if (userBadge.length) {
                            var emoji = reactionEmojis[reaction.reactionType];
                            var iconHtml = '<i class="reaction-icon text-primary bg-white border border-dark" style="position: absolute; margin: -12px;padding: 2px;border-radius: 100%;">' + emoji + '</i>';
                            userBadge.after(iconHtml);
                        }
                    });
                    var emojiMenu = $(element).closest('.emoji-menu');
                    emojiMenu.addClass('d-none');
                    var moreActionsLink = $(element).closest('.reaction-options').find('a.text-dark');
                    moreActionsLink.addClass('d-none');
                } else {
                    console.error('Failed to add reaction for comment ID:', commentId);
                }
            },
            error: function() {
                Swal.fire({
                    text: 'Failed to add reaction! Try again later',
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

    function toggleEmojiMenu(element) {
        var emojiMenu = $(element).closest('.reaction-options').find('.emoji-menu');
        emojiMenu.toggleClass('d-none'); // Toggle visibility of the emoji menu
    }

</script>