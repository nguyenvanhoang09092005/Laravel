<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerPayController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('customer.pay.cart', compact('products'));
    }
}
