<?php

use App\Http\Controllers\AttributeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventDetailsController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportDetailController;
use App\Http\Controllers\ProductFamilyController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/admin/login/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/login/store', [AuthController::class, 'login'])->name('login.check');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [HomeController::class, 'adminPage'])->name('admin.index');
        Route::get('/account', [StaffController::class, 'account'])->name('admin.account');
        Route::post('/account/store', [StaffController::class, 'updateAccount'])->name('admin.account.update');
        Route::post('/filter', [HomeController::class, 'dashboard_filter'])->name('admin.dashboard_filter');
        Route::post('/product-filter', [HomeController::class, 'product_filter'])->name('admin.product_filter');
        Route::post('/product-statistical',[HomeController::class, 'product_statistical'])->name('admin.product_statistical');
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
            Route::get('/add', [ProductController::class, 'create'])->name('product.create')->middleware('role_or_permission:Super Admin|Add Product');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store')->middleware('role_or_permission:Super Admin|Add Product');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('role_or_permission:Super Admin|Edit Product');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('role_or_permission:Super Admin|Edit Product');
            Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete')->middleware('role_or_permission:Super Admin|Delete Product');
            Route::post('/getAttribute/{id}', [ProductController::class, 'getAttribute'])->name('product.getAttribute')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
            Route::get('/updateActive', [ProductController::class, 'activeSwitch'])->name('product.activeSwitch')->middleware('role_or_permission:Super Admin|Manage Category|Delete Category');
            Route::prefix('/product-price')->group(function () {
                Route::get('/', [ProductController::class, 'indexPrice'])->name('price.index')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
                Route::get('/add', [ProductController::class, 'addPrice'])->name('price.create')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
                Route::post('/store', [ProductController::class, 'storePrice'])->name('price.store')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
                Route::post('/getImport/{id}', [ProductController::class, 'getImport'])->name('price.getImport')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
                Route::post('/getProduct/{id}', [ProductController::class, 'getProduct'])->name('price.getProduct')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
                Route::post('/getImportProductPrice', [ProductController::class, 'getImportProductPrice'])->name('price.getImportProductPrice')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
            });
            Route::prefix('/{id}/image')->group(function () {
                Route::get('/', [ImageController::class, 'index'])->name('image.index')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
                Route::get('/add', [ImageController::class, 'create'])->name('image.create')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
                Route::post('/store', [ImageController::class, 'store'])->name('image.store')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
                Route::get('/edit/{image}', [ImageController::class, 'edit'])->name('image.edit')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
                Route::post('/update/{image}', [ImageController::class, 'update'])->name('image.update')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
                Route::post('/delete/{image}', [ImageController::class, 'destroy'])->name('image.delete')->middleware('role_or_permission:Super Admin|Add Product|Edit Product|Delete Product');
            });
        });

        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('brand.index')->middleware('role_or_permission:Super Admin|Manage Brand|Add Brand|Edit Brand|Delete Brand');
            Route::get('/add', [BrandController::class, 'create'])->name('brand.create')->middleware('role_or_permission:Super Admin|Manage Brand|Add Brand');
            Route::post('/store', [BrandController::class, 'store'])->name('brand.store')->middleware('role_or_permission:Super Admin|Manage Brand|Add Brand');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit')->middleware('role_or_permission:Super Admin|Manage Brand|Edit Brand|Delete Brand');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('brand.update')->middleware('role_or_permission:Super Admin|Manage Brand|Edit Brand|Delete Brand');
            Route::post('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete')->middleware('role_or_permission:Super Admin|Manage Brand|Delete Brand');
        });

        Route::prefix('comment')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('comment.index')->middleware('role_or_permission:Super Admin|Manage Comment');
            Route::post('/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete')->middleware('role_or_permission:Super Admin|Manage Comment');
        });

        Route::prefix('product-family')->group(function () {
            Route::get('/', [ProductFamilyController::class, 'index'])->name('family.index')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
            Route::get('/add', [ProductFamilyController::class, 'create'])->name('family.create')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
            Route::post('/store', [ProductFamilyController::class, 'store'])->name('family.store')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
            Route::get('/edit/{id}', [ProductFamilyController::class, 'edit'])->name('family.edit')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
            Route::post('/update/{id}', [ProductFamilyController::class, 'update'])->name('family.update')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
            Route::post('/delete/{id}', [ProductFamilyController::class, 'destroy'])->name('family.delete')->middleware('role_or_permission:Super Admin|Manage Product|Add Product|Edit Product|Delete Product');
        });

        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
            Route::get('/add', [CategoryController::class, 'create'])->name('category.create')->middleware('role_or_permission:Super Admin|Manage Category|Add Category');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store')->middleware('role_or_permission:Super Admin|Manage Category|Add Category');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('role_or_permission:Super Admin|Manage Category|Edit Category|Delete Category');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('role_or_permission:Super Admin|Manage Category|Edit Category|Delete Category');
            Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete')->middleware('role_or_permission:Super Admin|Manage Category|Delete Category');
            Route::get('/updateActive', [CategoryController::class, 'activeSwitch'])->name('category.activeSwitch')->middleware('role_or_permission:Super Admin|Manage Category|Delete Category');
        });

        Route::prefix('categoryAttribute')->group(function () {
            Route::get('/', [AttributeController::class, 'index'])->name('attribute.index')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
            Route::get('/add', [AttributeController::class, 'create'])->name('attribute.create')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
            Route::post('/store', [AttributeController::class, 'store'])->name('attribute.store')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
            Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
            Route::post('/update/{id}', [AttributeController::class, 'update'])->name('attribute.update')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
            Route::post('/delete/{id}', [AttributeController::class, 'destroy'])->name('attribute.delete')->middleware('role_or_permission:Super Admin|Manage Category|Add Category|Edit Category|Delete Category');
        });

        Route::prefix('staff')->group(function () {
            Route::get('/', [StaffController::class, 'index'])->name('staff.index')->middleware('role_or_permission:Super Admin');
            Route::get('/add', [StaffController::class, 'create'])->name('staff.create')->middleware('role_or_permission:Super Admin');
            Route::post('/store', [StaffController::class, 'store'])->name('staff.store')->middleware('role_or_permission:Super Admin');
            Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit')->middleware('role_or_permission:Super Admin');
            Route::post('/update/{id}', [StaffController::class, 'update'])->name('staff.update')->middleware('role_or_permission:Super Admin');
            Route::post('/delete/{id}', [StaffController::class, 'destroy'])->name('staff.delete')->middleware('role_or_permission:Super Admin');
            Route::get('/account', [StaffController::class, 'account'])->name('staff.account')->middleware('role_or_permission:Super Admin');
        });

        Route::prefix('supplier')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('supplier.index')->middleware('role_or_permission:Super Admin|Manage Supplier');
            Route::get('/add', [SupplierController::class, 'create'])->name('supplier.create')->middleware('role_or_permission:Super Admin|Manage Supplier');
            Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store')->middleware('role_or_permission:Super Admin|Manage Supplier');
            Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit')->middleware('role_or_permission:Super Admin|Manage Supplier');
            Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update')->middleware('role_or_permission:Super Admin|Manage Supplier');
            Route::post('/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete')->middleware('role_or_permission:Super Admin|Manage Supplier');
        });

        Route::prefix('event')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('event.index')->middleware('role_or_permission:Super Admin|Manage Event|Add Event|Edit Event|Delete Event');
            Route::get('/add', [EventController::class, 'create'])->name('event.create')->middleware('role_or_permission:Super Admin|Manage Event|Add Event');
            Route::post('/store', [EventController::class, 'store'])->name('event.store')->middleware('role_or_permission:Super Admin|Manage Event|Add Event');
            Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit')->middleware('role_or_permission:Super Admin|Manage Event|Edit Event|Delete Event');
            Route::post('/update/{id}', [EventController::class, 'update'])->name('event.update')->middleware('role_or_permission:Super Admin|Manage Event|Edit Event|Delete Event');
            Route::post('/delete/{id}', [EventController::class, 'destroy'])->name('event.delete')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
            Route::prefix('{id}/details')->group(function () {
                Route::get('/', [EventDetailsController::class, 'index'])->name('event.details.index')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
                Route::get('/add', [EventDetailsController::class, 'create'])->name('event.details.create')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
                Route::post('/store', [EventDetailsController::class, 'store'])->name('event.details.store')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
                Route::get('/edit/{event}', [EventDetailsController::class, 'edit'])->name('event.details.edit')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
                Route::post('/update/{event}', [EventDetailsController::class, 'update'])->name('event.details.update')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
                Route::post('/delete/{event}', [EventDetailsController::class, 'destroy'])->name('event.details.delete')->middleware('role_or_permission:Super Admin|Manage Event|Delete Event');
            });
        });

        Route::prefix('import')->group(function () {
            Route::get('/', [ImportController::class, 'index'])->name('import.index')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            Route::get('/add', [ImportController::class, 'create'])->name('import.create')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            Route::post('/store', [ImportController::class, 'store'])->name('import.store')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            Route::get('/edit/{id}', [ImportController::class, 'edit'])->name('import.edit')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            Route::post('/update/{id}', [ImportController::class, 'update'])->name('import.update')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            Route::post('/delete/{id}', [ImportController::class, 'destroy'])->name('import.delete')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            Route::prefix('{id}/details')->group(function () {
                Route::get('/', [ImportDetailController::class, 'index'])->name('import.details.index')->middleware('role_or_permission:Super Admin|Manage Import Goods');
                Route::get('/add', [ImportDetailController::class, 'create'])->name('import.details.create')->middleware('role_or_permission:Super Admin|Manage Import Goods');
                Route::post('/store', [ImportDetailController::class, 'store'])->name('import.details.store')->middleware('role_or_permission:Super Admin|Manage Import Goods');
            });
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('order.index')->middleware('role_or_permission:Super Admin|Manage Order');
            Route::get('/add', [OrderController::class, 'create'])->name('order.create')->middleware('role_or_permission:Super Admin|Manage Order');
            Route::post('/store', [OrderController::class, 'store'])->name('order.store')->middleware('role_or_permission:Super Admin|Manage Order');
            Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit')->middleware('role_or_permission:Super Admin|Manage Order');
            Route::post('/update/{id}', [OrderController::class, 'update'])->name('order.update')->middleware('role_or_permission:Super Admin|Manage Order');
            Route::post('/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete')->middleware('role_or_permission:Super Admin|Manage Order');
        });

        Route::prefix('role')->group(function () {
            Route::get('/add', [RoleController::class, 'create'])->name('role.create')->middleware('role_or_permission:Super Admin');
            Route::get('/', [RoleController::class, 'index'])->name('role.index')->middleware('role_or_permission:Super Admin');
            Route::post('/', [RoleController::class, 'store'])->name('role.store')->middleware('role_or_permission:Super Admin');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('role_or_permission:Super Admin');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('role_or_permission:Super Admin');
            Route::post('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete')->middleware('role_or_permission:Super Admin');
            Route::get('/assign-permission/{id}', [RoleController::class, 'viewAssignPermision'])->name('role.view.assign.permission')->middleware('role_or_permission:Super Admin');
            Route::post('/assign-permission/{id}', [RoleController::class, 'assignPermissions'])->name('role.assign.permission')->middleware('role_or_permission:Super Admin');
            Route::get('/assign-user/{id}', [RoleController::class, 'viewAssignUser'])->name('role.view.assign.user')->middleware('role_or_permission:Super Admin');
            Route::post('/assign-user/{id}', [RoleController::class, 'assignUser'])->name('role.assign.user')->middleware('role_or_permission:Super Admin');
        });

        Route::prefix('permission')->group(function () {
            Route::get('/add', [PermissionController::class, 'create'])->name('permission.create')->middleware('role_or_permission:Super Admin');
            Route::get('/', [PermissionController::class, 'index'])->name('permission.index')->middleware('role_or_permission:Super Admin');
            Route::post('/', [PermissionController::class, 'store'])->name('permission.store')->middleware('role_or_permission:Super Admin');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('role_or_permission:Super Admin');
            Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permission.update')->middleware('role_or_permission:Super Admin');
            Route::post('/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete')->middleware('role_or_permission:Super Admin');
        });
    });
});
//Client
// Route::prefix('/thanh-dat-store')->group(function () {
//     Route::get('/', [ProductController::class, 'indexClient'])->name('client.index');
//     Route::get('/{slug}/{id}', [ProductController::class, 'get_detail_product'])->name('client.detail');

//     //Giỏ hàng
//     Route::prefix('/cart')->group(function () {
//         Route::get('/', [CartController::class, 'index'])->name('cart.index');
//         Route::post('/add/{id}', [CartController::class, 'store'])->name('cart.store')->middleware('check.quantity');
//         Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
//         Route::post('/edit', [CartController::class, 'edit_cart'])->name('cart.edit')->middleware('check.quantity');
//     });
// });
