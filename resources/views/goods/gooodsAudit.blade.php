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
            </tr>
            </thead>
            @foreach($data as $k=>$v)
                <tbody>
                <tr>
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
                        <input type="hidden" value="{{ $v->goods_examine}}" id="audit">
                        <input type="hidden" value="{{ $v->goods_id}}" id="goods_id">
                        <button type="button" class="layui-btn layui-btn-danger" id="but" >未通过审核</button>

                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    <script src="/crm/public/layui/layui.js" charset="utf-8"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
     <script src="/crm/public/jquery/jquery-3.2.1.min.js"></script>
    <script>
        $(function(){

           // alert(1111);
            //点击注册
            $('#but').click(function(){
                //alert(111);
                var audit=$('#audit').val();//获取到未审核状态
                var goods_id=$('#goods_id').val();//商品id
                //console.log(account);
                //点击提交审核
                $.ajax({
                    url :'/crm/public/index.php/goodsAuditDO',
                    data:{audit:audit,goods_id:goods_id},
                    method:'post',
                    dataType:'json',
                    success:function(res){
                        //alert(1111);
                        //console.log(res);
                        if(res.code=='1'){
                            alert(res.font);
                            location.href='/crm/public/index.php/goodsList';
                        }else{
                            alert(res.font);

                        }
                    }
                })


                return false;


            })


        })
    </script>
@endsection


