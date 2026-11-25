@extends('layouts.store')
@section('title', 'Shop — Atelier')
@section('content')
<section class="page-heading"><p class="eyebrow">THE ATELIER EDIT</p><h1>Shop all</h1><p>Everyday pieces, thoughtfully selected.</p></section>
<div class="shop-toolbar">
    <div class="category-pills"><a class="{{ !request('category') ? 'active' : '' }}" href="{{ route('shop') }}">All</a>
        @foreach($categories as $category)<a class="{{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>@endforeach
    </div>
    <form class="shop-search" method="GET" action="{{ route('shop') }}">
        @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
        <input name="search" value="{{ request('search') }}" placeholder="Search pieces...">
        <select name="sort" onchange="this.form.submit()"><option value="">Latest</option><option value="price_low" @selected(request('sort')==='price_low')>Price: low to high</option><option value="price_high" @selected(request('sort')==='price_high')>Price: high to low</option></select>
        <button class="button button-dark button-small">Search</button>
    </form>
</div>
<section class="section-wrap shop-results">
    <p class="muted">{{ $products->total() }} pieces</p>
    <div class="product-grid">@forelse($products as $product) @include('partials.product-card') @empty <p>No products found. Try another search.</p> @endforelse</div>
    <div class="pagination">{{ $products->links() }}</div>
</section>
@endsection
