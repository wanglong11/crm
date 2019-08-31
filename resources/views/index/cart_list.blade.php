<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div class="layui-form">
    <h1>购物车商品展示</h1>
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>购买数量</th>
            <th>商品-price</th>
        </tr>
        </thead>
        @foreach($data as $k=>$v)
            <tbody>
            <tr>
                <td>{{$v['name']}}</td>
                <td><img src="/crm/public/{{$v['image']}}"  height="100" width="100" ></td>
                <br>
                <td>{{$v['buy_number']}}</td>
                <td>{{$v['price']}}</td>
            </tr>
            </tbody>
        @endforeach
        <div class="col s5">
            <h6 id="totalPrice">总价钱${{$totalPrice}}</h6>
        </div>
    </table>
    <a href="/crm/public/index.php/goods/checkout?cart_id={{$cart_id}}" class="btn button-default">Process to Checkout</a>
</div>
</body>
</html>
