@extends('layouts.store')
@section('title', 'Your Bag — Atelier')
@section('content')
<section class="page-heading compact-heading"><p class="eyebrow">YOUR SELECTION</p><h1>Your bag</h1></section>
<section class="cart-layout section-wrap">
    <div class="cart-items">
        @forelse($cart->items as $item)
            @if($item->product)
            <article class="cart-row">
                <img src="{{ $item->product->image_url ?: 'https://placehold.co/300x360' }}" alt="">
                <div class="cart-row-info"><a href="{{ route('products.show', $item->product) }}"><strong>{{ $item->product->name }}</strong></a><p class="muted">RM {{ number_format($item->product->price, 2) }}</p>
                    <div class="cart-actions"><form method="POST" action="{{ route('cart.update', $item) }}">@csrf @method('PATCH')<input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="20"><button class="text-button">Update</button></form>
                    <form method="POST" action="{{ route('cart.remove', $item) }}">@csrf @method('DELETE')<button class="text-button remove-link">Remove</button></form></div>
                </div>
                <strong>RM {{ number_format($item->product->price * $item->quantity, 2) }}</strong>
            </article>
            @endif
        @empty
            <div class="empty-state"><h2>Your bag is waiting.</h2><p class="muted">Explore the collection and find something you love.</p><a class="button button-dark" href="{{ route('shop') }}">Continue shopping</a></div>
        @endforelse
    </div>
    @if($cart->items->isNotEmpty())
    <aside class="summary-card"><h2>Order summary</h2><div class="summary-line"><span>Subtotal</span><strong>RM {{ number_format($subtotal, 2) }}</strong></div><div class="summary-line"><span>Shipping</span><span>{{ $subtotal >= 150 ? 'Complimentary' : 'RM 8.00' }}</span></div><div class="summary-line total-line"><span>Total</span><strong>RM {{ number_format($subtotal + ($subtotal >= 150 ? 0 : 8), 2) }}</strong></div><a class="button button-dark button-full" href="{{ route('checkout') }}">Continue to checkout</a><p class="tiny muted">Shipping is complimentary on orders over RM150.</p></aside>
    @endif
</section>
@endsection
