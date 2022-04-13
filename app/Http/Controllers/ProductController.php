<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Product;

class ProductController extends Controller
{
    public function indexWithPaginate()
    {
        $listProducts = Product::paginate(4);
        return view('products.show', ['listProducts' => $listProducts]);
    }

    public function create()
    {
        return view('products.add');
    }

    public function store(AddFormRequest $request)
    {
        $productName = $request->input('productName');
        $productPrice = $request->input('productPrice');
        $productImageName = time() . '.' . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->move(public_path('images'), $productImageName);
        $productDescription = $request->input('productDescription');
        $productQuantity = $request->input('productQuantity');

        $newProduct = new Product();
        $newProduct->product_name = $productName;
        $newProduct->product_price = $productPrice;
        $newProduct->product_image = 'images/' . $productImageName;
        $newProduct->product_description = $productDescription;
        $newProduct->product_quantity = $productQuantity;

        $newProduct->save();

        return redirect('/')->with('status', 'Added new product succesfully');
    }

//    public function getAllProducts()
//    {
//        $listProducts = Product::all();
//        return view('products.show', ['listProducts' => $listProducts]);
//    }

    public function getOneProduct($productID)
    {
        $product = Product::where('product_id', '=', $productID)->first();
        return $product;
    }

    public function edit($productID)
    {
        $product = $this->getOneProduct($productID);
        return view('products.edit', ['product' => $product]);
    }

    public function show($productID)
    {
        $product = $this->getOneProduct($productID);
        return view('products.detail',['product' => $product]);
    }


    public function update(AddFormRequest $request,$productID){
        $product = $this->getOneProduct($productID);
        //if change image, delete old product's image
        if($request->file('productImage'))
        {
            File::delete($product->product_image);
            $productImageName = time() . '.' . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->move(public_path('images'), $productImageName);
            $product->product_image = 'images/' . $productImageName;
        }

        //get new update product's information
        $productName = $request->input('productName');
        $productPrice = $request->input('productPrice');
        $productDescription = $request->input('productDescription');
        $productQuantity = $request->input('productQuantity');

        //update new information
        $product->product_name = $productName;
        $product->product_price = $productPrice;
        $product->product_description = $productDescription;
        $product->product_quantity = $productQuantity;

        $product->save();
        return redirect('/')->with('status','Updated product successfully');
    }

    public function destroy($productID)
    {
        $product = Product::where('product_id', '=', $productID)->first();
        File::delete($product->product_image);
        $product->delete();
        return redirect('/')->with('status', 'Deleted product successfully');
    }


    public function minusQuantity($productID)
    {
        $product = $this->getOneProduct($productID);
        $product->product_quantity = $product->product_quantity -1;
        $product->save();
    }

    public function getProduct($userID)
    {

    }
}
