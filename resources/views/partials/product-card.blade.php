<article class="product-card">
    <a class="product-image" href="{{ route('products.show', $product) }}">
        <img src="{{ $product->image_url ?: 'https://placehold.co/700x900/f1eee8/222?text=ATELIER' }}" alt="{{ $product->name }}" loading="lazy">
        @if($product->is_featured)<span class="image-tag">FEATURED</span>@endif
    </a>
    <div class="product-meta">
        <div><a class="product-name" href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
            @if($product->category)<p class="muted">{{ $product->category->name }}</p>@endif</div>
        <strong>RM {{ number_format($product->price, 2) }}</strong>
    </div>
</article>
