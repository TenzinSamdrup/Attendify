<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Notification</title>
</head>
<body>
    <h2>New Leave Request Submitted</h2>
    <p>Dear Admin,</p>
    <p>A new leave request has been submitted with the following details:</p>
    
    <ul>
        <li><strong>Employee ID:</strong> {{ $leave->user_id }}</li>
        <li><strong>Start Date:</strong> {{ $leave->start_date }}</li>
        <li><strong>End Date:</strong> {{ $leave->end_date }}</li>
        <li><strong>Purpose:</strong> {{ $leave->purpose }}</li>
    </ul>
    
    <p>Please review and take necessary action.</p>
    <p>Thank you.</p>
</body>
</html>
