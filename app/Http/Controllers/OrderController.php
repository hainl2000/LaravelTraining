<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
}
