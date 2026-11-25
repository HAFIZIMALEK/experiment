@extends('admin.layout')
@section('admin-content')
<p class="eyebrow">CATALOGUE</p><h1>{{ $product->exists ? 'Edit product' : 'Add product' }}</h1>
<form class="admin-form" method="POST" action="{{ $product->exists ? route('admin.products.update',$product) : route('admin.products.store') }}">@csrf @if($product->exists) @method('PUT') @endif
<label>Product name<input name="name" value="{{ old('name',$product->name) }}" required></label>
<label>Category<select name="category_id" required><option value="">Choose category</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id',$product->category_id)==$category->id)>{{ $category->name }}</option>@endforeach</select></label>
<div class="form-two"><label>SKU<input name="sku" value="{{ old('sku',$product->sku) }}"></label><label>Price (RM)<input type="number" step="0.01" min="0" name="price" value="{{ old('price',$product->price) }}" required></label></div>
<div class="form-two"><label>Compare at price (RM)<input type="number" step="0.01" min="0" name="compare_at_price" value="{{ old('compare_at_price',$product->compare_at_price) }}"></label><label>Stock quantity<input type="number" min="0" name="stock" value="{{ old('stock',$product->stock ?? 0) }}" required></label></div>
<label>Image URL<input type="url" name="image_url" value="{{ old('image_url',$product->image_url) }}" placeholder="https://..."></label>
<label>Description<textarea name="description" rows="5">{{ old('description',$product->description) }}</textarea></label>
<label class="check-label"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured',$product->is_featured))> Featured product</label>
<label class="check-label"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$product->exists ? $product->is_active : true))> Active / visible in store</label>
<div class="form-actions"><button class="button button-dark">Save product</button><a class="button button-outline" href="{{ route('admin.products.index') }}">Cancel</a></div>
</form>
@endsection
