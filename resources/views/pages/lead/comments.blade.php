<div class="accordion" id="accordion_view_comments">
    <div class="accordion-item border border-primary border-dashed">
        <h2 class="accordion-header">
            <button class="accordion-button fs-4 fw-semibold bg-light-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseViewComment" aria-expanded="false" aria-controls="collapseViewComment">
                Posted Notes & Comments For This Lead 
            </button>
        </h2>
        <div id="collapseViewComment" class="collapse show" data-bs-parent="#accordion_view_comments">
            @if ($leadNotes->isNotEmpty())
            <!-- Comments -->
                @foreach ($leadNotes as $comment)
                    <div class="card-body p-2">
                        <?php 
                        $taggedUsers = $comment->user_ids ? explode(",", $comment->user_ids) : array();
                        $unreadUsers = $comment->unread_ids ? explode(",", $comment->unread_ids) : array();
                        ?>
                        <div class="ms-3">
                            <a href="javascript:void(0)" class="fs-5 text-gray-900 text-hover-primary me-1"><small class="text-muted">Comment added by </small>
                                @if (array_key_exists($comment->created_by, $users))
                                    <b>{{ ucwords($users[$comment->created_by]) }}</b>
                                @else
                                    <b>Unknown User</b> <!-- Fallback if user not found -->
                                @endif
                            </a>
                            <span class="text-muted fs-7 mb-1 float-end">{{\Carbon\Carbon::parse($comment->created_at)->format('d F Y, g:i A')}}</span>
                        </div>
                        <div data-note-comment="{{$comment->id}}" class="p-3 rounded {{in_array(Auth::user()->id, $unreadUsers) ? 'bg-light-primary' : 'bg-light-secondary'}} text-gray-900 fw-semibold border" data-kt-element="message-text">
                            <div class="d-inline-block">{!!$comment->notes!!}</div>
                            @if (in_array(Auth::user()->id, $unreadUsers))
                                <div data-unread-id="{{$comment->id}}" class="badge badge-light-danger border border-danger float-end">Unread</div>
                            @endif
                        </div>
                        <div class="ms-3 mt-2">
                            @if (in_array(Auth::user()->id, $unreadUsers))
                                <a data-note-id="{{$comment->id}}" href="javascript:void(0)" class="float-start badge bg-light-success" onclick="markAsRead(this, {{$comment->id}})">
                                    <i class="ki-duotone ki-check fs-3"></i> Mark as read
                                </a>
                            @endif
                            <div class="float-end">
                                <small class="text-muted">Tagged Users </small>
                                    @foreach ($taggedUsers as $taggedUser)
                                        @if (array_key_exists($taggedUser, $users))
                                            <span class="badge bg-light-warning">{{ ucwords($users[$taggedUser]) }}</span>
                                        @else
                                            <span class="badge bg-light-warning">Unknown User</span> <!-- Fallback if tagged user not found -->
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                        <br><br>
                    </div>
                @endforeach
            <!-- Comments -->
            @else
                <h4 class="mt-3 text-gray-600">There are not comments added for this lead!</h4>
            @endif
        </div>
    </div>
</div>
<script>
    function markAsRead(element, noteId) {
        $.ajax({
            url: "{{route('leads.markAsRead')}}",
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
</script>