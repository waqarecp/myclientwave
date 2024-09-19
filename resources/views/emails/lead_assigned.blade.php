<!DOCTYPE html>
<html>
<head>
    <title>New Lead Assigned</title>
</head>
<body>
    <h1>You have been assigned a new lead!</h1>
    <p>Hello {{ $assignedUser->name }},</p>
    <p>A new lead has been assigned to you:</p>
    <ul>
        <li>Name: {{ $lead->first_name }} {{ $lead->last_name }}</li>
        <li>Email: {{ $lead->email }}</li>
        <li>Phone: {{ $lead->phone }}</li>
    </ul>
    <p>Click <a href="{{ env('APP_URL') }}/leads/{{ $lead->id }}">here</a> to view the lead.</p>
</body>
</html>
