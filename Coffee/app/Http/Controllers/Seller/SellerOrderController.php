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
        $searchQuery = $request->input('name');

        $orders = Order::with(['user', 'shippingAddress', 'promotion'])
            ->where(function ($query) use ($searchQuery) {
                if ($searchQuery) {
                    $query->where('order_code', 'like', '%' . $searchQuery . '%')
                        ->orWhereHas('user', function ($q) use ($searchQuery) {
                            $q->where('name', 'like', '%' . $searchQuery . '%');
                        })
                        ->orWhereHas('shippingAddress', function ($q) use ($searchQuery) {
                            $q->where('phone', 'like', '%' . $searchQuery . '%');
                        })
                        ->orWhere('payment_method', 'like', '%' . $searchQuery . '%')
                        ->orWhere('status', 'like', '%' . $searchQuery . '%')
                        ->orWhere('total_price_without_discount', 'like', '%' . $searchQuery . '%')
                        ->orWhere('total_price', 'like', '%' . $searchQuery . '%')
                        ->orWhere('total_discount', 'like', '%' . $searchQuery . '%')
                        ->orWhere('items_count', 'like', '%' . $searchQuery . '%');
                }
            })
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

    public function updateOrderStatus(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);

        $status = $request->input('status');

        $validStatuses = ['pending', 'shipping', 'delivered', 'canceled'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $order->update(['status' => $status]);

        return redirect()->route('Personnel.Order.History')->with('success', 'Order status updated successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $orders = Order::with('user', 'shippingAddress')
            ->where('order_code', 'like', '%' . $query . '%')
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('shippingAddress', function ($q) use ($query) {
                $q->where('phone', 'like', '%' . $query . '%');
            })
            ->orWhere('payment_method', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%')
            ->orWhere('total_price_without_discount', 'like', '%' . $query . '%')
            ->orWhere('total_price', 'like', '%' . $query . '%')
            ->orWhere('total_discount', 'like', '%' . $query . '%')
            ->orWhere('items_count', 'like', '%' . $query . '%')
            ->get(['id', 'order_code', 'user_id', 'payment_method', 'status', 'total_price', 'total_discount', 'items_count']);

        return response()->json($orders);
    }
}
