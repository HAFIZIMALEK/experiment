<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'customers' => User::where('role', 'customer')->count(),
            'revenue' => Order::whereIn('status', ['processing', 'shipped', 'completed'])->sum('total'),
        ];
        $orders = Order::with('user')->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'orders'));
    }
}
