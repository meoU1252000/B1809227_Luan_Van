<?php

use App\Http\Controllers\ClientPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/client')->group(function () {
    Route::get('/get-list-product',[ClientPageController::class,'getListProducts'])->name('client.getListProducts');
    Route::get('/get-list-category',[ClientPageController::class,'getListCategories'])->name('client.getListCategories');
    Route::get('/get-list-brand',[ClientPageController::class,'getListBrands'])->name('client.getListBrands');
    Route::get('/get-list-event',[ClientPageController::class,'getListEvents'])->name('client.getListEvents');
    Route::get('/get-category/{name}',[ClientPageController::class,'getCategory'])->name('client.getCategory');
    Route::get('/get-product/{id}',[ClientPageController::class,'getProduct'])->name('client.getProduct');
    Route::post('/register',[ClientPageController::class,'register'])->name('client.register');
    Route::post('/login',[ClientPageController::class,'login'])->name('client.login');
    Route::get('/get-list-city',[ClientPageController::class,'getListCity'])->name('client.getListCity');
    Route::get('/search',[ClientPageController::class,'searchProducts'])->name('client.search');
    Route::middleware(['api'])->group(function () {
        Route::post('/logout',[ClientPageController::class,'logout'])->name('client.logout');
        Route::post('/address',[ClientPageController::class,'getCustomerAddress'])->name('client.address');
        Route::post('/createAddress',[ClientPageController::class,'createCustomerAddress'])->name('client.createCustomerAddress');
        Route::post('/updateAddress',[ClientPageController::class,'updateCustomerAddress'])->name('client.updateCustomerAddress');
        Route::post('/deleteAddress',[ClientPageController::class,'deleteCustomerAddress'])->name('client.deleteCustomerAddress');
        Route::post('/createOrder',[ClientPageController::class,'createOrder'])->name('client.createOrder');
        Route::post('/get-list-order',[ClientPageController::class,'getOrders'])->name('client.getOrders');
        Route::post('/cancel-order',[ClientPageController::class,'cancelOrder'])->name('client.cancelOrder');
        Route::post('/rating',[ClientPageController::class,'ratingProduct'])->name('client.rating');
        Route::post('/comment',[ClientPageController::class,'commentProduct'])->name('client.comment');
        Route::post('/deleteComment',[ClientPageController::class,'deleteComment'])->name('client.deleteComment');
        Route::post('/sendEmail',[ClientPageController::class,'sendEmail'])->name('client.sendEmail');
        Route::post('/changeInfo',[ClientPageController::class,'changeInfo'])->name('client.changeInfo');
        Route::post('/createNewToken',[ClientPageController::class,'createNewToken'])->name('client.createNewToken');
        Route::post('/changePassword',[ClientPageController::class,'changePassword'])->name('client.changePassword');
    });
});
