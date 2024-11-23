<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\Promotions;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function dashboard()
    {

        return view('customer.banner');
    }
}
