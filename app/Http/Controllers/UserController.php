<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ProductController;

class UserController extends Controller
{
    //
    public function buyOneProduct(Request $request, $productID)
    {
        $product = (new ProductController())->getOneProduct($productID);
        $buyerID = $request->get('id');
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
                    $orderController = new OrderController();
                    $orderController->store($buyerID,$productID);
                });
                return redirect('/')->with('status','Bought product successfully');
            }catch (\Exception $exception) {
                return redirect()->back()->with('status','Not available 2');
            }
        }

    }
}
