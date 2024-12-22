<?php

use App\Models\Promotions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MainBrandController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BrandController;

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\Admin\OrderMainController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Customer\ConfirmationController;
use App\Http\Controllers\Customer\CustomerCartController;
use App\Http\Controllers\Admin\ProductAttributesController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Customer\CustomerPromotionController;
use App\Http\Controllers\Customer\CustomerUserController;
use App\Http\Controllers\Seller\SellerOrderController;

// Định nghĩa route với tên 'welcome'
Route::get('/', function () {

    return view('welcome');
});
// Route để hiển thị giao diện nhập OTP
Route::get('/verify', [TwoFactorController::class, 'index'])->name('verify.index');

// Route để xử lý xác minh mã OTP
Route::post('/verify', [TwoFactorController::class, 'store'])->name('verify.store');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'two_factor', 'rolemanager:customer'])->name('dashboard');


//admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin');
            //setting
            Route::get('/settings', 'settings')->name('admin.setting');
            //cart
            Route::get('/cart/history', 'cart_history')->name('admin.cart.history');

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
            Route::post('/update-role', 'updateRole')->name('admin.update.role');
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
        });


        //Product review

        Route::controller(ProductReviewController::class)->group(function () {
            Route::get('/product/reviews/manage_product_review', 'index')->name('product.review.manage_product_review');
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

        //Order
        Route::controller(OrderMainController::class)->group(function () {
            Route::get('/admin/order/history', 'index')->name('Admin.Order.History');
            Route::get('/admin/orders/{order_id}/detail', 'detail')->name('Admin.Order.Detail');
            Route::put('/admin/orders/{order_id}/update', 'updateOrderStatus')->name('Admin.Order.Update');
        });

        // //promotions
        // Route::controller(PromotionsController::class)->group(function () {
        //     Route::get('/promotions/create', 'index')->name('promotions.create');
        //     Route::get('/promotions/manage', 'manage')->name('promotions.manage');
        // });
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
            Route::get('/admin/{id}', [MasterUserController::class, 'show'])->name('user.show');
            Route::get('/admin/manage/{id}', 'showmanage')->name('manage.show');
            Route::get('/admin/manage/{id}/edit', 'edit')->name('admin.manage.edit');
            Route::put('/admin/manage/update/{id}', 'updatemanage')->name('update.manage');
            Route::delete('/admin/manage/{id}', 'destroy')->name('manage.destroy');
        });

        //Promotions
        Route::controller(PromotionController::class)->group(function () {
            Route::get('/promotions/manage', 'index')->name('promotions.manage');
            Route::get('/promotions/create', 'create')->name('promotions.create');

            Route::get('/promotions/{id}', [PromotionController::class, 'showPromotions'])->name('promotions.show');
            Route::post('/promotions/store', 'storePromotions')->name('promotions.store');
            Route::get('/promotions/{id}/edit', 'editPromotions')->name('promotions.edit');
            Route::put('/promotions/{id}', 'updatePromotions')->name('promotions.update');
            Route::delete('/promotions/{id}', 'destroyPromotions')->name('promotions.destroy');
            Route::get('/promotions/sku-list', 'skuListPromotions')->name('promotions.skuList');
        });
    });
});

//personnel routes
Route::middleware(['auth', 'verified', 'rolemanager:personnel'])->group(function () {
    Route::prefix('personnel')->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('personnel');
            Route::get('/personnel/manage/user/', 'user')->name('Personnel.Manage.User');
            Route::get('/personnel/manage/user/{id}', 'showUser')->name('Personnel.Manage.User.Show');
            Route::get('/personnel/manage/promotions/', 'promotions')->name('Personnel.Manage.Promotions');
            Route::get('/personnel/manage/promotions/{id}', 'showPromotions')->name('Personnel.Manage.Promotions.Show');

            Route::get('/users/seller/',  'sellerUser')->name('seller.user');
            Route::put('/users/update/seller', 'sellerUpdate')->name('seller.user.update');
            Route::put('/users/change-password/seller',  'sellerChangePassword')->name('seller.user.change_password');
        });

        Route::controller(SellerProductController::class)->group(function () {
            Route::get('/personnel/product/manage', 'index')->name('personnel.product.manage');
            Route::get('/personnel/product/{id}', 'showProduct')->name('personnel.product.show');
        });

        Route::controller(SellerOrderController::class)->group(function () {
            Route::get('/personnel/orders/history/', 'index')->name('Personnel.Order.History');
            Route::get('/personnel/orders/{orders_id}/detail', 'orderDetail')->name('Personnel.Order.Detail');
            Route::put('/personnel/orders/{order_id}/update', 'updateOrderStatus')->name('Personnel.Order.Update');
        });
    });
});

//Customer route
Route::middleware(['auth', 'verified', 'two_factor', 'rolemanager:customer'])->group(function () {

    Route::prefix('customer')->group(function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
            Route::get('/customer/about', 'about')->name('Customer.About');
            Route::get('/customer/contact', 'contact')->name('Customer.Contact');

            Route::get('/customer/product', 'showProduct')->name('Customer.Product');
            Route::post('/add-to-cart', [CustomerController::class, 'addToCart'])->name('cart.add');
        });

        Route::controller(CustomerPromotionController::class)->group(function () {
            Route::get('/customer/promotion', 'index')->name('Customer.Promotions');
        });

        Route::controller(CustomerCartController::class)->group(function () {
            Route::post('/customer/cart/add/{product}', 'addToCart')->name('Customer.Cart');
            Route::delete('/customer/cart/remove/{id}', 'remove')->name('Customer.Cart.Remove');
            Route::get('/customer/cart', 'index')->name('Customer.Cart.View');
            Route::put('/customer/cart/update/{id}', 'updateQuantity')->name('Customer.Cart.Update');
            Route::post('/apply-coupon', 'applyCoupon')->name('applyCoupon');
            Route::get('/customer/cart/update', 'updateCartCount')->name('Customer.cart.update');
            Route::get('/cart/count', 'getCartItemCount')->name('Customer.cart.count');
        });

        Route::controller(CheckoutController::class)->group(function () {
            Route::get('/customer/customer/checkout', 'index')->name('Customer.Checkout');
            Route::post('/customer/customer/checkout/store', 'store')->name('Customer.Checkout.store');
        });

        Route::controller(ConfirmationController::class)->group(function () {
            Route::get('/customer/customer/confirmation', 'index')->name('Customer.Confirmation');
        });

        Route::controller(ShopController::class)->group(function () {
            Route::get('/customer/shop', 'index')->name('Customer.Shop');
            Route::get('/customer/product/{product_slug}', 'product_details')->name('Customer.Details');

            Route::post('/shop/filter', [ShopController::class, 'filter'])->name('Customer.Filter');
            Route::get('/search-products', 'search')->name('Customer.products.search');
        });


        Route::controller(CustomerUserController::class)->group(function () {
            Route::get('/customer/account/detail', 'index')->name('Customer.Account.Detail');
            Route::put('/customer/update/account', 'update')->name('Customer.user.update');
            Route::put('/customer/change-password/account',  'changePassword')->name('Customer.user.change_password');
            Route::get('/customer/account/address/create', 'createAddress')->name('Customer.Account.Address.Create');
            Route::get('/customer/account/address', 'manageAddress')->name('Customer.Account.Address.Manage');
            Route::get('/customer/account/order/', 'order')->name('Customer.Account.Order');
            Route::get('/customer/account/order/{order}',  'orderDetail')->name('account.orders.details');
            Route::put('account/orders/confirm/{order}', 'confirm')->name('account.orders.confirm');
            Route::get('/customer/shop/comment/{order}', 'comment')->name('customer.shop.comment');
            Route::post('/customer/product/{id}/review', 'saveReview')->name('Customer.product.review');
            Route::get('/customer/product/{id}', 'show')->name('Customer.product.show');
            Route::put('/orders/{order}/cancel', 'cancel')->name('account.orders.cancel');
        });
    });
})->name('dashboard');


// Tìm kiếm cụ thể cho từng bảng
Route::post('/search/products', [ProductController::class, 'search'])->name('search.products');
Route::post('/seller/search/products', [SellerProductController::class, 'search'])->name('seller.search.products');
Route::post('/search/brands', [BrandController::class, 'search'])->name('search.brands');
Route::post('/search/categories', [CategoryController::class, 'search'])->name('search.categories');
Route::post('/search/order', [OrderMainController::class, 'search'])->name('search.orders');
Route::post('/seller/search/order', [SellerOrderController::class, 'search'])->name('seller.search.orders');
Route::post('/search/users', [UserController::class, 'search'])->name('search.users');
Route::post('/seller/search/users', [SellerController::class, 'search'])->name('seller.search.users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__ . '/auth.php';
