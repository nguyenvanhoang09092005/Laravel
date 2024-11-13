<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainBrandController extends Controller
{

    public function storebrand(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.brand.create');
        }

        $validate_data = $request->validate([
            'brand_name' => 'required|unique:brands|max:100|min:2',
            'describe' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validate_data['brand_logo'] = $request->file('image')->store('brands', 'public');
        }

        try {
            Brand::create($validate_data);
            return redirect()->route('store.brand')->with('message', 'Thêm thương hiệu thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không thêm được thương hiệu!');
        }
    }

    public function showbrand($id)
    {
        $brand_info = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand_info'));
    }

    public function updatebrand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validate_data = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name,' . $id . '|max:100|min:2',
            'describe' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($brand->brand_logo) {
                Storage::disk('public')->delete($brand->brand_logo);
            }
            $validate_data['brand_logo'] = $request->file('image')->store('brands', 'public');
        }

        try {
            $brand->update($validate_data);
            return redirect()->route('store.brand')->with('message', "Cập nhật thương hiệu của ID $id thành công!");
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Lỗi, không cập nhật được thương hiệu!');
        }
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        try {
            if ($brand->brand_logo) {
                Storage::disk('public')->delete($brand->brand_logo);
            }
            $brand->delete();
            return redirect()->route('store.brand')->with('success', "Xóa thương hiệu của ID $id thành công!");
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi, không xóa được thương hiệu!');
        }
    }
}
