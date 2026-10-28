<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your RentGrid Invoice</title>
    <style>
        body {font-family:Arial,Helvetica,sans-serif; color:#18231f; padding:2rem;}
        .header {background:#16764b; color:white; padding:.8rem 1rem; border-radius:6px;}
        .content {margin-top:1rem;}
    </style>
</head>
<body>
    <div class="header">
        <h1>Your RentGrid Invoice</h1>
    </div>
    <div class="content">
        <p>Hi {{ $booking->customer_name }},</p>
        <p>Please find attached a PDF copy of your invoice for the recent rental.</p>
        <p>Invoice #: {{ $booking->invoice->invoice_number ?? 'N/A' }}</p>
        <p>Product: {{ $booking->item->name }}</p>
        <p>Quantity: {{ $booking->quantity }}</p>
        <p>Rental period: {{ $booking->start_date }} – {{ $booking->end_date }}</p>
        <p>Total amount: ₹{{ number_format($booking->total_price * (1 + config('rentgrid.tax_rate', 0.10)), 2) }}</p>
        <p>Thank you for using RentGrid!</p>
    </div>
</body>
</html>
