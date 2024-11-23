<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();

        $productsCount = Product::count();

        $adminCount = (int) User::where('role', 1)->count();
        $customerCount = (int) User::where('role', 2)->count();
        $personnelCount = (int) User::where('role', 3)->count();


        // Truyền dữ liệu sang view
        return view('admin.admin', compact('usersCount', 'productsCount', 'adminCount', 'customerCount', 'personnelCount'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function manage_user()
    {
        return view('admin.manage.user');
    }

    public function manage_stores()
    {
        return view('admin.manage.store');
    }
}
