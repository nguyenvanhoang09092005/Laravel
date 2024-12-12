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
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
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

    // public function filter(Request $request)
    // {
    //     $query = Product::query();

    //     if ($request->has('category') && $request->category) {
    //         $query->where('category_id', $request->category);
    //     }

    //     if ($request->has('brand') && count($request->brand)) {
    //         $query->whereIn('brand_id', $request->brand);
    //     }

    //     if ($request->has('price') && $request->price) {
    //         $query->where('regular_price', '<=', $request->price);
    //     }

    //     // Paginate results for smoother handling of large datasets
    //     $products = $query->paginate(12);

    //     // Return the view (rendered products) as part of the response
    //     $html = view('customer.shop.shop', compact('products'))->render();

    //     return response()->json(['html' => $html]);
    // }
}
