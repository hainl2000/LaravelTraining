<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;

class UserController extends Controller
{
    //
    public function getInformation($userID)
    {
        $user = User::where('id','=',$userID)->first();
        return $user;
    }
    public function buyOneProduct(Request $request, $productID)
    {
        $product = (new ProductController())->getOneProduct($productID);
//        $buyerID = $request->get('id');
        $buyerID = Auth::id();
        if ($product->product_quantity < 1)
        {
            return redirect()->back()->with('status','Not available');
        }
        else{
            try{
                DB::transaction(function () use ($buyerID, $productID){
                    //minus quantity
                    $productController = new ProductController();
                    $productController->minusQuantity($productID);
                    //create new order

                    $product = Product::find($productID);
                    $product->users()->attach($buyerID,['price'=>$product->product_price]);

                    $message = [
                        'type' => 'Ordered Successfully',
                        'product' => $product->product_name,
                        'price' => $product->product_price
                    ];
                    $user = Auth::user();
//                    die($user->username);
                    SendEmail::dispatch($message,$user->username);
//                    $orderController = new OrderController();
//                    $orderController->store($buyerID,$productID);
                });
                return redirect('/')->with('status','Bought product successfully');
            }catch (\Exception $exception) {
                die($exception);
                return redirect()->back()->with('status','Not available 2');
            }
        }

    }
}
