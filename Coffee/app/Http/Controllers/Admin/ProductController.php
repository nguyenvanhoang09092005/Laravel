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
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $searchQuery = $request->get('name');

        if ($searchQuery) {
            $products = Product::where('product_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%')
                ->paginate($perPage);
        } else {
            $products = Product::with('attribute')->paginate($perPage);
        }

        return view('admin.product.manage', compact('products', 'perPage', 'searchQuery'));
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
            return view('admin.product.show', compact('product'));
        } catch (Exception $e) {
            return redirect()->route('product.manage')->withErrors('Product not found.');
        }
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

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for products based on product_name or description
        $products = Product::where('product_name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->limit(5) // Limit the number of suggestions
            ->get();

        // Return the products as a JSON response
        return response()->json($products);
    }
}
