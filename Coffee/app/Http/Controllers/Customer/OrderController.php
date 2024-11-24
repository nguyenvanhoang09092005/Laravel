<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->price;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_price' => $totalPrice,
            'shipping_address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.view')->with('success', 'Đơn hàng của bạn đã được tạo.');
    }

    public function viewOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->get();
        return view('order.view', compact('orders'));
    }
}
