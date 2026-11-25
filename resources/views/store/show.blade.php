@extends('layouts.store')
@section('title', $product->name . ' — Atelier')
@section('content')
<div class="breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('shop') }}">Shop</a> / {{ $product->name }}</div>
<section class="product-detail">
    <div class="detail-image"><img src="{{ $product->image_url ?: 'https://placehold.co/900x1100/f1eee8/222?text=ATELIER' }}" alt="{{ $product->name }}"></div>
    <div class="detail-info">
        <p class="eyebrow">{{ $product->category?->name ?? 'ATELIER COLLECTION' }}</p>
        <h1>{{ $product->name }}</h1>
        <p class="detail-price">RM {{ number_format($product->price, 2) }}</p>
        <p class="detail-description">{{ $product->description }}</p>
        <p class="stock-note">{{ $product->stock > 0 ? 'In stock · '.$product->stock.' available' : 'Currently out of stock' }}</p>
        @auth
            <form method="POST" action="{{ route('cart.add', $product) }}" class="add-form">@csrf
                <label>Quantity <input type="number" name="quantity" value="1" min="1" max="20"></label>
                <button class="button button-dark" @disabled($product->stock < 1)>Add to bag — RM {{ number_format($product->price, 2) }}</button>
            </form>
        @else
            <a class="button button-dark" href="{{ route('login') }}">Sign in to add to bag</a>
        @endauth
        <div class="detail-note"><strong>THE ATELIER PROMISE</strong><p>Easy everyday styling · Secure checkout · Complimentary shipping over RM150</p></div>
    </div>
</section>
@if($related->isNotEmpty())<section class="section-wrap"><div class="section-heading"><h2>You may also like</h2></div><div class="product-grid">@foreach($related as $product) @include('partials.product-card') @endforeach</div></section>@endif
@endsection
