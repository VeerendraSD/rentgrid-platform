<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} | RentGrid</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #059669;
            --primary-hover: #047857;
            --primary-light: #ecfdf5;
            --primary-border: #a7f3d0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.07), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.05);
            --radius-lg: 20px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            color: var(--text-dark);
            background: var(--bg-main);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            padding-bottom: 80px;
        }

        /* Nav Header */
        header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 16px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .main-container {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 24px;
        }

        .back-nav {
            margin-bottom: 24px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            color: var(--text-dark);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            border-color: var(--primary);
            color: var(--primary);
            box-shadow: var(--shadow-sm);
            transform: translateX(-2px);
        }

        /* Product Layout Grid */
        .product-layout {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 48px;
            align-items: start;
        }

        /* Left: Media */
        .product-media {
            position: sticky;
            top: 100px;
        }

        .image-container {
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: var(--radius-lg);
            display: grid;
            place-items: center;
            font-size: 120px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .badge-stock {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--primary-border);
        }

        /* Right: Info & Form */
        .product-info {
            background: white;
            padding: 40px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .category-tag {
            display: inline-block;
            color: var(--primary);
            background: var(--primary-light);
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        h1 {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 12px;
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .description {
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 32px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border-color);
        }

        .stat-card {
            text-align: left;
        }

        .stat-label {
            display: block;
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-dark);
        }

        .price-hero {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 32px;
        }

        .price-amt {
            font-size: 42px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -1.5px;
        }

        .price-period {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 16px;
        }

        /* Form Styling */
        .booking-card {
            background: #fcfdfd;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px;
        }

        .booking-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Quantity Picker */
        .qty-picker {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn-qty {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .btn-qty:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .qty-input {
            width: 60px;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            border: 1px solid var(--border-color);
            padding: 8px;
            border-radius: var(--radius-sm);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(5, 150, 105, 0.3);
        }

        .estimate-box {
            margin-top: 24px;
            padding: 16px;
            background: #f1f5f9;
            border-radius: var(--radius-sm);
            font-size: 14px;
            color: var(--text-dark);
            border: 1px solid #e2e8f0;
        }

        .estimate-box strong {
            color: var(--primary);
        }

        .error-msg {
            color: #ef4444;
            font-size: 13px;
            margin-top: 8px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .product-layout {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .product-media {
                position: relative;
                top: 0;
            }
            .product-info {
                padding: 24px;
            }
        }

        @media (max-width: 500px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            .stat-card:last-child {
                grid-column: span 2;
                text-align: center;
                padding-top: 16px;
            }
            header {
                padding: 16px 5%;
            }
        }
    </style>
</head>

<body>

<header>
    <a href="{{ route('marketplace.index') }}" class="logo">RentGrid.</a>
    <div style="font-size: 13px; font-weight: 600; color: var(--text-muted)">Secure Guest Booking</div>
</header>

<div class="main-container">
    <div class="back-nav">
        <a href="{{ route('marketplace.index') }}" class="btn-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Marketplace
        </a>
    </div>

    <div class="product-layout">
        <!-- Product Image -->
        <div class="product-media">
            <div class="image-container">
                @switch(strtolower($item->category ?? ''))
                    @case('camera')
                    @case('cameras')
                        📷
                        @break
                    @case('bicycle')
                    @case('bicycles')
                        🚲
                        @break
                    @case('camping')
                        🏕️
                        @break
                    @case('power tools')
                    @case('power tool')
                        🛠️
                        @break
                    @default
                        📦
                @endswitch
                <div class="badge-stock">
                    {{ $item->availableQuantity(now()->toDateString(), now()->toDateString()) }} units left
                </div>
            </div>
        </div>

        <!-- Product Details & Form -->
        <div class="product-info">
            <span class="category-tag">{{ $item->category ?: 'Equipment' }}</span>
            <h1>{{ $item->name }}</h1>

            <div class="price-hero">
                <span class="price-amt">₹{{ number_format((float)$item->daily_price, 0) }}</span>
                <span class="price-period">/ day</span>
            </div>

            <p class="description">
                {{ $item->description ?: 'Premium rental equipment from our trusted partner. High quality maintained units ready for immediate pickup.' }}
            </p>

            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Stock</span>
                    <span class="stat-value">{{ $item->totalQuantity() }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Provider</span>
                    <span class="stat-value">{{ $item->shop->name ?? 'RentGrid' }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Location</span>
                    <span class="stat-value">{{ $item->shop->city ?? 'India' }}</span>
                </div>
            </div>

            <div class="booking-card">
                <h3>Booking Details</h3>
                <form id="booking-form" action="{{ route('marketplace.book', $item) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="customer_name">Full Name</label>
                        <input class="form-control" type="text" id="customer_name" name="customer_name" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="customer_email">Email Address</label>
                        <input class="form-control" type="email" id="customer_email" name="customer_email" placeholder="email@example.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Rental Period</label>
                        <div class="form-row">
                            <div>
                                <label class="stat-label" style="margin-bottom: 4px">Pickup</label>
                                <input class="form-control" type="date" id="start_date" name="start_date" min="{{ now()->toDateString() }}" required>
                            </div>
                            <div>
                                <label class="stat-label" style="margin-bottom: 4px">Return</label>
                                <input class="form-control" type="date" id="end_date" name="end_date" min="{{ now()->toDateString() }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quantity</label>
                        <div class="qty-picker">
                            <button type="button" class="btn-qty" id="qty-minus">−</button>
                            <input type="number" class="qty-input" id="quantity" name="quantity" value="1" min="1" max="{{ $item->availableQuantity(now()->toDateString(), now()->toDateString()) }}" readonly>
                            <button type="button" class="btn-qty" id="qty-plus">+</button>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="error-msg">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <button type="submit" class="btn-submit">Reserve Equipment Now</button>
                </form>

                <div class="estimate-box" id="price-estimate" style="display: none;">
                    Total for <span id="est-days">1</span> day(s): <strong id="est-total">₹0</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const qtyInput = document.getElementById('quantity');
    const plusBtn = document.getElementById('qty-plus');
    const minusBtn = document.getElementById('qty-minus');
    const estimateBox = document.getElementById('price-estimate');
    const estDays = document.getElementById('est-days');
    const estTotal = document.getElementById('est-total');

    const dailyPrice = {{ (float) $item->daily_price }};
    const maxQty = {{ (int) $item->availableQuantity(now()->toDateString(), now()->toDateString()) }};

    function updateEstimate() {
        const start = startInput.value;
        const end = endInput.value;
        const qty = parseInt(qtyInput.value);

        if (start && end && end >= start) {
            const startDate = new Date(start + 'T00:00:00');
            const endDate = new Date(end + 'T00:00:00');
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

            const total = diffDays * dailyPrice * qty;

            estDays.textContent = diffDays;
            estTotal.textContent = '₹' + total.toLocaleString();
            estimateBox.style.display = 'block';
        } else {
            estimateBox.style.display = 'none';
        }
    }

    plusBtn.onclick = () => {
        if (parseInt(qtyInput.value) < maxQty) {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            updateEstimate();
        }
    };

    minusBtn.onclick = () => {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            updateEstimate();
        }
    };

    startInput.onchange = () => {
        endInput.min = startInput.value;
        if (endInput.value && endInput.value < startInput.value) {
            endInput.value = startInput.value;
        }
        updateEstimate();
    };

    endInput.onchange = updateEstimate;
</script>

</body>
</html>
