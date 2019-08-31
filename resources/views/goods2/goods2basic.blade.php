<form class="layui-form" action="" method="">
    {{csrf_field()}}
    @foreach($goods2basiclist as $k=>$v)
        <div class="layui-form-item" style="width:500px; hight:200px">
            <label class="layui-form-label" >商品库存</label>
            <div class="layui-input-block">
                <input type="text" name="goods_stock" required  lay-verify="required" placeholder="商品库存" autocomplete="off" class="layui-input">
            </div>
        </div>
    @endforeach
</form>
<form class="layui-form" action="" method="" style="display:none;">
    {{csrf_field()}}
    <div class="layui-form-item" style="width:500px; hight:200px">
        <label class="layui-form-label" >商品库存</label>
        <div class="layui-input-block">
            <input type="text" name="goods_stock" required  lay-verify="required" placeholder="商品库存" autocomplete="off" class="layui-input">
        </div>
    </div>
</form>