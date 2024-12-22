<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;

class SellerProductController extends Controller
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

        return view('seller.product.manage', compact('products', 'perPage', 'searchQuery'));
    }



    public function showProduct($id)
    {
        try {
            $product = Product::with('attribute')->findOrFail($id);

            $reviews = $product->reviews()->with('user')->latest()->get();
            $reviewsCount = $product->reviews()->count();

            $totalRating = $reviews->sum('rating');
            $averageRating = $reviewsCount > 0 ? $totalRating / $reviewsCount : 0;

            $product->update([
                'average_rating' => $averageRating,
            ]);

            return view('seller.product.show', compact('product', 'reviews', 'reviewsCount'));
        } catch (Exception $e) {
            return redirect()->route('personnel.product.manage')->withErrors('Product not found.');
        }
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('product_name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($products);
    }
}
