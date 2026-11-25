<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function cartForUser(): Cart
    {
        return Cart::firstOrCreate(['user_id' => auth()->id()]);
    }

    public function index()
    {
        $cart = $this->cartForUser()->load('items.product');
        $subtotal = $cart->items->sum(fn ($item) => $item->product ? $item->product->price * $item->quantity : 0);

        return view('store.cart', compact('cart', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);
        $data = $request->validate(['quantity' => ['nullable', 'integer', 'min:1', 'max:20']]);
        $quantity = $data['quantity'] ?? 1;

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = $this->cartForUser();
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            if ($product->stock < $item->quantity + $quantity) {
                return back()->with('error', 'Not enough stock for that quantity.');
            }
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create(['product_id' => $product->id, 'quantity' => $quantity]);
        }

        return back()->with('success', 'Added to your bag.');
    }

    public function update(Request $request, $item)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:20']]);
        $cartItem = auth()->user()->cart?->items()->with('product')->findOrFail($item);
        abort_unless($cartItem, 404);

        if (! $cartItem->product || $data['quantity'] > $cartItem->product->stock) {
            return back()->with('error', 'Requested quantity is not available.');
        }

        $cartItem->update(['quantity' => $data['quantity']]);
        return back()->with('success', 'Bag updated.');
    }

    public function remove($item)
    {
        $cartItem = auth()->user()->cart?->items()->findOrFail($item);
        abort_unless($cartItem, 404);
        $cartItem->delete();

        return back()->with('success', 'Item removed.');
    }
}
