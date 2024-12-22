<?php

namespace App\Http\Controllers\Seller;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SellerController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $orderCount = Order::count();

        $shippingOrdersCount = Order::where('status', 'shipping')->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $confirmedOrdersCount = Order::where('status', 'confirmed')->count();

        $adminCount = (int) User::where('role', 1)->count();
        $customerCount = (int) User::where('role', 2)->count();
        $personnelCount = (int) User::where('role', 3)->count();

        $workingHours = [8, 6, 7, 9, 5, 6, 8];



        return view('seller.dashboard', compact('usersCount', 'productsCount', 'orderCount', 'adminCount', 'customerCount', 'personnelCount',  'pendingOrdersCount', 'workingHours', 'confirmedOrdersCount', 'shippingOrdersCount'));
    }


    public function user(Request $request)
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

        return view('seller.manage.user', compact('users', 'perPage'));
    }


    public function showUser($id)
    {
        $user_info = User::findOrFail($id);
        return view('seller.manage.show', compact('user_info'));
    }

    public function promotions(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $query = Promotions::query();

        $query->with('category');

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('sku')) {
            $query->where('sku', 'LIKE', '%' . $request->input('sku') . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $promotions = $query->paginate($perPage);

        return view('seller.promotions.manage', compact('promotions', 'perPage'));
    }


    public function showPromotions($id)
    {
        try {
            $promotion = Promotions::with('product', 'category')->findOrFail($id);
            return view('seller.promotions.show', compact('promotion'));
        } catch (Exception $e) {
            return redirect()->route('Personnel.Manage.Promotions')->withErrors('Promotion not found.');
        }
    }


    public function sellerUser()
    {
        $user = Auth::user();
        return view('seller.user.account', compact('user'));
    }

    public function sellerUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');

        if ($request->hasFile('image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->profile_image = $request->file('image')->store('users', 'public');
        }


        // Lưu thông tin người dùng
        $user->save();

        return redirect()->back()->with('message', 'Update user information successfully.');
    }


    public function sellerChangePassword(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'different:current_password',
            ],
            'confirm_password' => 'required|same:new_password',
        ], [
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'new_password.regex' => 'The new password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'new_password.different' => 'The new password must be different from the current password.',
            'confirm_password.same' => 'The confirmation password must match the new password.',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('message', 'The password has been successfully updated.');
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
}
