<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function getAllProducts(){
        $listProducts = Product::all();
        return view('products.show',['listProducts' => $listProducts]);
    }

    public function getOneProduct($productID){
        $product = Product::where('product_id','=',$productID)->first();
        return view('products.edit',['product' => $product]);
    }
}
