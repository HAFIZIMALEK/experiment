@extends('layouts.store')
@section('title', 'My orders — Atelier')
@section('content')
<section class="page-heading compact-heading"><p class="eyebrow">YOUR ATELIER ACCOUNT</p><h1>My orders</h1></section>
<section class="section-wrap">
@if($orders->isEmpty())<div class="empty-state"><h2>No orders yet.</h2><a class="button button-dark" href="{{ route('shop') }}">Explore the shop</a></div>
@else
<div class="table-wrap"><table class="data-table"><thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Payment</th><th>Status</th></tr></thead><tbody>
@foreach($orders as $order)<tr><td><strong>{{ $order->order_number }}</strong><br><small>{{ $order->items->count() }} line items</small></td><td>{{ $order->created_at->format('d M Y') }}</td><td>RM {{ number_format($order->total, 2) }}</td><td>{{ strtoupper($order->payment_status) }}</td><td><span class="status">{{ ucfirst($order->status) }}</span></td></tr>@endforeach
</tbody></table></div><div class="pagination">{{ $orders->links() }}</div>
@endif
</section>
@endsection
