@extends('admin.layout')
@section('admin-content')
<p class="eyebrow">FULFILMENT</p><h1>Orders</h1>
<div class="table-wrap"><table class="data-table"><thead><tr><th>Order / Customer</th><th>Total</th><th>Payment</th><th>Update status</th></tr></thead><tbody>
@forelse($orders as $order)<tr><td><strong>{{ $order->order_number }}</strong><br>{{ $order->customer_name }}<br><small>{{ $order->email }} · {{ $order->phone }}</small><br><small>{{ $order->shipping_address }}</small></td><td>RM {{ number_format($order->total,2) }}</td><td>{{ strtoupper($order->payment_status) }}</td><td><form method="POST" action="{{ route('admin.orders.update',$order) }}" class="status-form">@csrf @method('PATCH')
<select name="status">@foreach(['pending','processing','shipped','completed','cancelled'] as $status)<option value="{{ $status }}" @selected($order->status===$status)>{{ ucfirst($status) }}</option>@endforeach</select>
<select name="payment_status">@foreach(['pending','paid','failed','refunded'] as $status)<option value="{{ $status }}" @selected($order->payment_status===$status)>{{ ucfirst($status) }}</option>@endforeach</select>
<button class="button button-dark button-small">Save</button></form></td></tr>@empty<tr><td colspan="4">No orders yet.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $orders->links() }}</div>
@endsection
