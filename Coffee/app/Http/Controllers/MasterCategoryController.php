<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class MasterCategoryController extends Controller
{
    public function storecate(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.category.create');
        }

        $validate_data = $request->validate([
            'category_name' => 'required|unique:categories|max:100|min:2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validate_data['catagory_img'] = $request->file('image')->store('categories', 'public');
        }

        try {
            Category::create($validate_data);
            return redirect()->route('store.cate')->with('message', 'Thêm danh mục thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không thêm được danh mục!');
        }
    }

    public function showcate($id)
    {
        $category_info = Category::findOrFail($id);
        return view('admin.category.edit', compact('category_info'));
    }

    public function updatecate(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validate_data = $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $id . '|max:100|min:2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->catagory_img) {
                Storage::disk('public')->delete($category->catagory_img);
            }
            $validate_data['catagory_img'] = $request->file('image')->store('categories', 'public');
        }

        try {
            $category->update($validate_data);
            return redirect()->route('store.cate')->with('message', "Cập nhật danh mục của ID $id thành công!");
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không cập nhật được danh mục!');
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        try {
            if ($category->catagory_img) {
                Storage::disk('public')->delete($category->catagory_img);
            }
            $category->delete();
            return redirect()->route('store.cate')->with('message', "Xóa danh mục của ID $id thành công!");
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không xóa được danh mục!');
        }
    }
}
