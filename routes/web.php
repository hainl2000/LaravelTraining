<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
})->name('login');
Route::post('/auth', [AuthController::class,'auth'])->name('auth');

Route::get('{productID}',[ProductController::class,'show']);
//---------------
Route::get('/email/verify', function () {
    return redirect('/page/welcome');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//---------------------
Route::middleware('verified')->group(function(){

    Route::prefix('product')->group(function(){
        Route::get('/create',[ProductController::class,'create']);
        Route::post('/addOneProduct',[ProductController::class,'store'])->name('product.addNew');

        Route::delete('/delete/{productID}',[ProductController::class,'destroy']);

        Route::get('/edit/{productID}',[ProductController::class,'edit']);
        Route::put('/edit/{productID}',[ProductController::class,'update'])->name('product.updateOne');
    });

    Route::prefix('user')->group(function(){
        Route::post('/buy/{productID}',[UserController::class,'buyOneProduct'])->name('user.buyProduct');
        Route::prefix('/order')->group(function(){
            Route::get('/',[OrderController::class,'getListOrdersByUser']);

            Route::get('/detail/{productID}',[OrderController::class,'getDetailsOfOrder']);
        });

    });
});


Route::get('/page/welcome',function (){
    return view('/welcome');
});










