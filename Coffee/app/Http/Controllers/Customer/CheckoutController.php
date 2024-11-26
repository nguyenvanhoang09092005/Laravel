<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promotions;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalPrice = 0;
        $totalDiscount = 0;

        // Kiểm tra mã giảm giá từ session
        $couponCode = session('applied_coupon');
        $promotion = null;

        // Tìm mã giảm giá trong CSDL nếu có
        if ($couponCode) {
            $promotion = Promotions::where('code', $couponCode)->first();
        }

        foreach ($cartItems as $item) {
            $productPrice = $item->price * $item->quantity;

            if ($promotion) {
                // Áp dụng mã giảm giá nếu có
                $discountAmount = ($promotion->discount / 100) * $productPrice;
                $productPrice -= $discountAmount;
                $totalDiscount += $discountAmount;
            }

            $totalPrice += $productPrice;
        }

        return view('customer.pay.checkout', compact('cartItems', 'totalPrice', 'totalDiscount'));
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'zip' => 'nullable|string|max:10',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'locality' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'payment_method' => 'required|string|in:bank_transfer,cod,momo,zalopay',
        ]);

        // Lưu địa chỉ giao hàng
        $shippingAddress = ShippingAddress::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'zip' => $validated['zip'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'locality' => $validated['locality'],
            'landmark' => $validated['landmark'],
        ]);

        // Lấy dữ liệu giỏ hàng
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalPrice = 0;
        $totalDiscount = 0;
        $totalPriceWithoutDiscount = 0;
        $itemsCount = 0;

        // Kiểm tra mã giảm giá từ session
        $couponCode = session('applied_coupon');
        $promotion = null;

        // Nếu có mã giảm giá
        if ($couponCode) {
            $promotion = Promotions::where('code', $couponCode)->first();
        }

        // Tính toán tổng giá trị đơn hàng
        foreach ($cartItems as $item) {
            $productPrice = $item->price * $item->quantity;

            $totalPriceWithoutDiscount += $productPrice;
            $itemsCount += $item->quantity;

            if ($promotion) {
                // Áp dụng giảm giá nếu có
                $discountAmount = ($promotion->discount / 100) * $productPrice;
                $productPrice -= $discountAmount;
                $totalDiscount += $discountAmount;
            }

            $totalPrice += $productPrice;
            $item->promotion_id = $promotion ? $promotion->id : null;
            $item->save();
        }

        // Lưu đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_address_id' => $shippingAddress->id,
            'promotion_id' => $promotion ? $promotion->id : null,
            'total_price_without_discount' => $totalPriceWithoutDiscount,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
            'items_count' => $itemsCount,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        // Lưu từng sản phẩm vào bảng `order_items`
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'name' => $item->name,
                'img' => $item->image,
                'quantity' => $item->quantity,
                'price' => $item->price,

            ]);
        }

        // Xóa giỏ hàng
        Cart::where('user_id', Auth::id())->delete();

        $request->session()->put('order', $order);
        $request->session()->put('coupon_code', $couponCode);

        return redirect()->route('Customer.Confirmation')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }
}
