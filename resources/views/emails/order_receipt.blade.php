<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #444;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            background: #ce1212;
            padding: 30px 20px;
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .content {
            padding: 30px;
        }

        .order-meta {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            text-align: left;
            background: #f9f9f9;
            padding: 12px;
            font-size: 13px;
            text-transform: uppercase;
            color: #888;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 15px;
        }

        .total-row {
            background: #fffcfc;
        }

        .total-label {
            text-align: right;
            font-weight: bold;
            padding-top: 20px;
        }

        .total-amount {
            color: #ce1212;
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            padding-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            padding: 20px;
            background: #fdfdfd;
        }

        .badge {
            background: #ecfdf5;
            color: #10b981;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>NAINI RESTAURANT</h1>
                <p style="margin: 5px 0 0;">Thank you for your order!</p>
            </div>

            <div class="content">
                <div class="order-meta">
                    <table style="border:none;">
                        <tr>
                            <td style="border:none; padding:0;"><strong>Order ID:</strong> #{{ $order->id }}</td>
                            <td style="border:none; padding:0; text-align:right;"><strong>Status:</strong> <span
                                    class="badge">PAID</span></td>
                        </tr>
                        <tr>
                            <td style="border:none; padding:0; font-size: 12px; color: #888;">Date:
                                {{ $order->created_at->format('d M, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>

                <p><strong>Hi {{ Auth::user()->name }},</strong></p>
                <p>We've received your order. Our chefs are already busy preparing your meal! Here is your digital
                    receipt:</p>

                <table>
                    <thead>
                        <tr>
                            <th>Dish</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:right;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->menu->name }}</td>
                                <td style="text-align:center;">{{ $item->quantity }}</td>
                                <td style="text-align:right;">{{ $order->currency }}
                                    {{ number_format($item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="2" class="total-label">Grand Total</td>
                            <td class="total-amount">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="footer">
                <p>Dev Mansoor | Naini Restaurant Management System</p>
                <p>&copy; {{ date('Y') }} Naini Restaurant. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
