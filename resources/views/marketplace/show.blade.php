<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} | RentGrid</title>

    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #fafbf8; color: #18231f; font-family: Arial, sans-serif; }
        header { padding: 22px 7%; background: white; border-bottom: 1px solid #e8ece7; }
        header a { color: #16764b; text-decoration: none; font-size: 25px; font-weight: 800; }
        main { max-width: 1100px; margin: 40px auto; padding: 0 24px; }
        .back { color: #16764b; text-decoration: none; display: inline-block; margin-bottom: 25px; }
        .product { display: grid; grid-template-columns: 1.1fr 1fr; gap: 40px; }
        .image { min-height: 350px; display: grid; place-items: center; background: #eaf4e9; border-radius: 16px; font-size: 100px; }
        .details { background: white; padding: 30px; border: 1px solid #e8ece7; border-radius: 16px; }
        .category { color: #16764b; font-size: 13px; font-weight: bold; text-transform: uppercase; }
        h1 { font-size: clamp(30px, 4vw, 42px); margin: 12px 0; }
        .description { color: #68746c; line-height: 1.7; }
        .price { font-size: 29px; font-weight: bold; color: #16764b; margin: 24px 0; }
        .price small { font-size: 14px; font-weight: normal; color: #68746c; }
        .shop { border-top: 1px solid #e8ece7; padding-top: 18px; margin-top: 22px; }
        label { display: block; font-weight: bold; font-size: 14px; margin: 15px 0 7px; }
        input { width: 100%; padding: 12px; border: 1px solid #d5ddd6; border-radius: 8px; font: inherit; }
        button { width: 100%; margin-top: 22px; padding: 14px; border: 0; border-radius: 8px; background: #16764b; color: white; font-weight: bold; font-size: 15px; cursor: pointer; }
        .notice { background: #f1f5f0; padding: 12px; border-radius: 8px; font-size: 13px; color: #56645b; line-height: 1.6; }
        @media (max-width: 700px) { .product { grid-template-columns: 1fr; gap: 20px; } .image { min-height: 230px; } }
    </style>
</head>

<body>
<header><a href="{{ route('marketplace.index') }}">RentGrid.</a></header>

<main>
    <a class="back" href="{{ route('marketplace.index') }}">← Back to equipment</a>

    <div class="product">
        <div class="image" aria-label="Equipment image placeholder">📦</div>

        <div class="details">
            <div class="category">{{ $item->category ?: 'Equipment' }}</div>
            <h1>{{ $item->name }}</h1>

            <p class="description">
                {{ $item->description ?: 'Contact the rental shop for more information about this item.' }}
            </p>

            <div class="price">
                ₹{{ number_format((float)$item->daily_price, 2) }}
                <small>/ day</small>
            </div>

            <div class="shop">
                <strong>Rental provider</strong>
                <p>{{ $item->shop->name ?? 'Rental partner' }}</p>
            </div>

            <form action="{{ route('marketplace.book', $item) }}" method="POST">
    @csrf

    <label for="customer_name">Your name</label>
    <input
        type="text"
        id="customer_name"
        name="customer_name"
        value="{{ old('customer_name') }}"
        maxlength="255"
        required
    >

    <label for="customer_email">Email address</label>
    <input
        type="email"
        id="customer_email"
        name="customer_email"
        value="{{ old('customer_email') }}"
        maxlength="255"
        required
    >

    <label for="start_date">Rental start date</label>
    <input
        type="date"
        id="start_date"
        name="start_date"
        value="{{ old('start_date') }}"
        min="{{ now()->toDateString() }}"
        required
    >

    <label for="end_date">Rental end date</label>
    <input
        type="date"
        id="end_date"
        name="end_date"
        value="{{ old('end_date') }}"
        min="{{ old('start_date', now()->toDateString()) }}"
        required
    >

    @if ($errors->any())
        <div class="notice" style="color:#b42318;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <button type="submit">Request booking</button>
</form>

            <p class="notice" id="rental-message">
                Choose dates to estimate the cost. Availability has not yet been verified.
            </p>
        </div>
    </div>
</main>

<script>
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const form = document.getElementById('rental-dates');
    const message = document.getElementById('rental-message');
    const dailyPrice = {{ (float)$item->daily_price }};

    const today = new Date();
    const localToday = [
        today.getFullYear(),
        String(today.getMonth() + 1).padStart(2, '0'),
        String(today.getDate()).padStart(2, '0')
    ].join('-');

    startInput.min = localToday;
    endInput.min = localToday;

    startInput.addEventListener('change', () => {
        endInput.min = startInput.value || localToday;

        if (endInput.value && endInput.value < endInput.min) {
            endInput.value = '';
        }
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!startInput.value || !endInput.value || endInput.value < startInput.value) {
            message.textContent = 'Please select valid dates. The end date must be on or after the start date.';
            return;
        }

        const start = new Date(startInput.value + 'T00:00:00');
        const end = new Date(endInput.value + 'T00:00:00');
        const days = Math.round((end - start) / 86400000) + 1;
        const total = days * dailyPrice;

        message.textContent = `${days} rental day(s). Estimated total: ₹${total.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}. This is an estimate; availability has not yet been verified.`;
    });
</script>
</body>
</html>