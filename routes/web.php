<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class,'getAllProducts'])->name('product.show');

Route::get('/login', function (){
    return view('auth');
});
Route::post('/auth', [AuthController::class,'auth'])->name('auth');

Route::middleware('check.login')->prefix('product')->group(function(){
    Route::get('/add',function(){
        return view('products.add');
    });
    Route::post('/addOneProduct',[ProductController::class,'addOneProduct'])->name('product.addNew');
    Route::delete('/delete/{productID}',[ProductController::class,'deleteOneProduct']);
    Route::get('/edit/{productID}',[ProductController::class,'getOneProduct']);
});


