@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')
<div class="layui-form">
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
            <th>是否上架</th>
            <th>是否在审核中</th>
            <th>折扣活动</th>
        </tr>
        </thead>
        @foreach($data as $k=>$v)

        <tbody>
        <tr>

            <input type="hidden" id="goods_id" value="{{$v->goods_id}}">
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_stock}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_desc}}</td>
            <td><img src="/crm/public/{{$v->goods_img}}"  style="cursor:pointer;" class="goods_img" alt=""></td>
            <td>@if($v->goods_status==1)
                   上架
                @else
                  未上架
                @endif</td>
            <td>
                @if ($v->goods_examine == 1)

                    <button type="button" class="layui-btn layui-btn-radius">审核中</button>
                @elseif ($v->goods_examine == 2)

                    <button type="button" class="layui-btn layui-btn-normal layui-btn-radius">通过审核</button>
                @else
                    <button type="button" class="layui-btn layui-btn-disabled layui-btn-radius">未通过审核</button>
                @endif

            </td>
            <td>
                <button type="button" class="layui-btn layui-btn-radius" id="cli">点击参加折扣活动</button>
            </td>
        </tr>
        </tbody>
        @endforeach
    </table>
</div>



<script src="/crm/public/layui/layui.js" charset="utf-8"></script>
<script src="/crm/public/jquery/jquery-3.2.1.min.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    $(function(){
        // alert(1111);
        //点击注册
        $('#cli').click(function(){
           // alert(111);
            var goods_id=$('#goods_id').val();//获取该商品id
            //console.log(goods_id);

            //点击提交审核
            $.ajax({
                url :'/crm/public/index.php/goods_id',
                data:{goods_id:goods_id},
                method:'post',
                dataType:'json',
                success:function(res){
                    //alert(1111);
                    //console.log(res);
                    if(res.code=='1'){
                        alert(res.font);

                    }else{
                        //var goods_id=res.goods_id;
                       // console.log(goods_id);
                        alert(res.font);
                        //location.href='/crm/public/index.php/discount/goods_id?='.goods_id;
                         location.href='http://1810.test.com/crm/public/index.php/discount?goods_id='+res.goods_id;
                        // location.href='http://www.1810a.com/indexapi?token='+res.token+"&id="+res.id;
                    }
                }
            })


            return false;


        })


    })
</script>
@endsection
