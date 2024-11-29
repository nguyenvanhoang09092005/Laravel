<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class OrderMainController extends Controller
{
    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 10);



        $orders = Order::with(['user', 'shippingAddress', 'promotion'])->orderBy('created_at', 'desc')
            ->paginate($perPage);


        return view('admin.order.history', compact('perPage', 'orders'));
    }

    public function detail($order_id)
    {
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $shippingAddress = ShippingAddress::find($order->shipping_address_id);

        return view('admin.order.detail', compact('order', 'orderItems', 'shippingAddress'));
    }

    public function updateOrderStatus(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);

        $status = $request->input('status');

        $validStatuses = ['pending', 'shipping', 'delivered', 'canceled'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $order->update(['status' => $status]);

        return redirect()->route('Admin.Order.History')->with('success', 'Order status updated successfully.');
    }
}
