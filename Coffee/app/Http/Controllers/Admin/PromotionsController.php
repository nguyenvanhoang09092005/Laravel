<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function index()
    {
        return view('admin.promotions.create');
    }

    public function manage()
    {
        return view('admin.promotions.manage');
    }
}
