<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $orderCount = Order::count();

        $shippingOrdersCount = Order::where('status', 'shipping')->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $confirmedOrdersCount = Order::where('status', 'confirmed')->count();

        $adminCount = (int) User::where('role', 1)->count();
        $customerCount = (int) User::where('role', 2)->count();
        $personnelCount = (int) User::where('role', 3)->count();

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $revenueMonth = Order::whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('total_price');

        $trafficData = [
            'dates' => [],
            'traffic' => [],
            'users' => [],
            'revenue' => [],
            'orders' => [],
        ];

        for ($day = 1; $day <= 31; $day++) {
            $date = Carbon::now()->month(Carbon::now()->month)->day($day)->format('Y-m-d');

            $traffic = Order::whereDate('created_at', $date)->count();

            $users = User::whereDate('created_at', $date)->count();

            $revenue = Order::whereDate('created_at', $date)->sum('total_price');

            $orders = Order::whereDate('created_at', $date)->count();

            $trafficData['dates'][] = $day;
            $trafficData['traffic'][] = $traffic;
            $trafficData['users'][] = $users;
            $trafficData['revenue'][] = $revenue;
            $trafficData['orders'][] = $orders;
        }


        return view('admin.admin', compact('usersCount', 'productsCount', 'orderCount', 'adminCount', 'customerCount', 'personnelCount', 'trafficData', 'pendingOrdersCount', 'shippingOrdersCount', 'confirmedOrdersCount', 'revenueMonth'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function manage_user()
    {
        return view('admin.manage.user');
    }

    public function manage_stores()
    {
        return view('admin.manage.store');
    }
}
