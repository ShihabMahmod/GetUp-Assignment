<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\auth\RegisterController;

Route::get('/',function(){
    return response()->json("Hello");
});
Route::post('/register',[RegisterController::class,'register']);
