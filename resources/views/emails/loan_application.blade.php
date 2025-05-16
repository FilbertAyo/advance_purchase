<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Loan Application Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 25px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        h2 {
            color: #2c3e50;
        }
        p {
            margin-bottom: 12px;
            line-height: 1.5;
        }
        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>New Loan Application</h2>
        <p>Hello,</p>
        <p>A new loan application was submitted. Here are the details:</p>

        <p><strong>Customer Name:</strong> {{ $customer->first_name }} {{ $customer->last_name ?? '' }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>

        <p style="text-align: center;">
            <a href="{{ url('/admin/loan-applications') }}" class="btn">View Application</a>
        </p>

        <p>Kindly log in to the admin panel to review the full application and take the necessary action.</p>

        <p>Best regards,<br>
        Mars Communications Team</p>

        <div class="footer">
            This is an automated message. Please do not reply to this email.
        </div>
    </div>
</body>
</html>
