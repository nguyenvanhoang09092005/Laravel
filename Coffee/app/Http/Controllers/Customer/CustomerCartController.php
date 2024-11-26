<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Promotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerCartController extends Controller
{
    public function addToCart($id, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này');
        }

        $product = Product::findOrFail($id);
        $user = Auth::user();

        $promotion = null;
        if ($product->promotion_id) {
            $promotion = DB::table('promotions')->find($product->promotion_id);
        }

        $price = isset($product->discounted_price) && $product->discounted_price > 0
            ? $product->discounted_price
            : $product->regular_price;

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'name' => $product->product_name,
                'quantity' => $request->quantity,
                'price' => $price,
                'image' => $product->product_img,
                'promotion_id' => $promotion ? $promotion->id : null,
            ]);
        }

        return redirect()->route('Customer.Cart.View')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('Customer.Cart.View');
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);

        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        $subtotal = $cartItem->quantity * $cartItem->price;
        $totalPrice = Cart::where('user_id', auth()->id())
            ->sum(DB::raw('quantity * price'));

        return response()->json([
            'subtotal' => number_format($subtotal, 2),
            'totalPrice' => number_format($totalPrice, 2),
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $user = Auth::user();

        // Kiểm tra xem người dùng đã nhập mã giảm giá hay chưa
        if (!$couponCode) {
            session()->forget('applied_coupon');
            return redirect()->route('Customer.Cart.View')->with('error', 'Bạn chưa nhập mã giảm giá.');
        }

        $promotion = Promotions::where('code', $couponCode)->first();

        // Kiểm tra mã giảm giá hợp lệ
        if (!$promotion) {
            session()->forget('applied_coupon');
            return redirect()->route('Customer.Cart.View')->with('error', 'Mã giảm giá không hợp lệ.');
        }

        // Kiểm tra xem mã giảm giá đã hết hạn chưa
        if ($promotion->expiry_date && $promotion->expiry_date < now()) {
            session()->forget('applied_coupon');
            return redirect()->route('Customer.Cart.View')->with('error', 'Mã giảm giá đã hết hạn.');
        }

        // Kiểm tra xem mã giảm giá có thể áp dụng cho sản phẩm trong giỏ hàng
        $cartItems = Cart::where('user_id', $user->id)->get();
        $isValidCoupon = false;

        foreach ($cartItems as $item) {
            $product = $item->product;

            if (($promotion->sku && $promotion->sku == $product->sku) ||
                ($promotion->category_id && $promotion->category_id == $product->category_id)
            ) {
                $isValidCoupon = true;
                break;
            }
        }

        if (!$isValidCoupon) {
            session()->forget('applied_coupon');
            return redirect()->route('Customer.Cart.View')->with('error', 'Mã giảm giá không áp dụng cho sản phẩm trong giỏ hàng.');
        }

        // Kiểm tra nếu đã có mã giảm giá đang áp dụng
        if (session()->has('applied_coupon')) {
            session()->forget('applied_coupon');
            return redirect()->route('Customer.Cart.View')->with('error', 'Bạn chỉ có thể áp dụng một mã giảm giá duy nhất.');
        }

        // Lưu mã giảm giá vào session
        session(['applied_coupon' => $couponCode]);

        // Tính toán tổng giá trị giỏ hàng sau khi áp dụng mã giảm giá
        $totalPrice = 0;
        $totalDiscount = 0;

        foreach ($cartItems as $item) {
            $productPrice = $item->price * $item->quantity;

            $discountAmount = ($promotion->discount / 100) * $productPrice;
            $productPrice -= $discountAmount;

            $totalPrice += $productPrice;
            $totalDiscount += $discountAmount;

            $item->promotion_id = $promotion->id;
            $item->save();
        }

        return redirect()->route('Customer.Cart.View')->with('success', 'Mã giảm giá đã được áp dụng.');
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product', 'promotion')->get();
        $totalPrice = 0;
        $totalDiscount = 0;

        foreach ($cartItems as $item) {
            $productPrice = $item->price * $item->quantity;

            if ($item->promotion) {
                $discountAmount = ($item->promotion->discount / 100) * $productPrice;
                $productPrice -= $discountAmount;
                $totalDiscount += $discountAmount;
            }

            $totalPrice += $productPrice;
        }

        return view('customer.pay.cart', compact('cartItems', 'totalPrice', 'totalDiscount'));
    }
}
