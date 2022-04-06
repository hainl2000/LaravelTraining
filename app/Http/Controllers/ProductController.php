<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Product;

class ProductController extends Controller
{

    public function addOneProduct(AddFormRequest $request)
    {
        $productName = $request->input('productName');
        $productPrice = $request->input('productPrice');
        $productImageName = time() . '.' . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->move(public_path('images'), $productImageName);
        $productDescription = $request->input('productDescription');

        $newProduct = new Product();
        $newProduct->product_name = $productName;
        $newProduct->product_price = $productPrice;
        $newProduct->product_image = 'images/' . $productImageName;
        $newProduct->product_description = $productDescription;

        $newProduct->save();

        return redirect('/')->with('status', 'Add new product succesfully');
    }

    public function getAllProducts()
    {
        $listProducts = Product::all();
        return view('products.show', ['listProducts' => $listProducts]);
    }

    public function getOneProduct($productID)
    {
        $product = Product::where('product_id', '=', $productID)->first();
        return view('products.edit', ['product' => $product]);
    }

    public function deleteOneProduct($productID)
    {
        $product = Product::where('product_id', '=', $productID)->first();
        File::delete($product->product_image);
        $product->delete();
        return redirect('/')->with('status', 'Delete product successfully');
    }
}
