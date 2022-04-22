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
//    public function store($userID,$productID)
//    {
//        $newOrder = new Order();
//        $newOrder->user_id = $userID;
//        $newOrder->product_id = $productID;
//        $newOrder->save();
//        return;
//    }

    public function getListOrdersByUser(Request $request)
    {
//        $userID = $request->get('id');
        $userID = \Auth::id();
        $listOrders = User::with(['products'=>function ($query) use ($userID){
            $query->where('user_id','=',$userID)->select('products.product_id','products.product_name')->distinct();
        }])->get();
        foreach($listOrders[0]->products as $product)
        {
            $totalQuantityEachProduct = User::withCount(['products'=>function($query) use ($userID,$product){
                $query->where([
                    ['user_id','=',$userID],
                    ['orders.product_id','=',$product->product_id],
                ]);
            }])->get();
            $product['quantity'] = $totalQuantityEachProduct[0]->products_count;


            $totalPriceEachProduct = $product->users()->where('orders.user_id','=',$userID)->sum('orders.price');
            $product['sum'] = $totalPriceEachProduct;
//            echo $product;
//            die();
        }
        return view('users.show-orders',['listOrders'=>$listOrders[0]]);
    }

    public function getDetailsOfOrder(Request $request, $productID)
    {
//        $userID = $request->get('id');
        $userID = \Auth::id();
        $product= Product::find($productID);
        $data = $product->users()->where('orders.user_id','=',$userID)->get();
        return view('users.details-order',['datas'=>$data,'product'=>$product]);
    }
}
