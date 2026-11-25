<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart?->load('items.product');
        abort_if(! $cart || $cart->items->isEmpty(),  redirect()->route('cart')->with('error', 'Your bag is empty.'));
        $subtotal = $cart->items->sum(fn ($item) => $item->product->price * $item->quantity);

        return view('store.checkout', compact('cart', 'subtotal'));
    }

    public function place(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:1000'],
            'payment_method' => ['required', Rule::in(['cod'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = DB::transaction(function () use ($data) {
            $cart = auth()->user()->cart()->with('items.product')->firstOrFail();
            abort_if($cart->items->isEmpty(),  redirect()->route('cart')->with('error', 'Your bag is empty.'));

            $subtotal = 0;
            foreach ($cart->items as $item) {
                $product = $item->product()->lockForUpdate()->first();
                if (! $product || ! $product->is_active || $product->stock < $item->quantity) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'cart' => 'One or more items are no longer available in the requested quantity.',
                    ]);
                }
                $subtotal += (float) $product->price * $item->quantity;
            }

            $shipping = $subtotal >= 150 ? 0 : 8;
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'AT-' . now()->format('ymd') . '-' . Str::upper(Str::random(6)),
                'customer_name' => $data['customer_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'shipping_address' => $data['shipping_address'],
                'subtotal' => $subtotal,
                'shipping_fee' => $shipping,
                'total' => $subtotal + $shipping,
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart->items as $item) {
                $product = $item->product;
                $lineTotal = (float) $product->price * $item->quantity;
                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'sku' => $product->sku,
                    'unit_price' => $product->price,
                    'quantity' => $item->quantity,
                    'line_total' => $lineTotal,
                ]);
                $product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
            return $order;
        });

        return redirect()->route('account.orders')->with('success', 'Order placed. Your order number is ' . $order->order_number);
    }
}
