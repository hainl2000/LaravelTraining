<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
{{--    <link href="{{ asset('css/products/show.css') }}" rel="stylesheet">--}}
</head>

<body>
@if(count($errors) >0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-danger"> {{ $error }}</li>
        @endforeach
    </ul>
@endif

<div class="add-product-container">
    <form id="add-product-form" action = "{{route('product.addNew')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h1>Name: </h1>
        <input class="input-add-form" type="text" name="productName" placeholder="Enter name"><br>
        <h1>Image: </h1>
        <input class="input-add-form" type="file" name="productImage"><br>
        <h1>Price: </h1>
        <input class="input-add-form" type="text" name="productPrice" placeholder="Enter price"><br>
        <h1>Description: </h1>
        <input class="input-add-form" type="text" name="productDescription" placeholder="Enter description"><br>
        <input id="submit-add-product-button" type="submit" name="add-product" value="Add Product">
    </form>
</div>
</body>
</html>
