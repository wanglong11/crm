@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')

    <div style="padding: 50px">
        <form action="">
            <h3>满折。满减活动。请输入合理的优惠</h3><br>
            <input type="hidden" name="goods_id" value="{{$good_id}}" id="goods_id">
            <label for="meeting">活动有效时间</label>
            <input id="date_name1" type="date" name="date_name"/>----
            <label for="meeting"></label><input  type="date" id="date_name2" /><br><br>
        <p>满减:满<input type="text" style="width: 35px;" id="subtract">元,
            减<input type="text" style="width: 35px;" id="element">元</p><br>
        <p>折扣:满<input type="text" style="width: 35px;" id="but">元，打
            <select name="" >
                @for($i=99;$i>=50;$i--)
                    <option value="{{$i}}" id="open">{{$i/10}}</option>
                @endfor
            </select>折
        </p>
            <br>
            <p>
                满赠:满<input type="text" id="full">件，
                赠<input type="text" id="full1">件
            </p>
            <br><br><button type="button" id="sub">Click Me!</button>
        </form>
    </div>
    <script src="/crm/public/layui/layui.js" charset="utf-8"></script>
    <script src="/crm/public/jquery/jquery-3.2.1.min.js"></script>
    <script>
        $(function(){
            // alert(1111);
            //点击Click Me!
            $('#sub').click(function(){
                // alert(111);
                var goods_id=$('#goods_id').val();//获取该商品id
               var date_name1=$('#date_name1').val();//获取有效时间
                var date_name2=$('#date_name2').val();//有效时间
                var subtract=$('#subtract').val();//满减
                var element=$('#element').val();//减价格
                var but=$('#but').val();//满折
               var element4=$('#open').html();//打折价
                var full=$('#full').val();//满赠
                var full1=$('#full1').val();//满赠的商品
                //点击提交审核
                $.ajax({
                    url :'/crm/public/index.php/DiscountDo',
                    data:{goods_id:goods_id,date_name1:date_name1,date_name2:date_name2,
                        subtract:subtract, element:element, but:but,element4:element4,full:full,full1:full1},
                    method:'post',
                    dataType:'json',
                    success:function(res){
                        console.log(res);
                        if(res.code=='1'){
                           alert(res.font);

                        }else{
                            alert(res.font);

                           // location.href='http://1810.test.com/crm/public/index.php/discount?goods_id='+res.goods_id;

                        }
                    }
                })


                return false;


            })


        })
    </script>




@endsection

