<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function home()
    {
        $featured = Product::where('is_active', true)->where('is_featured', true)
            ->latest()->take(8)->get();
        $latest = Product::where('is_active', true)->latest()->take(8)->get();
        $categories = Category::where('is_active', true)->withCount([
            'products' => fn ($q) => $q->where('is_active', true),
        ])->get();

        return view('store.home', compact('featured', 'latest', 'categories'));
    }

    public function shop(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('search')) {
            $term = trim($request->search);
            $query->where(fn ($q) => $q->where('name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%"));
        }
        if ($request->get('sort') === 'price_low') $query->orderBy('price');
        elseif ($request->get('sort') === 'price_high') $query->orderByDesc('price');
        else $query->latest();

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('store.shop', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);
        $product->load('category');
        $related = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)->take(4)->get();

        return view('store.show', compact('product', 'related'));
    }
}
