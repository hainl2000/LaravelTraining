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
//        $listDataInOrderPage = array();
        $listProducts = User::with(['products'=>function ($query) use ($userID){
            $query->where('user_id','=',$userID)->select('products.product_id','products.product_name')->distinct();
        }])->get();
        $array1 = array('item1' => 'item1', 'item2' => 'item2');
        $array2 = array('item1' => 'item5', 'item2' => 'item6');
        $array3 = array_merge($array1, $array2);
        print_r($array3);
//        $tempArray1 = array('product'=>'11');
//        $tempArray2 = array('product'=>'22');
//        $tempArray3 = array('product'=>'33');
//        $listDataInOrderPage = array_merge($tempArray1,$tempArray2,$tempArray3);
//        foreach($listProducts[0]->products as $product)
//        {
//            $tempArray = array('product'=>$product);
////            print_r($tempArray);
//            echo($tempArray['product']);
////            $tempArray->setAttribute('product', $product);
////            die($tempArray);
////            array_push($listDataInOrderPage,'product'=>$product]);
//        }
//        print_r($listDataInOrderPage[$tempArray1]);
        die();
//        die($listDataInOrderPage);
//        return view('users.show-orders',['userName'=>$userName,'data'=>$listDataInOrderPage]);
    }
}
