<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
        <link href="{{ asset('css/products/show.css') }}" rel="stylesheet">
</head>

<body>
<div class = "show-container-1">
    <div id="add-product-button">
        <a href="/product/add">Add Product</a>
    </div>
    <table class="show-product-container">
        <tr>
            <th class = "product-width">Name</th>
            <th class = "product-width">Image</th>
            <th class = "product-width">Price</th>
            <th class = "product-width">Description</th>
            <th class = "product-width">Edit</th>
            <th class = "product-width">Delete</th>
        </tr>
        @foreach($listProducts as $product)
            <tr>
                <td class="product-td">{{$product->product_name}}</td>
                <td class="product-td"><img class="product-image" src="{{$product->product_image}}"></img></td>
                <td class="product-td">{{$product->product_price}}</td>
                <td class="product-td">{{$product->product_description}}</td>
                <td class="product-td"><a href="/product/edit/{{$product->product_id}}">Edit</a>
                <td class="product-td"><a href="">Delete</a>
            </tr>
        @endforeach
    </table>
</div>

</body>
</html>

