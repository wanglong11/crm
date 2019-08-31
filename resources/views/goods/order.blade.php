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
                <th>子订单ID</th>
                <th>主订单号id</th>
                <th>商家订单号</th>
                <th>user_id</th>
                <th>支付状态</th>
                <th>子订单id号</th>
                <th>商家商品钱</th>
                <th>子订单添加时间</th>
            </tr>
            </thead>
            @foreach($res as $k=>$v)
                <tbody>
                <tr>
                    <td>{{$v['o_id']}}</td>
                    <td>{{$v['order_id']}}</td>
                    <td>{{$v['shop_id']}}</td>
                    <td>{{$v['user_id']}}</td>
                    <td>@if($v['pay_status']==1)
                            支付
                        @else
                         未支付
                        @endif</td>
                    <td>{{$v['order_son_no']}}</td>
                    <td>{{$v['total']}}</td>
                    <td>{{ date("Y-m-d H:i:s",$v['create_time'])}}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>



    <script src="/crm/public/layui/layui.js" charset="utf-8"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
@endsection
