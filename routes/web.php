<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [ProductController::class,'indexWithPaginate'])->name('product.show');

Route::get('/login', function (){
    return view('auth');
});
Route::post('/auth', [AuthController::class,'auth'])->name('auth');

Route::get('{productID}',[ProductController::class,'show']);

//Route::middleware('check.login')->prefix('product')->group(function(){
//
//    Route::get('/create',[ProductController::class,'create']);
//    Route::post('/addOneProduct',[ProductController::class,'store'])->name('product.addNew');
//
//    Route::delete('/delete/{productID}',[ProductController::class,'destroy']);
//
//    Route::get('/edit/{productID}',[ProductController::class,'edit']);
//    Route::put('/edit/{productID}',[ProductController::class,'update'])->name('product.updateOne');
//});

Route::middleware('check.login')->group(function(){
    Route::prefix('product')->group(function(){
        Route::get('/create',[ProductController::class,'create']);
        Route::post('/addOneProduct',[ProductController::class,'store'])->name('product.addNew');

        Route::delete('/delete/{productID}',[ProductController::class,'destroy']);

        Route::get('/edit/{productID}',[ProductController::class,'edit']);
        Route::put('/edit/{productID}',[ProductController::class,'update'])->name('product.updateOne');
    });
    Route::prefix('user')->group(function(){
        Route::post('/buy/{productID}',[UserController::class,'buyOneProduct'])->name('user.buyProduct');

        Route::get('/order',[OrderController::class,'getListOrdersByUser']);
    });
});








