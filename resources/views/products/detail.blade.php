<html lang="en">

<head>
    <title>Detail Page</title>
    <link href="{{ asset('css/products/detail.css') }}" rel="stylesheet">
</head>

<script>
    var msg = '{{Session::get('status')}}';
    var isExisted = '{{Session::has('status')}}';
    if (isExisted){
        alert(msg);
    }
</script>

<body>
<div id="add-product-button">
    <a href="/">Back to main</a>
</div>
<div class="wrapper">
    <div class="product-img">
        <img src="{{asset($product->product_image)}}" height="420" width="327">
    </div>
    <div class="product-info">
        <div class="product-text">
            <h1>{{$product->product_name}}</h1>
            <h2>by studio and friends</h2>
            <p>{{$product->product_description}} </p>
        </div>

        <div class="product-price-btn">
{{--            <p><span>available: {{$product->product_quantity}}</span>--}}
            <p><span>{{$product->product_price}}</span>$</p>
            <form action="/user/buy/{{$product->product_id}}" method="post">
                @csrf
                <button type="submit">buy now</button>
            </form>
        </div>
    </div>
</div>

</body>

</html>
