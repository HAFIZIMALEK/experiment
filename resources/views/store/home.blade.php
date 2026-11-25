@extends('layouts.store')
@section('title', 'Atelier — Modern Essentials')
@section('content')
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">THE NEW EVERYDAY</p>
        <h1>Less, but<br><em>better.</em></h1>
        <p class="hero-text">Thoughtful wardrobe essentials designed to move with you. Discover clean silhouettes, versatile layers and effortless everyday style.</p>
        <a class="button button-dark" href="{{ route('shop') }}">Explore the collection <span>↗</span></a>
    </div>
    <div class="hero-image"><img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600" alt="Minimal fashion editorial"></div>
    <div class="hero-index">01 — 04 / NEW SEASON</div>
</section>

<section class="section-wrap">
    <div class="section-heading"><div><p class="eyebrow">CURATED FOR YOU</p><h2>Shop by category</h2></div><a class="under-link" href="{{ route('shop') }}">View all collections ↗</a></div>
    <div class="category-grid">
        @foreach($categories as $category)
            <a class="category-tile" href="{{ route('shop', ['category' => $category->slug]) }}">
                <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $category->name }}</h3><small>{{ $category->products_count }} pieces</small>
            </a>
        @endforeach
    </div>
</section>

<section class="section-wrap soft-section">
    <div class="section-heading"><div><p class="eyebrow">HANDPICKED</p><h2>Featured pieces</h2></div><a class="under-link" href="{{ route('shop') }}">Shop all ↗</a></div>
    <div class="product-grid">@forelse($featured as $product) @include('partials.product-card') @empty <p class="muted">Products are coming soon.</p> @endforelse</div>
</section>

<section class="editorial">
    <div><p class="eyebrow">A MORE CONSIDERED WARDROBE</p><h2>Style that stays<br><em>in season.</em></h2><a class="under-link" href="{{ route('shop') }}">Find your everyday pieces ↗</a></div>
    <p>We believe getting dressed should feel simple. Start with timeless essentials, add pieces you love, and make them your own.</p>
</section>

<section class="section-wrap">
    <div class="section-heading"><div><p class="eyebrow">JUST ARRIVED</p><h2>New this week</h2></div></div>
    <div class="product-grid">@foreach($latest as $product) @include('partials.product-card') @endforeach</div>
</section>
@endsection
