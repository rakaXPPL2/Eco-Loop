<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'sellers'); // Default to sellers tab

        // Base query: exclude admins and users with no real transactions
        $baseQuery = User::where('role', '!=', 'admin');

        if ($type === 'sellers') {
            // Seller Leaderboard - based on total carbon saved (impact)
            $leaderboard = (clone $baseQuery)
                ->where('role', 'seller')
                ->withCount(['orders' => function ($q) {
                    $q->where('status', '!=', 'cancelled');
                }])
                ->withSum(['orders' => function ($q) {
                    $q->where('status', '!=', 'cancelled');
                }], 'total_amount')
                ->orderByDesc('total_carbon_saved')
                ->orderByDesc('orders_count')
                ->take(20)
                ->get()
                ->map(function ($user, $index) {
                    $user->rank = $index + 1;
                    // Points based on carbon saved (10 points per kg CO2)
                    $user->calculated_points = (int) ($user->total_carbon_saved * 10);
                    return $user;
                });

            $totalCarbon = (clone $baseQuery)->where('role', 'seller')->sum('total_carbon_saved');
            $totalUsers = (clone $baseQuery)->where('role', 'seller')->count();
            $totalTransactions = Order::whereIn('user_id', (clone $baseQuery)->where('role', 'seller')->pluck('id'))
                ->where('status', '!=', 'cancelled')
                ->count();
        } else {
            // Buyer Leaderboard - based on total carbon saved and purchase value
            $leaderboard = (clone $baseQuery)
                ->where('role', 'buyer')
                ->withCount(['orders' => function ($q) {
                    $q->where('status', '!=', 'cancelled');
                }])
                ->withSum(['orders' => function ($q) {
                    $q->where('status', '!=', 'cancelled');
                }], 'total_amount')
                ->orderByDesc('total_carbon_saved')
                ->orderByDesc('orders_count')
                ->take(20)
                ->get()
                ->map(function ($user, $index) {
                    $user->rank = $index + 1;
                    // Points based on carbon saved (10 points per kg CO2)
                    $user->calculated_points = (int) ($user->total_carbon_saved * 10);
                    return $user;
                });

            $totalCarbon = (clone $baseQuery)->where('role', 'buyer')->sum('total_carbon_saved');
            $totalUsers = (clone $baseQuery)->where('role', 'buyer')->count();
            $totalTransactions = Order::whereIn('user_id', (clone $baseQuery)->where('role', 'buyer')->pluck('id'))
                ->where('status', '!=', 'cancelled')
                ->count();
        }

        return view('eco-loop.pages.leaderboard', compact(
            'leaderboard',
            'totalCarbon',
            'totalUsers',
            'totalTransactions',
            'type'
        ));
    }
}
