<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all()->count();
        return view('admin/admin', compact('products'));
    }


    public function settings()
    {
        return view('admin/settings');
    }


    public function manage_user()
    {
        return view('admin/manage/user');
    }

    public function manage_stores()
    {
        return view('admin/manage/store');
    }
}
