@extends('admin.layout')
@section('admin-content')
<p class="eyebrow">CATALOGUE</p><h1>Categories</h1>
<form class="inline-create" method="POST" action="{{ route('admin.categories.store') }}">@csrf<input name="name" placeholder="New category name" required><input name="description" placeholder="Short description"><button class="button button-dark">Add category</button></form>
<div class="table-wrap"><table class="data-table"><thead><tr><th>Category</th><th>Products</th><th>Action</th></tr></thead><tbody>@foreach($categories as $category)<tr><td><strong>{{ $category->name }}</strong><br><small>{{ $category->description }}</small></td><td>{{ $category->products_count }}</td><td><form method="POST" action="{{ route('admin.categories.destroy',$category) }}" onsubmit="return confirm('Delete category?')">@csrf @method('DELETE')<button class="text-button remove-link">Delete</button></form></td></tr>@endforeach</tbody></table></div><div class="pagination">{{ $categories->links() }}</div>
@endsection
