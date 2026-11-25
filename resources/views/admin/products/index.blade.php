@extends('admin.layout')
@section('admin-content')
<div class="admin-section-head"><div><p class="eyebrow">CATALOGUE</p><h1>Products</h1></div><a class="button button-dark" href="{{ route('admin.products.create') }}">+ Add product</a></div>
<div class="table-wrap"><table class="data-table"><thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Visibility</th><th>Actions</th></tr></thead><tbody>
@forelse($products as $product)<tr><td><strong>{{ $product->name }}</strong><br><small>{{ $product->sku }}</small></td><td>{{ $product->category?->name }}</td><td>RM {{ number_format($product->price,2) }}</td><td>{{ $product->stock }}</td><td>{{ $product->is_active ? 'Active' : 'Hidden' }}</td><td class="action-cell"><a href="{{ route('admin.products.edit',$product) }}">Edit</a><form method="POST" action="{{ route('admin.products.destroy',$product) }}" onsubmit="return confirm('Hide this product?')">@csrf @method('DELETE')<button class="text-button remove-link">Hide</button></form></td></tr>@empty<tr><td colspan="6">No products found.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $products->links() }}</div>
@endsection
