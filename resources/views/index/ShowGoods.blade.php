<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>前台商品展示</title>
</head>
<body>
<div class="layui-form">
    <h1>商品展示</h1>
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
            <th>商品库存</th>
            <th>商品单价</th>
            <th>商品介绍</th>
            <th>商品图片</th>
        </tr>
        </thead>
        @foreach($data as $k=>$v)
            <tbody>
            <tr>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_stock}}</td>
                <td>{{$v->goods_price}}</td>
                <td>{{$v->goods_desc}}</td>
                <td><img src="/crm/public/{{$v->goods_img}}"  height="100" width="100" >
                </td>
                <td>
                    <a href="/crm/public/index.php/cart/cartAdd?goods_id={{$v->goods_id}}" class="btn button-default">添加到购物车
                    </a>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
</body>
</html>