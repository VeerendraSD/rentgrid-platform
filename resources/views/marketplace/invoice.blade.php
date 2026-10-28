<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $booking->invoice->invoice_number ?? 'N/A' }}</title>
    <style>
        body {font-family: Arial, sans-serif; padding: 2rem; color:#18231f;}
        .header {background:#16764b; color:white; padding:1rem; border-radius:8px;}
        .content {margin-top:1rem;}
        .section {margin-bottom:1rem;}
        .row {display:flex; justify-content:space-between;}
        .total {font-weight:bold; font-size:1.2rem;}
        table {width:100%; border-collapse:collapse; margin-top:.5rem;}
        th, td {border:1px solid #e8ece7; padding:.5rem; text-align:left;}
        th {background:#f1f5f0;}
    </style>
</head>
<body>
    <div class="header">
        <h1>Invoice</h1>
    </div>
    <div class="content">
        <div class="section">
            <strong>Invoice #: </span> {{ $booking->invoice->invoice_number }}
        </div>
        <div class="section">
            <strong>Bill To:</span> {{ $booking->customer_name }}<br>
            {{ $booking->customer_email }}
        </div>
        <div class="section">
            <strong>Product:</span> {{ $booking->item->name }}
        </div>
        <div class="section">
            <strong>Rental Period:</span> {{ $booking->start_date }} – {{ $booking->end_date }}
        </div>
        <div class="section">
            <strong>Quantity:</span> {{ $booking->quantity }}
        </div>
        <table>
            <tr><th>Description</th><th>Rate</th><th>Days</th><th>Qty</th><th>Amount</th></tr>
            <tr><td>{{ $booking->item->name }}</td><td>₹{{ number_format((float) $booking->item->daily_price, 2) }}</td><td>{{ $booking->start_date->diffInDays($booking->end_date) + 1 }}</td><td>{{ $booking->quantity }}</td><td>₹{{ number_format($booking->total_price, 2) }}</td></tr>
            <tr><td colspan="4" style="text-align:right;">Subtotal</td><td>₹{{ number_format($booking->total_price, 2) }}</td></tr>
            <tr><td colspan="4" style="text-align:right;">Tax ({{ config('rentgrid.tax_rate', 0.10) * 100 }}%)</td><td>₹{{ number_format($booking->total_price * config('rentgrid.tax_rate', 0.10), 2) }}</td></tr>
            <tr class="total"><td colspan="4" style="text-align:right;">Total</td><td>₹{{ number_format($booking->total_price * (1 + config('rentgrid.tax_rate', 0.10)), 2) }}</td></tr>
        </table>
    </div>
</body>
</html>
