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
    Route::get('/get-category/{name}',[ClientPageController::class,'getCategory'])->name('client.getCategory');
    Route::get('/get-product/{id}',[ClientPageController::class,'getProduct'])->name('client.getProduct');
});