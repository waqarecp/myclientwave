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
<div class="accordion" id="accordion_view_comments">
    <div class="accordion-item border border-primary border-dashed">
        <h2 class="accordion-header">
            <button class="accordion-button fs-4 fw-semibold bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseViewComment" aria-expanded="false" aria-controls="collapseViewComment">
                Appointment Posted Notes & Comments
            </button>
        </h2>
        <div id="collapseViewComment" class="collapse show" data-bs-parent="#accordion_view_comments">
            @if ($appointmentNotes->isNotEmpty())
            <!-- Comments -->
            @foreach ($appointmentNotes as $comment)
            <?php
                $taggedUsers = $comment->user_ids ? explode(",", $comment->user_ids) : array();
                $unreadUsers = $comment->unread_ids ? explode(",", $comment->unread_ids) : array();
                $reactions = json_decode($comment->reactions, true) ?? [];
                $userReacted = false;
                foreach ($reactions as $reaction) {
                    if ($reaction['user_id'] == auth()->user()->id) {
                        $userReacted = true;
                        break;
                    }
                }
            ?>
            <div class="card-body comment-box p-2">
                <div class="ms-3">
                    <a href="javascript:void(0)" class="fs-5 text-gray-900 text-hover-primary me-1"><small class="text-muted">Comment added by </small>
                        @if (array_key_exists($comment->created_by, $users))
                            <b>{{ ucwords($users[$comment->created_by]) }}</b>
                        @else
                            <b>Unknown User</b>
                        @endif
                    </a>
                    <span class="text-muted fs-7 mb-1 float-end">{{\Carbon\Carbon::parse($comment->created_at)->format('d F Y, g:i A')}}</span>
                </div>
                <div data-note-comment="{{$comment->id}}" class="p-2 rounded text-gray-900 fw-semibold mt-2">
                    <div class="d-inline-block">{!!$comment->notes!!}</div>
                    @if (in_array(Auth::user()->id, $unreadUsers))
                    <div data-unread-id="{{$comment->id}}" class="badge badge-light-danger border border-danger float-end">Unread</div>
                    @endif
                </div>
                <div class="ms-3 mt-2">
                    @if (in_array(Auth::user()->id, $unreadUsers))
                    <a data-note-id="{{$comment->id}}" href="javascript:void(0)" class="float-start badge bg-light-success" onclick="markAsRead(this, {{$comment->id}})">
                        <i class="ki-duotone ki-check fs-3"></i> Mark as read
                    </a><br><br>
                    @endif
                    <div class="float-end">
                        <small class="text-muted">Tagged Users </small>
                        @foreach ($taggedUsers as $taggedUser)
                            @if (array_key_exists($taggedUser, $users))
                                <span class="badge bg-light-warning">{{ ucwords($users[$taggedUser]) }}</span>
                            @else
                                <span class="badge bg-light-warning">Unknown User</span>
                            @endif
                            @foreach($reactions as $reaction)
                                @if($reaction['user_id'] == $taggedUser)
                                    <i class="reaction-icon text-primary bg-white border border-dark">
                                        {{ getReactionEmojis()[$reaction['reactionType']] }}
                                    </i>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
                @if (!$userReacted)
                    <div class="reaction-options position-relative">
                        <a href="javascript:void(0)" class="text-dark me-2" onclick="toggleEmojiMenu(this)">
                            More Actions <i class="fa fa-ellipsis-h"></i>
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
            <h5 class="mt-3 text-gray-600 text-center">There are not comments for this appointment on status &nbsp;<b>{{$statusName}}</b></h5>
            @endif
        </div>
    </div>
</div>
<script>
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