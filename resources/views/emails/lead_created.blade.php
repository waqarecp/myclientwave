<!DOCTYPE html>
<html>
<head>
    <title>New Lead Created</title>
</head>
<body>
    <h1>A new lead has been created!</h1>
    <p>Lead Name: {{ $lead->first_name }} {{ $lead->last_name }}</p>
    <p>Email: {{ $lead->email }}</p>
    <p>Phone: {{ $lead->phone }}</p>
    <p>Thank you for using our application!</p>
</body>
</html>
