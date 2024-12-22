<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin/category/create');
    }


    public function manage(Request $request)
    {
        $searchQuery = $request->get('name');
        $categories = Category::query();

        if ($searchQuery) {
            $categories = $categories->where('category_name', 'like', '%' . $searchQuery . '%');
        }

        $categories = $categories->with('products')->get();

        return view('admin.category.manage', compact('categories', 'searchQuery'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $categories = Category::where('category_name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($categories);
    }
}
