<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerUserController extends Controller
{
    public function index() {}

    public function createAddress() {}

    public function manageAddress() {}

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
