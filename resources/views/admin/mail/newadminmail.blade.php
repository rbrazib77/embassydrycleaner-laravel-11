<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Account Created</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f4f6f8;
        font-family: Arial, sans-serif;
    }
    .email-container {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .header {
        background: #4CAF50;
        color: white;
        padding: 20px;
        text-align: center;
        font-size: 24px;
    }
    .content {
        padding: 20px;
        color: #333333;
        line-height: 1.6;
    }
    .panel {
        background: #f1f5f9;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
        border: 1px solid #e2e8f0;
    }
    .panel p {
        margin: 0;
        font-size: 16px;
    }
    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 24px;
        background: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
    }
    .footer {
        text-align: center;
        font-size: 13px;
        color: #888888;
        padding: 15px;
        background: #f9fafb;
    }
</style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            🎉 Congratulations!
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello <strong>{{ $created_by }}</strong>,</p>
            <p>Your account has been opened successfully! Please use the following information to log in:</p>

            <!-- Panel -->
            <div class="panel">
                <p><strong>Email Address:</strong> {{ $email }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
            </div>

            <!-- Button -->
            <a href="{{ url('/login') }}" class="btn mt-1">Login Now</a>
            <p>If you did not request this account, please contact our support team immediately.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            Thanks,<br>
            {{ config('app.name') }}
        </div>
    </div>
</body>
</html>
