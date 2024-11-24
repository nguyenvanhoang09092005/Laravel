<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
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
                'image' => $product->product_img
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
    public function updateQuantity($id, Request $request)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('Customer.Cart.View')->with('success', 'Số lượng sản phẩm đã được cập nhật!');
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('customer.pay.cart', compact('cartItems', 'totalPrice'));
    }
}
