<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Correct import for Request

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        // Retrieve users with pagination
        $users = User::paginate($perPage);



        return view('admin.manage.user', compact('users', 'perPage'));
    }

    public function create()
    {
        return view('admin.manage.create');
    }
}
