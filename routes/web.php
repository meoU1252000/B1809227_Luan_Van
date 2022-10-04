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
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportDetailController;
use App\Http\Controllers\ProductFamilyController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\AuthController;
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
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/add', [ProductController::class, 'create'])->name('product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
            Route::post('/getAttribute/{id}', [ProductController::class, 'getAttribute'])->name('product.getAttribute');
            Route::prefix('/product-price')->group(function () {
                Route::get('/', [ProductController::class, 'indexPrice'])->name('price.index');
                Route::get('/add', [ProductController::class, 'addPrice'])->name('price.create');
                Route::post('/store', [ProductController::class, 'storePrice'])->name('price.store');
                Route::post('/getImport/{id}', [ProductController::class, 'getImport'])->name('price.getImport');
                Route::post('/getProduct/{id}', [ProductController::class, 'getProduct'])->name('price.getProduct');
                Route::post('/getImportProductPrice', [ProductController::class, 'getImportProductPrice'])->name('price.getImportProductPrice');
            });
        });

        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('brand.index');
            Route::get('/add', [BrandController::class, 'create'])->name('brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
            Route::post('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
        });

        Route::prefix('product-family')->group(function () {
            Route::get('/', [ProductFamilyController::class, 'index'])->name('family.index');
            Route::get('/add', [ProductFamilyController::class, 'create'])->name('family.create');
            Route::post('/store', [ProductFamilyController::class, 'store'])->name('family.store');
            Route::get('/edit/{id}', [ProductFamilyController::class, 'edit'])->name('family.edit');
            Route::post('/update/{id}', [ProductFamilyController::class, 'update'])->name('family.update');
            Route::post('/delete/{id}', [ProductFamilyController::class, 'destroy'])->name('family.delete');
        });

        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/add', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::get('/updateActive', [CategoryController::class, 'activeSwitch'])->name('category.activeSwitch');
        });

        Route::prefix('categoryAttribute')->group(function () {
            Route::get('/', [AttributeController::class, 'index'])->name('attribute.index');
            Route::get('/add', [AttributeController::class, 'create'])->name('attribute.create');
            Route::post('/store', [AttributeController::class, 'store'])->name('attribute.store');
            Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');
            Route::post('/update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
            Route::post('/delete/{id}', [AttributeController::class, 'destroy'])->name('attribute.delete');
        });

        Route::prefix('staff')->group(function () {
            Route::get('/', [StaffController::class, 'index'])->name('staff.index');
            Route::get('/add', [StaffController::class, 'create'])->name('staff.create');
            Route::post('/store', [StaffController::class, 'store'])->name('staff.store');
            Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
            Route::post('/update/{id}', [StaffController::class, 'update'])->name('staff.update');
            Route::post('/delete/{id}', [StaffController::class, 'destroy'])->name('staff.delete');
            Route::get('/account', [StaffController::class, 'account'])->name('staff.account');
        });

        Route::prefix('supplier')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
            Route::get('/add', [SupplierController::class, 'create'])->name('supplier.create');
            Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
            Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
            Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
            Route::post('/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');
        });

        Route::prefix('event')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('event.index');
            Route::get('/add', [EventController::class, 'create'])->name('event.create');
            Route::post('/store', [EventController::class, 'store'])->name('event.store');
            Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
            Route::post('/update/{id}', [EventController::class, 'update'])->name('event.update');
            Route::post('/delete/{id}', [EventController::class, 'destroy'])->name('event.delete');
        });

        Route::prefix('import')->group(function () {
            Route::get('/', [ImportController::class, 'index'])->name('import.index');
            Route::get('/add', [ImportController::class, 'create'])->name('import.create');
            Route::post('/store', [ImportController::class, 'store'])->name('import.store');
            Route::get('/edit/{id}', [ImportController::class, 'edit'])->name('import.edit');
            Route::post('/update/{id}', [ImportController::class, 'update'])->name('import.update');
            Route::post('/delete/{id}', [ImportController::class, 'destroy'])->name('import.delete');
            Route::prefix('{id}/details')->group(function () {
                Route::get('/', [ImportDetailController::class, 'index'])->name('import.details.index');
                Route::get('/add/}', [ImportDetailController::class, 'create'])->name('import.details.create');
                Route::post('/store', [ImportDetailController::class, 'store'])->name('import.details.store');
            });
        });
    });
});
//Client
Route::prefix('/thanh-dat-store')->group(function () {
    Route::get('/', [ProductController::class, 'indexClient'])->name('client.index');
    Route::get('/{slug}/{id}', [ProductController::class, 'get_detail_product'])->name('client.detail');

    //Giỏ hàng
    Route::prefix('/cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{id}', [CartController::class, 'store'])->name('cart.store')->middleware('check.quantity');
        Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/edit', [CartController::class, 'edit_cart'])->name('cart.edit')->middleware('check.quantity');
    });
});
