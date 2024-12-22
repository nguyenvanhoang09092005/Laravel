<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin/brand/create');
    }

    public function manage(Request $request)
    {
        $searchQuery = $request->get('name');
        $brands = Brand::query();

        if ($searchQuery) {
            $brands = $brands->where('brand_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('describe', 'like', '%' . $searchQuery . '%');
        }

        $brands = $brands->get();

        return view('admin.brand.manage', compact('brands', 'searchQuery'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $brands = Brand::where('brand_name', 'like', '%' . $query . '%')
            ->orWhere('describe', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($brands);
    }
}
