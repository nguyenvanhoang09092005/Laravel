<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShippingAddress;
use App\Http\Controllers\Controller;

class SellerOrderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $orders = Order::with(['user', 'shippingAddress', 'promotion'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('seller.order.orderhistory', compact('perPage', 'orders'));
    }

    public function orderDetail($orders_id)
    {
        $order = Order::find($orders_id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $orderItems = OrderItem::where('order_id', $orders_id)->orderBy('id')->paginate(12);
        $shippingAddress = ShippingAddress::find($order->shipping_address_id);

        return view('seller.order.orderDetail', compact('order', 'orderItems', 'shippingAddress'));
    }
}
