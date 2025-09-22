<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Get authenticated user
        $user = Auth::user();
        
        // Get user's recent orders
        $recentOrders = Order::where('user_id', $user->id)
                            ->latest()
                            ->paginate(1);
        
        // Get order statistics
        $orderStats = [
            'total' => Order::where('user_id', $user->id)->count(),
            'pending' => Order::where('user_id', $user->id)
                            ->where('status', 'pending')
                            ->count(),
            'completed' => Order::where('user_id', $user->id)
                            ->where('status', 'completed')
                            ->count(),
        ];

        return view('user.dashboard', compact('user', 'recentOrders', 'orderStats'));
    }
}
