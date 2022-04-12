<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <link href="{{ asset('css/products/show.css') }}" rel="stylesheet">
</head>

<script>
    var msg = '{{Session::get('status')}}';
    var isExisted = '{{Session::has('status')}}';
    if (isExisted){
        alert(msg);
    }
</script>
<body>
<div class = "show-container-1">
    <div id="add-product-button">
        <a href="/product/create">Add Product</a>
    </div>
    <table class="show-product-container">
        <tr>
            <th class = "product-width">Name</th>
            <th class = "product-width">Image</th>
            <th class = "product-width">Price</th>
            <th class = "product-width">Quantity</th>
            <th class = "product-width">Description</th>
            <th class = "product-width">Edit</th>
            <th class = "product-width">Delete</th>
            <th class="product-width">Detail</th>
        </tr>
        @foreach($listProducts as $product)
            <tr>
                <td class="product-td">{{$product->product_name}}</td>
                <td class="product-td"><img class="product-image" src="{{asset($product->product_image)}}"></td>
                <td class="product-td">{{$product->product_price}}</td>
                <td class="product-td">{{$product->product_quantity}}</td>
                <td class="product-td">{{$product->product_description}}</td>
                <td class="product-td"><a href="/product/edit/{{$product->product_id}}">Edit</a>
                <td class="product-td">
                    <form class="product-td" action="/product/delete/{{$product->product_id}}" method="post">
                    @csrf
                    @method('delete')
                        <input class="product-td" type="submit" value="Delete"/>
                    </form>
                </td>
                <td class="product-td"><a href="/{{$product->product_id}}">Detail</a>
            </tr>
        @endforeach
    </table>
    @for($i=0;$i<$listProducts->lastPage();$i++)
        <span>
            <a href="/?page={{$i+1}}">{{$i+1}}</a>
        </span>
    @endfor
</div>

</body>
</html>

