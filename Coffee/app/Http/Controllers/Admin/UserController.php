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
        $searchQuery = $request->input('name');
        $role = $request->input('role');

        $query = User::query();

        if ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('address', 'like', '%' . $searchQuery . '%')
                ->orWhere('phone_number', 'like', '%' . $searchQuery . '%')
                ->orWhere('gender', 'like', '%' . $searchQuery . '%')
                ->orWhere('role', 'like', '%' . $searchQuery . '%');
        }

        if ($role) {
            $roleMap = [
                'admin' => 1,
                'customer' => 2,
                'seller' => 3
            ];
            $roleId = $roleMap[strtolower($role)] ?? null;
            if ($roleId) {
                $query->where('role', $roleId);
            }
        }

        $users = $query->paginate($perPage);

        return view('admin.manage.user', compact('users', 'perPage'));
    }


    public function create()
    {
        return view('admin.manage.create');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('address', 'like', '%' . $query . '%')
            ->orWhere('phone_number', 'like', '%' . $query . '%')
            ->orWhere('gender', 'like', '%' . $query . '%')
            ->orWhere('role', 'like', '%' . $query . '%')
            ->get();

        return response()->json($users);
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|integer|in:1,2,3',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.manage.user')->with('success', 'Cập nhật vai trò thành công!');
    }
}
