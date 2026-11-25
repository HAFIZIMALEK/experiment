@extends('admin.layout')
@section('admin-content')
<p class="eyebrow">STORE MANAGEMENT</p><h1>Overview</h1><p class="muted">A quick look at your store activity.</p>
<div class="stats-grid">
@foreach([['Products',$stats['products']],['Categories',$stats['categories']],['Orders',$stats['orders']],['Customers',$stats['customers']],['Revenue','RM '.number_format($stats['revenue'],2)]] as $stat)<div class="stat-card"><span>{{ $stat[0] }}</span><strong>{{ $stat[1] }}</strong></div>@endforeach
</div>
<div class="admin-section-head"><h2>Recent orders</h2><a class="under-link" href="{{ route('admin.orders.index') }}">View all ↗</a></div>
<div class="table-wrap"><table class="data-table"><thead><tr><th>Order</th><th>Customer</th><th>Date</th><th>Total</th><th>Status</th></tr></thead><tbody>@forelse($orders as $order)<tr><td>{{ $order->order_number }}</td><td>{{ $order->customer_name }}</td><td>{{ $order->created_at->format('d M Y') }}</td><td>RM {{ number_format($order->total,2) }}</td><td>{{ ucfirst($order->status) }}</td></tr>@empty<tr><td colspan="5">No orders yet.</td></tr>@endforelse</tbody></table></div>
@endsection
