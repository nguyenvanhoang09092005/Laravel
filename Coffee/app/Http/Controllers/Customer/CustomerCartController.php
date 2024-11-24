<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
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

        // Kiểm tra xem mã giảm giá có tồn tại không
        $promotion = DB::table('promotions')->where('code', $couponCode)->first();

        if (!$promotion) {
            return redirect()->route('Customer.Cart.View')->with('error', 'Mã giảm giá không hợp lệ.');
        }

        // Lấy tất cả các sản phẩm trong giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $productPrice = $item->price * $item->quantity;

            $discountAmount = ($promotion->discount / 100) * $productPrice;
            $productPrice -= $discountAmount;

            $totalPrice += $productPrice;

            $item->promotion_id = $promotion->id;
            $item->save();
        }

        return redirect()->route('Customer.Cart.View')->with('success', 'Mã giảm giá đã được áp dụng!');
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
