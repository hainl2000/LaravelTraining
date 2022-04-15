<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/products/show.css')}}">
</head>

<body>
<div id="add-product-button">
    <a href="">Back to main</a>
</div>
<div class = "show-container-1">
    <table class="show-product-container">
        <tr>
            <th class = "product-width">Num</th>
            <th class = "product-width">Product</th>
            <th class = "product-width">Quantity</th>
            <th class = "product-width">Price</th>
        </tr>
        @php($i =1)
        @foreach($listOrders->products as $order)
        <tr>
            <td class="product-td">{{$i++}}</td>
            <td class="product-td"><a href="/{{$order->product_id}}">{{$order->product_name}}</a></td>
            <td class="product-td">{{$order->quantity}}</td>
            <td class="product-td">{{$order->sum}}</td>
            <td class="product-td"><a href="">More details</a></td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
