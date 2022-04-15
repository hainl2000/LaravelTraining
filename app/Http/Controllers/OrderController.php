<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use function Sodium\add;

use App\Models\User;
use App\Models\Product;

class OrderController extends Controller
{
    //
    public function store($userID,$productID)
    {
        $newOrder = new Order();
        $newOrder->user_id = $userID;
        $newOrder->product_id = $productID;
        $newOrder->save();
        return;
    }

    public function getListOrdersByUser(Request $request)
    {
        $userID = $request->get('id');
        $listOrders = User::with(['products'=>function ($query) use ($userID){
            $query->where('user_id','=',$userID)->select('products.product_id','products.product_name')->distinct();
        }])->get();
//        echo $listProducts[0];
        foreach($listOrders[0]->products as $product)
        {
            $product['quantity'] = 2;
            $product['sum'] = 1000;
//            $count = User::withCount(['products'=>function($query) use ($userID,$product){
//                $query->where([
//                    ['user_id','=',$userID],
//                    ['product_id','=',$product->product_id],
//                ]);
//            }])->get();
        }
//        echo count($listProducts[0]->products);
//        print_r($listProducts[0]->products);
//        die();
//        echo $listOrders[0];
//        die();
        return view('users.show-orders',['listOrders'=>$listOrders[0]]);
    }
}
