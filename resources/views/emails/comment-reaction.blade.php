<!DOCTYPE html>
<html>
<head>
    <title>{{ ucwords($senderUser->name) }} reacted to your comment</title>
</head>
<body>
    <p>Hello {{ $receiverUser->name }},</p>
    <p>{{ ucwords($senderUser->name) }} reacted to your comment on {{ $createdAt ?: '' }}.</p>

    <!-- Display the comment -->
    @if($comment)
        <h3>Your Comment:</h3>
        {!! $comment !!}
    @endif
    <p><strong>Reaction:</strong> {{ getReactionEmojis()[$reactionType] }}</p>

    <p>Click <a href="{{ env('APP_URL') }}appointments/{{ $appointment->id }}?show_comments">here</a> to view the appointment and see the reactions.</p>
</body>
</html>
