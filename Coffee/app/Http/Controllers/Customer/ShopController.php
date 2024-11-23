<?php

namespace App\Http\Controllers\Customer;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('customer.shop.shop', compact('products', 'categories', 'brands'));
    }

    public function product_details($product_slug)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = DefaultAttribute::all();
        $product = Product::where('slug', $product_slug)->first();
        $rproducts = Product::where('slug', '<>', $product_slug)->get()->take(8);
        return view('customer.shop.detail', compact('product', 'categories', 'brands', 'rproducts', 'attributes'));
    }
}
