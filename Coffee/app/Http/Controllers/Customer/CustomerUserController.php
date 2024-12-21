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

        $hasReviewed = $order->items->every(function ($item) {
            return $item->product->reviews()->where('user_id', auth()->id())->exists();
        });

        return view('customer.account.accountOrderDetail', compact('order', 'hasReviewed'));
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

        return redirect()->route('Customer.Account.Order');
    }

    public function confirm(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status === 'delivered') {
            $order->status = 'confirmed';
            $order->save();

            return redirect()->route('customer.shop.comment', $order->id)->with([
                'success' => 'Đơn hàng đã được xác nhận. Mời bạn để lại đánh giá cho sản phẩm!',
            ]);
        }

        return redirect()->back()->with('error', 'Không thể xác nhận đơn hàng.');
    }

    public function comment($orderId)
    {
        $order = Order::with('items.product')->where('id', $orderId)->firstOrFail();

        return view('customer.shop.comment', compact('order'));
    }

    public function saveReview(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
            'order_id' => 'required|exists:orders,id',
        ]);

        $product = Product::findOrFail($productId);

        $existingReview = $product->reviews()
            ->where('user_id', auth()->id())
            ->where('order_id', $request->order_id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này trong đơn hàng này rồi!');
        }

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        $product->update([
            'average_rating' => $product->reviews()->avg('rating'),
            'review_count' => $product->reviews()->count(),
        ]);

        return redirect()->route('Customer.Account.Order', $productId)->with('success', 'Đánh giá đã được gửi.');
    }
}
