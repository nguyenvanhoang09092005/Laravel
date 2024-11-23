<?php

namespace App\Http\Controllers\Customer;

use App\Models\Promotions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerPromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotions::all();
        $promotionsInStock = Promotions::where('status', 'In Stock')->get();
        $promotionsOutStock = Promotions::where('status', 'Out of Stock')->get();
        return view('customer.promotions', compact('promotions', 'promotionsInStock', 'promotionsOutStock'));
    }
}
