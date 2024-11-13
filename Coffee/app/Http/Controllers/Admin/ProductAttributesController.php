<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;

class ProductAttributesController extends Controller
{
    public function index()
    {
        return view('admin.product_attributes.create');
    }

    public function createattribute(Request $request)
    {
        $validatedData = $request->validate([
            'attribute_value' => 'required|max:255',
        ]);

        DefaultAttribute::create($validatedData);

        return redirect()->route('product_attributes.manage')->with('message', 'Attribute created successfully!');
    }

    public function manage()
    {
        $allattributes = DefaultAttribute::all();
        return view('admin.product_attributes.manage', compact('allattributes'));
    }

    public function showattribute($id)
    {
        $attri_info = DefaultAttribute::findOrFail($id);
        return view('admin.product_attributes.edit', compact('attri_info'));
    }

    public function updateattribute(Request $request, $id)
    {
        $attribute = DefaultAttribute::findOrFail($id);

        $validatedData = $request->validate([
            'attribute_value' => 'required|max:255',
        ]);

        $attribute->update($validatedData);

        return redirect()->route('product_attributes.manage')->with('message', 'Attribute updated successfully!');
    }

    public function destroy($id)
    {
        $attribute = DefaultAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('product_attributes.manage')->with('message', 'Attribute deleted successfully!');
    }
}
