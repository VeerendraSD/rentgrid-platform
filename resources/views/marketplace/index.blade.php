<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentGrid — Equipment Rental Marketplace</title>
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
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            color: var(--text-dark);
            background: var(--bg-main);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }

        /* Header */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .logo-badge {
            background: var(--primary-light);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            border: 1px solid var(--primary-border);
            text-transform: uppercase;
        }

        nav { display: flex; align-items: center; gap: 20px; }
        nav a {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 600;
            transition: color 0.15s ease;
        }
        nav a:hover { color: var(--primary); }
        .nav-btn {
            background: var(--text-dark);
            color: white !important;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease !important;
        }
        .nav-btn:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        /* Hero */
        .hero {
            padding: 60px 7% 50px;
            background: linear-gradient(135deg, #f0fdf4 0%, #e6f4ea 100%);
            border-bottom: 1px solid #dcfce7;
        }
        .hero-container { max-width: 1200px; margin: 0 auto; }
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary);
            background: rgba(255, 255, 255, 0.8);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid var(--primary-border);
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }
        h1 {
            max-width: 750px;
            font-size: clamp(36px, 5vw, 56px);
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1.5px;
            color: #064e3b;
            font-weight: 800;
        }
        .hero p {
            color: #374151;
            font-size: 18px;
            line-height: 1.6;
            max-width: 600px;
            font-weight: 400;
        }

        /* Search Form */
        .search-box {
            margin-top: 28px;
            padding: 6px 6px 6px 18px;
            background: white;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 680px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
        }
        .search-icon { color: var(--text-muted); font-size: 18px; }
        .search-box input {
            flex: 1;
            min-width: 0;
            border: 0;
            outline: none;
            font-size: 15px;
            font-family: inherit;
            color: var(--text-dark);
        }
        .search-box button {
            background: var(--primary);
            color: white;
            border: 0;
            padding: 12px 24px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .search-box button:hover {
            background: var(--primary-hover);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        /* Section Layout */
        main { max-width: 1280px; margin: 0 auto; }
        section { padding: 48px 7%; }
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }
        h2 { font-size: 28px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 4px; }
        .muted { color: var(--text-muted); font-size: 14px; }

        /* Category Filter Pills */
        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }
        .category-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }
        .category-card:hover {
            border-color: var(--primary-border);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: var(--primary-light);
        }
        .category-card.active {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 0 2px var(--primary-border);
        }
        .category-icon {
            font-size: 28px;
            width: 52px;
            height: 52px;
            background: #f1f5f9;
            border-radius: 12px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }
        .category-info h3 { font-size: 16px; font-weight: 700; margin-bottom: 2px; }
        .category-info span { font-size: 13px; color: var(--text-muted); }

        /* Active Filter Chip */
        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--primary-border);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        .filter-chip a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            background: rgba(5, 150, 105, 0.2);
            border-radius: 50%;
            font-size: 12px;
            transition: background 0.15s ease;
        }
        .filter-chip a:hover { background: var(--primary); color: white; }

        /* Product Grid */
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 24px;
        }
        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
            position: relative;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: #cbd5e1;
        }
        .product-image {
            height: 190px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            font-size: 56px;
            position: relative;
            user-select: none;
        }
        .product-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(4px);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            color: #047857;
            border: 1px solid #d1fae5;
            box-shadow: var(--shadow-sm);
        }
        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .product-category {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--primary);
            margin-bottom: 6px;
        }
        .product-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.35;
            color: var(--text-dark);
        }
        .product-desc {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-footer {
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .price-tag {
            font-weight: 800;
            color: var(--primary);
            font-size: 20px;
            letter-spacing: -0.5px;
        }
        .price-tag small {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
        }
        .btn-rent {
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--primary-border);
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .product-card:hover .btn-rent {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 4px 10px rgba(5, 150, 105, 0.25);
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            background: white;
            border-radius: var(--radius-lg);
            border: 1px dashed var(--border-color);
        }
        .empty-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state h3 { font-size: 18px; margin-bottom: 6px; }

        /* Smooth Pagination */
        .pagination-wrapper {
            margin-top: 36px;
            display: flex;
            justify-content: center;
        }
        .pagination-wrapper nav { display: flex; gap: 8px; }
        .pagination-wrapper a, .pagination-wrapper span {
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            background: white;
            font-size: 14px;
            font-weight: 600;
        }

        /* Partner Banner */
        .partner-banner {
            background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
            color: white;
            padding: 44px;
            border-radius: var(--radius-lg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            box-shadow: var(--shadow-md);
        }
        .partner-banner h2 { font-size: 28px; color: white; margin-bottom: 8px; }
        .partner-banner p { color: #a7f3d0; font-size: 15px; max-width: 500px; }
        .btn-partner {
            background: var(--primary);
            color: white;
            padding: 14px 28px;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 15px;
            white-space: nowrap;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        }
        .btn-partner:hover {
            background: #10b981;
            transform: translateY(-2px);
        }

        footer {
            padding: 32px 7%;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            font-size: 14px;
            text-align: center;
            background: white;
        }

        @media (max-width: 768px) {
            header { padding: 14px 5%; }
            section { padding: 36px 5%; }
            .hero { padding: 40px 5%; }
            .partner-banner { flex-direction: column; align-items: flex-start; padding: 28px; }
        }
    </style>
</head>

<body>

<header>
    <a class="logo" href="{{ route('marketplace.index') }}">
        RentGrid <span class="logo-badge">Marketplace</span>
    </a>

    <nav>
        <a href="#categories">Categories</a>
        <a href="#equipment">Browse All</a>
        <a class="nav-btn" href="{{ route('dashboard') }}">Admin Dashboard</a>
    </nav>
</header>

<div class="hero">
    <div class="hero-container">
        <div class="tag">⚡ Rent Anything, Anytime</div>
        <h1>Find what you need.<br>Rent it for less.</h1>
        <p>Discover top-grade camera gear, tools, camping equipment and bikes from trusted local rental providers.</p>

        <form class="search-box" action="{{ route('marketplace.index') }}" method="GET">
            <span class="search-icon">🔍</span>
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search cameras, power tools, camping gear, bikes...">
            <button type="submit">Search Equipment</button>
        </form>
    </div>
</div>

<main>
    <section id="categories">
        <div class="section-head">
            <div>
                <h2>Browse Categories</h2>
                <p class="muted">Select a category to filter available equipment</p>
            </div>
            @if(request('q'))
                <div class="filter-chip">
                    Search: "{{ request('q') }}"
                    <a href="{{ route('marketplace.index') }}" title="Clear search">✕</a>
                </div>
            @endif
        </div>

        <div class="categories">
            <a class="category-card {{ request('q') == 'camera' ? 'active' : '' }}" href="{{ route('marketplace.index', ['q' => 'camera']) }}">
                <div class="category-icon">📷</div>
                <div class="category-info">
                    <h3>Cameras & Video</h3>
                    <span>DSLRs, Drones & Kits</span>
                </div>
            </a>

            <a class="category-card {{ request('q') == 'bicycle' ? 'active' : '' }}" href="{{ route('marketplace.index', ['q' => 'bicycle']) }}">
                <div class="category-icon">🚲</div>
                <div class="category-info">
                    <h3>Bicycles & Scooters</h3>
                    <span>Commuters & Mountain</span>
                </div>
            </a>

            <a class="category-card {{ request('q') == 'camping' ? 'active' : '' }}" href="{{ route('marketplace.index', ['q' => 'camping']) }}">
                <div class="category-icon">🏕️</div>
                <div class="category-info">
                    <h3>Camping & Outdoors</h3>
                    <span>Tents, Sleeping Bags & Coolers</span>
                </div>
            </a>

            <a class="category-card {{ request('q') == 'power tools' ? 'active' : '' }}" href="{{ route('marketplace.index', ['q' => 'power tools']) }}">
                <div class="category-icon">🛠️</div>
                <div class="category-info">
                    <h3>Power Tools</h3>
                    <span>Drills, Saws & Generators</span>
                </div>
            </a>
        </div>
    </section>

    <section id="equipment">
        <div class="section-head">
            <div>
                <h2>{{ request('q') ? 'Filter Results' : 'Available Equipment' }}</h2>
                <p class="muted">
                    @if(request('q'))
                        Showing listings matching <strong>"{{ request('q') }}"</strong>
                    @else
                        Instant availability check on dates and quantities
                    @endif
                </p>
            </div>

            @if(request('q'))
                <a class="filter-chip" href="{{ route('marketplace.index') }}">
                    Clear all filters ✕
                </a>
            @endif
        </div>

        @if($items->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🔎</div>
                <h3>No equipment found matching your search</h3>
                <p class="muted">Try searching with a broader keyword like "camera", "drill", "bike" or "tent".</p>
                <a href="{{ route('marketplace.index') }}" class="btn-partner" style="display:inline-block; margin-top:16px;">View All Equipment</a>
            </div>
        @else
            <div class="products">
                @foreach($items as $item)
                    <article class="product-card">
                        <a href="{{ route('marketplace.show', $item) }}">
                            <div class="product-image">
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
                                <span class="product-badge">{{ $item->totalQuantity() }} units in stock</span>
                            </div>
                        </a>

                        <div class="product-info">
                            <div class="product-category">{{ $item->category ?: 'Equipment' }}</div>
                            <h3 class="product-title">
                                <a href="{{ route('marketplace.show', $item) }}">{{ $item->name }}</a>
                            </h3>
                            <p class="product-desc">{{ \Illuminate\Support\Str::limit($item->description ?? 'High quality rental equipment available for instant booking.', 85) }}</p>

                            <div class="product-footer">
                                <div class="price-tag">
                                    ₹{{ number_format((float)$item->daily_price, 0) }}
                                    <small>/ day</small>
                                </div>
                                <a class="btn-rent" href="{{ route('marketplace.show', $item) }}">
                                    Book Now →
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section>
        <div class="partner-banner">
            <div>
                <h2>Have equipment sitting idle?</h2>
                <p>Monetize your gear. RentGrid helps local businesses and individuals list inventory and connect with renters effortlessly.</p>
            </div>
            <a class="btn-partner" href="{{ route('dashboard') }}">Open Shop Dashboard →</a>
        </div>
    </section>
</main>

<footer>
    © {{ date('Y') }} RentGrid. A smart equipment rental marketplace.
</footer>

</body>
</html>