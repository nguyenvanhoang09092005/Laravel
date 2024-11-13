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

    public function manage()
    {
        $brands = Brand::all();
        return view('admin/brand/manage', compact('brands'));
    }
}
