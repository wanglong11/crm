@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')

    <div style="padding:30px">
        <script src="/crm/public/layui/layui.js"></script>

        <form class="layui-form" action="/crm/public/index.php/goodsDO" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h3>商品管理</h3>
            <div class="layui-form-item" style="width:500px; hight:200px">
                <label class="layui-form-label" >商品名称</label>
                <div class="layui-input-block">
                    <input type="text" name="goods_name" required  lay-verify="required" placeholder="商品名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="width:500px; hight:200px">
                <label class="layui-form-label" >商品库存</label>
                <div class="layui-input-block">
                    <input type="text" name="goods_stock" required  lay-verify="required" placeholder="商品库存" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="width:500px; hight:400px">
                <label class="layui-form-label" >商品单价</label>
                <div class="layui-input-block">
                    <input type="text" name="goods_price" required  lay-verify="required" placeholder="商品单价" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="width:500px; hight:200px">
                <label class="layui-form-label" >商品图片</label>
                <div class="layui-input-block">
                    <input type="file" name="goods_img" required  lay-verify="required" >
                </div>
            </div>
            <div class="layui-form-item layui-form-text" style="width:750px; hight:200px">
                <label class="layui-form-label">商品介绍</label>
                <div class="layui-input-block">
                    <textarea  placeholder="商品介绍"  name="goods_desc" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否上架</label>
                <div class="layui-input-block">
                    <input type="radio" name="goods_status" value="1" title="上架" checked="">
                    <input type="radio" name="goods_status" value="2" title="下降">
                </div>
            </div>
            <div class="layui-form-item" >
                <div class="layui-input-block" >
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>

        <script>
            //Demo
            layui.use('form', function(){
                var form = layui.form;

//
            });
        </script>
    </div>
@endsection
