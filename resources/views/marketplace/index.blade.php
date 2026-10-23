<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentGrid — Rent Anything, Easily</title>

    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; color: #18231f; background: #fafbf8; }
        a { color: inherit; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 22px 7%; background: white; border-bottom: 1px solid #eee; }
        .logo { font-size: 25px; font-weight: 800; color: #16764b; text-decoration: none; }
        nav { display: flex; gap: 24px; }
        nav a { text-decoration: none; color: #34433b; font-size: 14px; }
        nav a:hover, .text-link:hover { color: #16764b; }
        .hero { padding: 76px 7% 64px; background: #eaf4e9; }
        .tag { color: #16764b; font-weight: bold; font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; }
        h1 { max-width: 700px; font-size: clamp(38px, 6vw, 64px); line-height: 1.08; margin: 18px 0; letter-spacing: -2px; }
        .hero p { color: #56645b; font-size: 17px; line-height: 1.7; max-width: 560px; }
        .search { margin-top: 30px; padding: 10px; background: white; border-radius: 12px; display: flex; gap: 10px; max-width: 740px; box-shadow: 0 8px 28px #193d1810; }
        .search input { flex: 1; min-width: 0; border: 0; padding: 14px; outline: none; font-size: 15px; }
        button { background: #16764b; color: white; border: 0; padding: 14px 23px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        section { padding: 55px 7%; }
        .section-head { margin-bottom: 25px; }
        h2 { font-size: 29px; margin: 0 0 8px; }
        .muted { color: #6b766f; }
        .categories, .products { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; }
        .category, .product { background: white; border: 1px solid #e9ece7; border-radius: 13px; overflow: hidden; }
        .category { padding: 25px 20px; }
        .category .emoji { font-size: 34px; }
        .category h3 { margin-bottom: 5px; }
        .category a { text-decoration: none; }
        .product-image { height: 170px; display: grid; place-items: center; background: #edf3ed; font-size: 48px; }
        .product-info { padding: 17px; }
        .product-info h3 { margin: 0 0 8px; }
        .product-info p { line-height: 1.5; }
        .price { font-weight: 800; color: #16764b; font-size: 20px; }
        .price small { font-size: 12px; font-weight: normal; color: #6b766f; }
        .text-link { text-decoration: none; color: #16764b; font-weight: bold; }
        .empty { padding: 35px; text-align: center; background: white; border-radius: 12px; border: 1px solid #e9ece7; }
        .pagination { margin-top: 28px; }
        .pagination nav { display: flex; justify-content: space-between; }
        .business { background: #173f30; color: white; padding: 40px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; gap: 25px; }
        .business p { color: #d3e2d8; line-height: 1.6; }
        footer { padding: 28px 7%; color: #6b766f; border-top: 1px solid #eee; font-size: 13px; }
        @media (max-width: 800px) {
            .categories, .products { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            header { padding: 18px 5%; }
            nav { gap: 10px; }
            nav a { font-size: 12px; }
            section { padding: 40px 5%; }
            .hero { padding: 55px 5%; }
        }
        @media (max-width: 520px) {
            nav a:first-child { display: none; }
            .search { flex-direction: column; }
            .categories, .products { grid-template-columns: 1fr; }
            .business { padding: 25px; flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>

<body>
<header>
    <a class="logo" href="{{ route('marketplace.index') }}">RentGrid.</a>

    <nav>
        <a href="#categories">Categories</a>
        <a href="#equipment">Explore</a>
        <a href="#rent-with-us">List your equipment</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
        @endauth
    </nav>
</header>

<div class="hero">
    <div class="tag">The smarter way to rent</div>
    <h1>Find what you need.<br>Rent it for less.</h1>
    <p>Discover equipment from local rental businesses. Compare prices, check availability and rent what you need, when you need it.</p>

    <form class="search" action="{{ route('marketplace.index') }}" method="GET">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="What do you want to rent?">
        <button type="submit">Search equipment →</button>
    </form>
</div>

<section id="categories">
    <div class="section-head">
        <h2>Explore categories</h2>
        <div class="muted">Everything you need, without buying it.</div>
    </div>

    <div class="categories">
        <div class="category"><a href="{{ route('marketplace.index', ['q' => 'camera']) }}"><div class="emoji">📷</div><h3>Cameras</h3><div class="muted">Capture every moment</div></a></div>
        <div class="category"><a href="{{ route('marketplace.index', ['q' => 'bicycle']) }}"><div class="emoji">🚲</div><h3>Bicycles</h3><div class="muted">Find your next ride</div></a></div>
        <div class="category"><a href="{{ route('marketplace.index', ['q' => 'camping']) }}"><div class="emoji">🏕️</div><h3>Camping</h3><div class="muted">Gear up for outdoors</div></a></div>
        <div class="category"><a href="{{ route('marketplace.index', ['q' => 'power tools']) }}"><div class="emoji">🛠️</div><h3>Power tools</h3><div class="muted">Get the job done</div></a></div>
    </div>
</section>

<section id="equipment">
    <div class="section-head">
        <h2>{{ request('q') ? 'Search results' : 'Available equipment' }}</h2>
        <div class="muted">
            @if(request('q'))
                Results for "{{ request('q') }}"
                · <a href="{{ route('marketplace.index') }}">Clear search</a>
            @else
                Find something useful for your next project or adventure.
            @endif
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty">
            <h3>No equipment found</h3>
            <p class="muted">Try a different search term.</p>
            <a href="{{ route('marketplace.index') }}">View all equipment</a>
        </div>
    @else
        <div class="products">
            @foreach($items as $item)
                <article class="product">
                    <a href="{{ route('marketplace.show', $item) }}" style="text-decoration:none;">
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
                                🛠️
                                @break
                                @default
                                📦
                            @endswitch
                        </div>
                    </a>

                    <div class="product-info">
                        <p class="muted" style="font-size:12px;margin:0 0 8px;">{{ $item->category ?: 'Equipment' }}</p>
                        <h3><a class="text-link" href="{{ route('marketplace.show', $item) }}">{{ $item->name }}</a></h3>
                        <p class="muted" style="font-size:14px;">{{ \Illuminate\Support\Str::limit($item->description ?? 'Available from a local rental business.', 90) }}</p>
                        <div class="price">₹{{ number_format((float)$item->daily_price, 2) }} <small>/ day</small></div>
                        <p class="muted" style="font-size:13px;">{{ $item->shop->name ?? 'Rental partner' }}</p>
                        <a class="text-link" href="{{ route('marketplace.show', $item) }}">View details →</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="pagination">{{ $items->links() }}</div>
    @endif
</section>

<section id="rent-with-us">
    <div class="business">
        <div>
            <h2>Have equipment to rent?</h2>
            <p>Bring your rental business online. Manage your listings and reach more customers with RentGrid.</p>
        </div>
        @auth
            <a class="text-link" style="color:white;" href="{{ route('dashboard') }}">Open dashboard →</a>
        @else
            <a class="text-link" style="color:white;" href="{{ route('login') }}">Become a rental partner →</a>
        @endauth
    </div>
</section>

<footer>© {{ date('Y') }} RentGrid. A marketplace for things worth renting.</footer>
</body>
</html>