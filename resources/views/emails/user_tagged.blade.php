<!DOCTYPE html>
<html>
<head>
    <title>You have been tagged in a comment</title>
</head>
<body>
    <h1>You have been tagged in a comment!</h1>
    <p>Hello {{ $taggedUser->name }},</p>
    <p>{{ ucwords($senderUser->name) }} has mentioned you in a comment for the appointment on {{ $appointment->appointment_date }}.</p>
    <p>Click <a href="{{ env('APP_URL') }}appointments/{{ $appointment->id }}?show_comments">here</a> to view the appointment.</p>
</body>
</html>
