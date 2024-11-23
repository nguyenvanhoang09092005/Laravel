<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController  extends Controller
{
    public function index()
    {


        return view('customer.pay.checkout');
    }
}
