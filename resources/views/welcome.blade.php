<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentGrid — Rent Anything, Easily</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; color: #18231f; background: #fafbf8; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 22px 7%; background: white; border-bottom: 1px solid #eee; }
        .logo { font-size: 25px; font-weight: 800; color: #16764b; }
        nav a { margin-left: 24px; text-decoration: none; color: #34433b; font-size: 14px; }
        .hero { padding: 76px 7% 64px; background: #eaf4e9; }
        .tag { color: #16764b; font-weight: bold; font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; }
        h1 { max-width: 700px; font-size: clamp(38px, 6vw, 64px); line-height: 1.08; margin: 18px 0; letter-spacing: -2px; }
        .hero p { color: #56645b; font-size: 17px; line-height: 1.7; max-width: 560px; }
        .search { margin-top: 30px; padding: 10px; background: white; border-radius: 12px; display: flex; gap: 10px; max-width: 740px; box-shadow: 0 8px 28px #193d1810; }
        .search input { flex: 1; min-width: 0; border: 0; padding: 14px; outline: none; font-size: 15px; }
        button { background: #16764b; color: white; border: 0; padding: 14px 23px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        section { padding: 55px 7%; }
        .section-head { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 25px; }
        h2 { font-size: 29px; margin: 0 0 8px; }
        .muted { color: #6b766f; }
        .categories, .products { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; }
        .category, .product { background: white; border: 1px solid #e9ece7; border-radius: 13px; overflow: hidden; }
        .category { padding: 25px 20px; }
        .category .emoji { font-size: 34px; }
        .category h3 { margin-bottom: 5px; }
        .product img { width: 100%; height: 170px; object-fit: cover; background: #edf0eb; }
        .product-info { padding: 17px; }
        .product-info h3 { margin: 0 0 8px; }
        .price { font-weight: 800; color: #16764b; font-size: 20px; }
        .price small { font-size: 12px; font-weight: normal; color: #6b766f; }
        .business { background: #173f30; color: white; padding: 40px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; gap: 25px; }
        .business p { color: #d3e2d8; line-height: 1.6; }
        footer { padding: 28px 7%; color: #6b766f; border-top: 1px solid #eee; font-size: 13px; }
        @media (max-width: 800px) { .categories, .products { grid-template-columns: repeat(2, minmax(0, 1fr)); } header { padding: 18px 5%; } nav a { margin-left: 10px; } section { padding: 40px 5%; } .hero { padding: 55px 5%; } }
        @media (max-width: 520px) { nav a:first-child { display: none; } .search { flex-direction: column; } .search input { padding: 12px; } .categories, .products { grid-template-columns: 1fr; } .business { padding: 25px; flex-direction: column; align-items: flex-start; } }
    </style>
</head>
<body>
<header>
    <div class="logo">RentGrid.</div>
    <nav>
        <a href="#categories">Categories</a>
        <a href="#equipment">Explore</a>
        <a href="#rent-with-us">List your equipment</a>
    </nav>
</header>

<div class="hero">
    <div class="tag">The smarter way to rent</div>
    <h1>Find what you need.<br>Rent it for less.</h1>
    <p>Discover equipment from local rental businesses. Compare prices, check availability and rent what you need, when you need it.</p>
    <form class="search" action="#equipment" method="get">
        <input type="search" name="q" placeholder="What do you want to rent?">
        <button type="submit">Explore equipment →</button>
    </form>
</div>

<section id="categories">
    <div class="section-head">
        <div><h2>Explore categories</h2><div class="muted">Everything you need, without buying it.</div></div>
    </div>
    <div class="categories">
        <div class="category"><div class="emoji">📷</div><h3>Cameras</h3><div class="muted">Capture every moment</div></div>
        <div class="category"><div class="emoji">🚲</div><h3>Bicycles</h3><div class="muted">Find your next ride</div></div>
        <div class="category"><div class="emoji">🏕️</div><h3>Camping</h3><div class="muted">Gear up for outdoors</div></div>
        <div class="category"><div class="emoji">🛠️</div><h3>Power tools</h3><div class="muted">Get the job done</div></div>
    </div>
</section>

<section id="equipment">
    <div class="section-head">
        <div><h2>Popular rentals</h2><div class="muted">A preview of what you'll find on RentGrid.</div></div>
    </div>
    <div class="products">
        <article class="product">
            <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=700&q=80" alt="Camera">
            <div class="product-info"><h3>Mirrorless Camera</h3><p class="muted">Photography</p><div class="price">₹900 <small>/ day</small></div></div>
        </article>
        <article class="product">
            <img src="https://images.unsplash.com/photo-1485965120184-e220f721d03e?auto=format&fit=crop&w=700&q=80" alt="Bicycle">
            <div class="product-info"><h3>Mountain Bicycle</h3><p class="muted">Cycling</p><div class="price">₹350 <small>/ day</small></div></div>
        </article>
        <article class="product">
            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=700&q=80" alt="Camping tent">
            <div class="product-info"><h3>Camping Tent</h3><p class="muted">Outdoor gear</p><div class="price">₹500 <small>/ day</small></div></div>
        </article>
        <article class="product">
            <img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=700&q=80" alt="Power tools">
            <div class="product-info"><h3>Power Tool Kit</h3><p class="muted">Tools & equipment</p><div class="price">₹450 <small>/ day</small></div></div>
        </article>
    </div>
</section>

<section id="rent-with-us">
    <div class="business">
        <div><h2>Have equipment to rent?</h2><p>Bring your rental business online. Manage your listings and reach more customers with RentGrid.</p></div>
        <button type="button" onclick="alert('Business registration will be available in a future phase.')">Become a rental partner →</button>
    </div>
</section>

<footer>© 2026 RentGrid. A marketplace for things worth renting.</footer>
</body>
</html>