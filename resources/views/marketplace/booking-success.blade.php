<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 2rem; line-height: 1.5; color: #18231f;}
        .container {max-width: 800px; margin: auto;}
        .header {background: #16764b; color: white; padding: 1rem 2rem; border-radius: 8px;}
        .details {background: #f9fafb; padding: 1.5rem; border: 1px solid #e8ece7; border-radius: 8px; margin-top: 1rem;}
        .details h2 {margin-top:0;}
        .row {display: flex; justify-content: space-between; margin-bottom: .5rem;}
        .total {font-weight: bold; font-size:1.2rem;}
        a.btn {display:inline-block; background:#16764b; color:white; padding:.6rem 1rem; border-radius:4px; text-decoration:none; margin-top:1rem;}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Booking Confirmed</h1>
    </div>
    <div class="details">
        <h2>Reference: #{{ $booking->id }}</h2>
        <div class="row"><span>Product:</span><span>{{ $booking->item->name }}</span></div>
        <div class="row"><span>Quantity:</span><span>{{ $booking->quantity }}</span></div>
        <div class="row"><span>Rental dates:</span><span>{{ $booking->start_date->format('Y-m-d') }} – {{ $booking->end_date->format('Y-m-d') }}</span></div>
        <div class="row"><span>Daily price:</span><span>₹{{ number_format((float) $booking->item->daily_price, 2) }}</span></div>
        <div class="row"><span>Days:</span><span>{{ $booking->start_date->diffInDays($booking->end_date) + 1 }}</span></div>
        <div class="row"><span>Subtotal:</span><span>₹{{ number_format($booking->total_price, 2) }}</span></div>
        <div class="row"><span>Tax ({{ config('rentgrid.tax_rate', 0.10) * 100 }}%):</span><span>₹{{ number_format($booking->total_price * config('rentgrid.tax_rate', 0.10), 2) }}</span></div>
        <div class="row total"><span>Total:</span><span>₹{{ number_format($booking->total_price * (1 + config('rentgrid.tax_rate', 0.10)), 2) }}</span></div>

        @if($booking->invoice)
            <a class="btn" href="{{ route('marketplace.invoice', $booking->id) }}" target="_blank">Download Invoice (PDF)</a>
        @endif

        <a class="btn" href="{{ URL::signedRoute('marketplace.booking-cancel', ['booking' => $booking->id]) }}" style="background:#c0392b;">Cancel Booking</a>
    </div>
</div>
</body>
</html>
