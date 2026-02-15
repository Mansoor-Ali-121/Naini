<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .email-card {
            background: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #1a202c;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .body {
            padding: 30px;
            line-height: 1.6;
            color: #4a5568;
        }

        .status-box {
            background: #edf2f7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #4a5568;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #a0aec0;
        }
    </style>
</head>

<body>
    <div class="email-card">
        <div class="header">
            <h2>Naini Restaurant</h2>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $reservation->name }}</strong>,</p>

            <p>{{ $mailMessage }}</p>

            <div class="status-box">
                <p><strong>Reservation Details:</strong></p>
                <p>Date: {{ $reservation->date }}</p>
                <p>Time: {{ $reservation->time }}</p>
                <p>Persons: {{ $reservation->persons }}</p>
                <p>Current Status: <strong>{{ strtoupper($reservation->status) }}</strong></p>
            </div>

            <p>If you have any questions, feel free to contact us at
                <a href="tel:+923001234567" style="color: #007bff; text-decoration: none; font-weight: bold;">
                    +92 300 1234567
                </a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2026 Naini Restaurant. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
