<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerUserController extends Controller
{
    public function index()
    {
        return view('customer.account.accountDetail');
    }

    public function createAddress()
    {
        return view('customer.account.accountAddressAdd');
    }

    public function manageAddress()
    {
        $addresses = ShippingAddress::where('user_id', auth()->id())->get();

        return view('customer.account.accountAddress', compact('addresses'));
    }

    public function order()
    {
        $orders = Order::with(['shippingAddress', 'promotion', 'items.product'])
            ->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('customer.account.accountOrder', compact('orders'));
    }

    public function orderDetail($orderId)
    {

        $order = Order::with(['shippingAddress', 'promotion', 'items.product.category', 'items.product.brand'])
            ->where('user_id', Auth::user()->id)
            ->where('id', $orderId)
            ->firstOrFail();


        return view('customer.account.accountOrderDetail', compact('order'));
    }

    public function show($id)
    {
        $product = Product::with('product_reviews')->findOrFail($id);

        $totalReviews = $product->product_reviews->count();

        $ratings = [];
        for ($i = 1; $i <= 5; $i++) {
            $count = $product->product_reviews->where('rating', $i)->count();
            $ratings[$i] = [
                'count' => $count,
                'percentage' => $totalReviews > 0 ? round(($count / $totalReviews) * 100, 2) : 0
            ];
        }

        return view('customer.shop.detail', compact('product', 'ratings', 'totalReviews'));
    }

    public function cancel($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->status = 'canceled';
            $order->save();
        }

        return redirect()->route('account.orders.index');
    }


    public function review() {}
}
