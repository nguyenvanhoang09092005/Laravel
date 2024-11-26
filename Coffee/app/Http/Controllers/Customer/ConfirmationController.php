<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->session()->get('order');
        $couponCode = $request->session()->get('coupon_code');

        if (!$order) {
            return redirect()->route('Customer.Cart.View')->with('error', 'Không tìm thấy đơn hàng.');
        }

        $orderItems = $order->items()->with('product')->get();

        $totalProductPrice = $orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $totalDiscount = $order->discount_amount ?? 0;

        $totalAfterDiscount = $totalProductPrice - $totalDiscount;

        return view('customer.pay.confirmation', compact('order', 'orderItems', 'totalDiscount', 'totalProductPrice', 'totalAfterDiscount', 'couponCode'));
    }
}
