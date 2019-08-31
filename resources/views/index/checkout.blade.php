<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品结算</title>
</head>
<body>
<h4>商品结算</h4>
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
    @foreach($goods_data as $k=>$v)
        <tbody>
        <tr>
            <td>{{$v['goods_name']}}</td>
            <td><img src="/crm/public/{{$v['goods_img']}}"  height="100" width="100" ></td>
            <br>
            <td>{{$v['buy_number']}}</td>
            <td>{{$v['goods_price']}}</td>

        </tr>
        </tbody>
    @endforeach
    <div class="col s5">
        <h6 id="">总价钱${{$countTotal}}</h6>
    </div>
</table>
<h4>收货地址</h4>
收货人手机号：<input type="text" name="tel" id="tel"><br>
用户人所在的城市：<input type="text" name="city" id="city"><br>
用户人收货地址：<input type="text" name="address" id="address"><br>
用户人的邮编：<input type="email" name="email" id="email"><br>
<input type="hidden" value="{{$goods_id}}" id="goods_id">
<input type="hidden" value="{{$countTotal}}" id="totalPrice">
<button id="but">结算</button>
</div>
</body>
</html>
<script src="/crm/public/jquery/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        // alert(1111);
        //点击注册
        $('#but').click(function(){
            //alert(111);
            var totalPrice=$('#totalPrice').val();//获取总价钱
            var goods_id=$('#goods_id').val();//商品id
            var tel=$('#tel').val();//获取到手机号
            var city=$('#city').val();//获取用户的所在城市
            var address=$('#address').val();//获取到用户填写的地址
            var email=$('#email').val();//获取到用户邮编
          //点击提交审核
            $.ajax({
                url :'/crm/public/index.php/goods/order',
                data:{totalPrice:totalPrice,goods_id:goods_id,tel:tel,city:city,address:address,email:email},
                method:'post',
                dataType:'json',
                success:function(res){
                    //alert(1111);
                    console.log(res);
//                    if(res.code=='1'){
//                        alert(res.font);
//                        location.href='/crm/public/index.php/goodsList';
//                    }else{
//                        alert(res.font);
//
//                    }
                }
            })


            return false;


        })


    })
</script>