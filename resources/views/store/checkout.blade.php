@extends('layouts.store')
@section('title', 'Checkout — Atelier')
@section('content')
<section class="page-heading compact-heading"><p class="eyebrow">ALMOST YOURS</p><h1>Checkout</h1></section>
<section class="checkout-layout section-wrap">
    <form class="checkout-form" method="POST" action="{{ route('checkout.place') }}">@csrf
        <h2>Delivery details</h2>
        <label>Full name<input name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required></label>
        <div class="form-two"><label>Email address<input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required></label><label>Phone number<input name="phone" value="{{ old('phone') }}" required></label></div>
        <label>Shipping address<textarea name="shipping_address" rows="4" required>{{ old('shipping_address') }}</textarea></label>
        <h2>Payment</h2>
        <label class="payment-choice"><input type="radio" name="payment_method" value="cod" checked> Cash on Delivery (COD)</label>
        <label>Order notes <textarea name="notes" rows="2" placeholder="Optional delivery instructions">{{ old('notes') }}</textarea></label>
        <button class="button button-dark button-full">Place order</button>
    </form>
    <aside class="summary-card"><h2>Your order</h2>
        @foreach($cart->items as $item)<div class="summary-line"><span>{{ $item->product->name }} × {{ $item->quantity }}</span><strong>RM {{ number_format($item->product->price * $item->quantity, 2) }}</strong></div>@endforeach
        <div class="summary-line"><span>Subtotal</span><strong>RM {{ number_format($subtotal, 2) }}</strong></div><div class="summary-line"><span>Shipping</span><span>{{ $subtotal >= 150 ? 'Free' : 'RM 8.00' }}</span></div>
        <div class="summary-line total-line"><span>Total</span><strong>RM {{ number_format($subtotal + ($subtotal >= 150 ? 0 : 8), 2) }}</strong></div>
    </aside>
</section>
@endsection
