<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MainBrandController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;

use App\Http\Controllers\Admin\StoreController;

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Admin\ProductAttributesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

// Route để hiển thị giao diện nhập OTP
Route::get('/verify', [TwoFactorController::class, 'index'])->name('verify.index');

// Route để xử lý xác minh mã OTP
Route::post('/verify', [TwoFactorController::class, 'store'])->name('verify.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'two_factor', 'rolemanager:customer'])->name('dashboard');


//admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            //setting
            Route::get('/settings', 'settings')->name('admin.setting');
            //cart
            Route::get('/cart/history', 'cart_history')->name('admin.cart.history');

            //order
            Route::get('/order/history', 'order_history')->name('admin.order.history');
            //User
            Route::get('/users', [MainUserController::class, 'index'])->name('admin.user');
            Route::put('/users/update', [MainUserController::class, 'update'])->name('user.update');
            Route::put('/users/change-password', [MainUserController::class, 'changePassword'])->name('user.change_password');


            // //payment
            // Route::get('/payment.add', 'payment_add')->name('admin.payment.add');
            // Route::get('/payment.manage', 'payment_manage')->name('admin.payment.manage');
            // //product
            // Route::get('/product.manage_product_review', 'product_manage_product_review')->name('admin.product.manage_product_review');
            // Route::get('/product.manage', 'product_manage')->name('admin.product.manage');
            // //product_attributes
            // Route::get('/product_attributes.create', 'product_attributes_create')->name('admin.product_attributes.create');
            // Route::get('/product_attributes.manage', 'product_attributes_manage')->name('admin.product_attributes.manage');
            // //promotions
            // Route::get('/promotions.create', 'promotions_create')->name('admin.promotions.create');
            // Route::get('/promotions.manage', 'promotions_manage')->name('admin.promotions.manage');
        });
        //category
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create', 'index')->name('category.create');
            Route::get('/category/manage', 'manage')->name('category.manage');
        });
        //brand
        Route::controller(BrandController::class)->group(function () {
            Route::get('/brand/create', 'index')->name('brand.create');
            Route::get('/brand/manage', 'manage')->name('brand.manage');
        });

        //payment
        Route::controller(PaymentController::class)->group(function () {

            Route::get('/payment/add', 'index')->name('payment.add');
            Route::get('/payment/manage', 'manage')->name('payment.manage');
        });

        //manager
        Route::controller(UserController::class)->group(function () {
            Route::get('/manage/user', 'index')->name('admin.manage.user');
            Route::get('/manage/create', 'create')->name('admin.manage.create');
        });

        //product
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/manage', 'index')->name('product.manage');
            Route::get('/product/create', 'create')->name('product.create');

            Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');



            Route::post('/product/store', 'store')->name('product.store');
            Route::get('/product/{id}/edit', 'edit')->name('product.edit');
            Route::put('/product/{id}', 'update')->name('product.update');
            Route::delete('/product/{id}', 'destroy')->name('product.destroy');
            Route::get('/product/manage_product_review', 'manageProductReview')->name('product.manage_product_review');
        });
        //product_attributes
        Route::controller(ProductAttributesController::class)->group(function () {

            Route::get('/product_attributes/create', 'index')->name('product_attributes.create');
            Route::get('/product_attributes/manage', 'manage')->name('product_attributes.manage');
            Route::post('/defaultattribute/create', 'createattribute')->name('attribute.create');

            Route::get('/defaultattribute/{id}', 'showattribute')->name('show.attribute');
            // Route::post('/category/{id}', 'updatecate')->name('update.cate');
            Route::put('/defaultattribute/update/{id}', [ProductAttributesController::class, 'updateattribute'])->name('update.attribute');


            Route::delete('/defaultattribute/{id}', 'destroy')->name('defaultattribute.destroy');
        });
        //promotions
        Route::controller(PromotionsController::class)->group(function () {
            Route::get('/promotions/create', 'index')->name('promotions.create');
            Route::get('/promotions/manage', 'manage')->name('promotions.manage');
        });
        //Master CategoryController
        Route::controller(MasterCategoryController::class)->group(function () {
            Route::get('/store/category', 'storecate')->name('store.cate');
            Route::post('/store/category', 'storecate')->name('store.cate.post');

            Route::get('/category/{id}', 'showcate')->name('show.cate');
            // Route::post('/category/{id}', 'updatecate')->name('update.cate');
            Route::put('/category/update/{id}', [MasterCategoryController::class, 'updatecate'])->name('update.cate');


            Route::delete('/category/{id}', 'destroy')->name('category.destroy');
        });
        //Main BrandController
        Route::controller(MainBrandController::class)->group(function () {
            Route::get('/store/brand', 'storebrand')->name('store.brand');
            Route::post('/store/brand', 'storebrand')->name('store.brand.post');

            Route::get('/brand/{id}', 'showbrand')->name('show.brand');
            // Route::post('/category/{id}', 'updatecate')->name('update.cate');
            Route::put('/brand/update/{id}', [MainBrandController::class, 'updatebrand'])->name('update.brand');


            Route::delete('/brand/{id}', 'destroy')->name('brand.destroy');
        });
        //Strore Controller
        Route::controller(StoreController::class)->group(function () {
            Route::get('/store/create', 'index')->name('admin.store');
            Route::get('/store/manage', 'manage')->name('admin.store.manage');
            Route::post('/store/publish', 'store')->name('create.store');

            Route::get('/store/{id}', 'showstore')->name('show.store');

            Route::put('/store/update/{id}', [StoreController::class, 'updatestore'])->name('update.store');
            Route::delete('/store/{id}', 'destroy')->name('store.destroy');
        });
        //Master User Controller
        Route::controller(MasterUserController::class)->group(function () {
            Route::get('/admin/store/manage', 'storemanage')->name('admin.manage'); // Adjusted route name
            Route::post('/admin/store/manage', 'storemanage')->name('admin.manage.post');

            Route::get('/product/{id}', [MasterUserController::class, 'show'])->name('user.show');
            Route::get('/admin/manage/{id}', 'showmanage')->name('manage.show');

            Route::get('/admin/manage/{id}/edit', 'edit')->name('admin.manage.edit');


            Route::put('/admin/manage/update/{id}', 'updatemanage')->name('update.manage');
            Route::delete('/admin/manage/{id}', 'destroy')->name('manage.destroy');
        });
    });
});

//personnel routes
Route::middleware(['auth', 'verified', 'rolemanager:personnel'])->group(function () {
    Route::prefix('personnel')->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('personnel');
            Route::get('/order/history', 'orderhistory')->name('personnel.order.history');
        });

        Route::controller(SellerProductController::class)->group(function () {
            Route::get('/product/create', 'index')->name('personnel.product');
            Route::get('/product/manage', 'manage')->name('personnel.product.manage');
        });
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__ . '/auth.php';
