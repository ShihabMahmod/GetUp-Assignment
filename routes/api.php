<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\OrderController;

Route::get('/',function(){
    return response()->json("Hello");
});
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {

    

        Route::get('/product', [ProductController::class, 'index']);
        Route::post('/product', [ProductController::class, 'store']);
        Route::get('/product/{id}', [ProductController::class, 'edit']);
        Route::put('/product/{id}', [ProductController::class, 'update']);
        Route::delete('/product/{id}', [ProductController::class, 'destroy']);

        Route::post('order', [OrderController::class, 'order']);
        Route::get('best/selling/product', [OrderController::class, 'bestSellingProduct']);
        Route::get('recent/order', [OrderController::class, 'recentOrder']);
        Route::get('orders/group/category/name', [OrderController::class, 'ordersGroupByCategoryName']);
});



