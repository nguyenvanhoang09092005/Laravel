<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $products = Product::orderBy('created_at', 'DESC')->paginate(6);

        return view('customer.shop.shop', compact('products', 'categories', 'brands'));
    }

    public function product_details($product_slug)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = DefaultAttribute::all();
        $product = Product::where('slug', $product_slug)->first();
        $category = $product->category;
        $brand = $product->brand;
        $rproducts = Product::where('slug', '<>', $product_slug)->get()->take(8);
        return view('customer.shop.detail', compact('product', 'categories', 'brands',  'category', 'brand', 'rproducts', 'attributes'));
    }



    public function filter(Request $request)
    {
        $query = Product::query();

        if ($categories = $request->input('category', [])) {
            $query->whereIn('category_id', $categories);
        }

        if ($brandIds = $request->input('brand', [])) {
            $query->whereIn('brand_id', $brandIds);
        }

        if ($price = $request->input('price')) {
            $query->where('regular_price', '<=', $price);
        }

        if ($price = $request->input('price')) {
            $query->where('regular_price', '<=', $price)
                ->orWhere('discounted_price', '<=', $price);
        }
        $products = $query->paginate();

        if ($request->ajax()) {
            return view('customer.shop.partials.products', compact('products'));
        }

        return view('customer.shop.shop', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::orderBy('brand_name', 'ASC')->get(),
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::all();
        $brands = Brand::all();

        $products = Product::where('product_name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate();

        return view('customer.shop.shop', compact('products', 'categories', 'brands'));
    }
}
