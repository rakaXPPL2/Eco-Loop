<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // If the authenticated user is admin or shipping staff, redirect appropriately
        if (auth()->check() && auth()->user()->isShippingAdmin()) {
            return redirect()->route('admin.shipments');
        }

        if (auth()->check() && auth()->user()->isCourier()) {
            return redirect()->route('courier.deliveries');
        }

        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $user = auth()->user()->load(['cart.items', 'cart']);

        // Get statistics
        $totalCarbon = User::sum('total_carbon_saved');
        $totalProducts = Product::where('status', 'available')->count();
        $totalUsers = User::count();
        $totalOrders = Order::count();

        // Get latest products
        $latestProducts = Product::with(['category', 'user.store'])
            ->available()
            ->latest()
            ->take(8)
            ->get();

        // Get categories with product counts
        $categories = Category::withCount(['products' => function ($query) {
            $query->available();
        }])->active()->get();

        // Get top users (leaderboard preview)
        $topUsers = User::orderBy('total_carbon_saved', 'desc')
            ->take(5)
            ->get();

        return view('eco-loop.pages.home', compact(
            'totalCarbon',
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'latestProducts',
            'categories',
            'topUsers'
        ));
    }
}
