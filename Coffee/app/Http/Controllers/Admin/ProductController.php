<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('attribute')->get();
        return view('admin.product.manage', compact('products'));
    }

    public function create()
    {
        $attributes = DefaultAttribute::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('attributes', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:products,slug',
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'sku' => 'required|string|unique:products,sku',
            'stock_quantity' => 'required|integer',
            'stock_status' => 'required|in:In Stock,Out of Stock',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'attribute_id' => 'nullable|exists:attributes,id',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('product_img')) {
            $validatedData['product_img'] = $request->file('product_img')->store('products', 'public');
        }

        $validatedData['admin_id'] = Auth::id();

        Product::create($validatedData);

        return redirect()->route('product.create')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        try {
            $product = Product::with('attribute')->findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('product.manage')->withErrors('Product not found.');
        }

        return view('admin.product.show', compact('product'));
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('product.manage')->withErrors('Product not found.');
        }

        $attributes = DefaultAttribute::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'attributes', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('product.manage')->withErrors('Product not found.');
        }

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:products,slug,' . $id,
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'stock_quantity' => 'required|integer',
            'stock_status' => 'required|in:In Stock,Out of Stock',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'attribute_id' => 'nullable|exists:attributes,id',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('product_img')) {
            if ($product->product_img && Storage::disk('public')->exists($product->product_img)) {
                Storage::disk('public')->delete($product->product_img);
            }
            $validatedData['product_img'] = $request->file('product_img')->store('products', 'public');
        }

        $validatedData['admin_id'] = Auth::id();

        $product->update($validatedData);

        return redirect()->route('product.manage')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->product_img && Storage::disk('public')->exists($product->product_img)) {
                Storage::disk('public')->delete($product->product_img);
            }

            $product->delete();

            return redirect()->route('product.manage')->with('success', 'Product deleted successfully!');
        } catch (Exception $e) {
            return redirect()->route('product.manage')->withErrors('Product could not be deleted.');
        }
    }

    public function manageProductReview()
    {
        return view('admin.product.manage_product_review');
    }
}
