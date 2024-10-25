<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .credentials {
            background: #f7f7f7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Our System,</h2>
        
        <p>Your account has been created successfully. Here are your login credentials:</p>
        
        <div class="credentials">
            <p><strong>Email:</strong> {{$email}}</p>
            <p><strong>Password:</strong>{{$password}}</p>
        </div>

        <p>Please change your password after your first login for security purposes.</p>
        
        <p>If you didn't request this account, please contact our support team immediately.</p>
        
        <p>Best regards,<br>Your System Team</p>
    </div>
</body>
</html>