<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Request | RentGrid</title>
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#fafbf8; color:#18231f; }
        header { padding:22px 7%; background:white; border-bottom:1px solid #eee; }
        header a { color:#16764b; text-decoration:none; font-size:25px; font-weight:800; }
        main { max-width:650px; margin:60px auto; padding:35px; background:white; border:1px solid #e9ece7; border-radius:16px; }
        h1 { color:#16764b; }
        p { line-height:1.7; }
        .total { font-size:25px; font-weight:bold; }
        a.button { display:inline-block; background:#16764b; color:white; padding:13px 20px; border-radius:8px; text-decoration:none; }
    </style>
</head>
<body>
<header><a href="{{ route('marketplace.index') }}">RentGrid.</a></header>
<main>
    <h1>Booking request saved!</h1>
    <p>Your booking reference is <strong>#{{ $booking->id }}</strong>.</p>
    <p><strong>Equipment:</strong> {{ $booking->item->name }}</p>
    <p><strong>Rental dates:</strong> {{ $booking->start_date->format('d M Y') }} – {{ $booking->end_date->format('d M Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
    <p class="total">₹{{ number_format((float) $booking->total_price, 2) }}</p>
    <p>This is a temporary booking hold. The rental provider still needs to confirm the booking.</p>
    <a class="button" href="{{ route('marketplace.index') }}">Back to marketplace</a>
</main>
</body>
</html>