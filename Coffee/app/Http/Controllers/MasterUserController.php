<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterUserController extends Controller
{
    public function storemanage(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.manage.create');
        }

        $validate_data = $request->validate([
            'name' => 'required|string|max:60|min:2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|max:100|unique:users,email',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'gender' => 'required|in:male,female,other',
        ]);

        if ($request->hasFile('image')) {
            $validate_data['profile_image'] = $request->file('image')->store('users', 'public');
        }

        try {
            User::create($validate_data);
            return redirect()->route('admin.manage')->with('message', 'Thêm người dùng thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không thêm được người dùng!');
        }
    }

    public function edit($id)
    {
        $user_info = User::findOrFail($id);
        return view('admin.manage.edit', compact('user_info'));
    }

    public function showmanage($id)
    {
        $user_info = User::findOrFail($id);
        return view('admin.manage.show', compact('user_info'));
    }




    public function updatemanage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate_data = $request->validate([
            'name' => 'required|string|max:60|min:2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|max:100|unique:users,email,' . $id,
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'gender' => 'required|in:male,female,other',
        ]);

        if ($request->hasFile('image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $validate_data['profile_image'] = $request->file('image')->store('users', 'public');
        }

        try {
            $user->update($validate_data);
            session()->flash('message', "Cập nhật người dùng của ID $id thành công!");
            return redirect()->route('admin.manage.user');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không cập nhật được người dùng!');
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->delete();
            return redirect()->route('store.manage')->with('message', "Xóa người dùng của ID $id thành công!");
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không xóa được người dùng!');
        }
    }
}
