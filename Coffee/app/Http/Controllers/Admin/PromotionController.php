<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotions; // Use the Promotions model
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;

class PromotionController extends Controller
{
    // Display the list of promotions
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $query = Promotions::query();

        $query->with('category');

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('sku')) {
            $query->where('sku', 'LIKE', '%' . $request->input('sku') . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $promotions = $query->paginate($perPage);

        return view('admin.promotions.manage', compact('promotions', 'perPage'));
    }


    // Show the form to create a new promotion
    public function create()
    {
        $categories = Category::all(); // Get all categories
        return view('admin.promotions.create', compact('categories'));
    }

    // Store a new promotion
    public function storePromotions(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'nullable|string|max:100|unique:promotions,code',
            'type' => 'required|string|in:percentage,fixed',
            'promotion_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'discount' => 'required|numeric',
            'sku' => 'nullable|string|exists:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:In Stock,Out of Stock',
            'expiry_date' => 'nullable|date',
        ], [
            'sku.exists' => 'SKU bạn nhập không tồn tại trong hệ thống.',
        ]);



        if ($request->hasFile('promotion_img')) {
            $validatedData['promotion_img'] = $request->file('promotion_img')->store('promotions', 'public');
        }

        Promotions::create($validatedData);

        return redirect()->route('promotions.manage')->with('success', 'Promotion created successfully!');
    }


    // Show the details of a single promotion
    public function showPromotions($id)
    {
        try {
            // Load the promotion with its related product and category
            $promotion = Promotions::with('product', 'category')->findOrFail($id);
            return view('admin.promotions.show', compact('promotion'));
        } catch (Exception $e) {
            return redirect()->route('promotions.manage')->withErrors('Promotion not found.');
        }
    }

    // Show the form to edit an existing promotion
    public function editPromotions($id)
    {
        try {
            $promotion = Promotions::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('promotions.manage')->withErrors('Promotion not found.');
        }

        $categories = Category::all();
        return view('admin.promotions.edit', compact('promotion', 'categories'));
    }

    // Update an existing promotion
    public function updatePromotions(Request $request, $id)
    {
        try {
            $promotion = Promotions::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('promotions.manage')->withErrors('Promotion not found.');
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'code' => 'nullable|string|max:100|unique:promotions,code,' . $id,
            'type' => 'required|string|in:percentage,fixed',
            'promotion_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'discount' => 'required|numeric',
            'sku' => 'nullable|string|exists:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:In Stock,Out of Stock',
            'expiry_date' => 'nullable|date',
        ]);


        if ($request->hasFile('promotion_img')) {
            $validatedData['promotion_img'] = $request->file('promotion_img')->store('promotions', 'public');
        }


        // Update the promotion data
        $promotion->update($validatedData);

        return redirect()->route('promotions.manage')->with('success', 'Promotion updated successfully!');
    }

    // Delete a promotion
    public function destroyPromotions($id)
    {
        try {
            $promotion = Promotions::findOrFail($id);

            // Delete the image if it exists
            if ($promotion->promotion_img && Storage::disk('public')->exists($promotion->promotion_img)) {
                Storage::disk('public')->delete($promotion->promotion_img);
            }

            // Delete the promotion
            $promotion->delete();

            return redirect()->route('promotions.manage')->with('success', 'Promotion deleted successfully!');
        } catch (Exception $e) {
            return redirect()->route('promotions.manage')->withErrors('Promotion could not be deleted.');
        }
    }

    public function skuListPromotions(Request $request)
    {
        $search = $request->input('q', '');
        $products = Product::where('sku', 'LIKE', '%' . $search . '%')
            ->select('id', 'sku', 'name')
            ->get();

        return response()->json($products);
    }
}
