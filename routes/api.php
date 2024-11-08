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

Route::resource('product',ProductController::class);


Route::get('best/selling/product',[OrderController::class,'bestSellingProduct']);
Route::get('recent/order',[OrderController::class,'recentOrder']);
