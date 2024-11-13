<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class StoreController extends Controller
{
    public function index()
    {
        return view('admin.store.create');
    }

    public function manage()
    {
        $stores = Store::all();
        return view('admin.store.manage', compact('stores'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'store_name' => 'required|unique:stores|max:255',
            'slug' => 'required|unique:stores|max:255',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['img'] = $request->file('image')->store('stores', 'public');
        }

        Store::create($validatedData);

        return redirect()->route('admin.store.manage')->with('message', 'Store created successfully!');
    }

    public function showstore($id)
    {
        $store_info = Store::findOrFail($id);
        return view('admin.store.edit', compact('store_info'));
    }

    public function updatestore(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $validatedData = $request->validate([
            'store_name' => 'required|unique:stores,store_name,' . $id . '|max:255',
            'slug' => 'required|unique:stores,slug,' . $id . '|max:255',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($store->img) {
                Storage::disk('public')->delete($store->img);
            }
            $validatedData['img'] = $request->file('image')->store('stores', 'public');
        }

        $store->update($validatedData);

        return redirect()->route('admin.store.manage')->with('message', 'Store updated successfully!');
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        try {
            if ($store->img) {
                Storage::disk('public')->delete($store->img);
            }
            $store->delete();
            return redirect()->route('admin.store.manage')->with('message', 'Store deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Error: Could not delete store!');
        }
    }
}
