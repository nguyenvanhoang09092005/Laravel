<?php

namespace App\Http\Controllers\Seller;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $orderCount = Order::count();

        $pendingOrdersCount = Order::where('status', 'pending')->count();

        $adminCount = (int) User::where('role', 1)->count();
        $customerCount = (int) User::where('role', 2)->count();
        $personnelCount = (int) User::where('role', 3)->count();


        return view('seller.dashboard', compact('usersCount', 'productsCount', 'orderCount', 'adminCount', 'customerCount', 'personnelCount',  'pendingOrdersCount'));
    }


    public function user(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $users = User::paginate($perPage);

        return view('seller.manage.user', compact('users', 'perPage'));
    }


    public function showUser($id)
    {
        $user_info = User::findOrFail($id);
        return view('seller.manage.show', compact('user_info'));
    }

    public function promotions(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $query = Promotions::query();

        $query->with('category');

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('sku')) {
            $query->where('sku', 'LIKE', '%' . $request->input('sku') . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $promotions = $query->paginate($perPage);

        return view('seller.promotions.manage', compact('promotions', 'perPage'));
    }


    public function showPromotions($id)
    {
        try {
            $promotion = Promotions::with('product', 'category')->findOrFail($id);
            return view('seller.promotions.show', compact('promotion'));
        } catch (Exception $e) {
            return redirect()->route('Personnel.Manage.Promotions')->withErrors('Promotion not found.');
        }
    }
}
