<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderMainController extends Controller
{
    public function index()
    {
        return view('admin/order/history');
    }

    public function manage()
    {

        return view('admin/order/detail');
    }
}
