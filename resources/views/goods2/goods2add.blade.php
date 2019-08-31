@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')

    <div style="padding:30px">
        <script src="/crm/public/jquery/jquery-3.2.1.min.js"></script>
        <div style="font-size:20px">
            <a href="goods2add">商品基本信息</a>&nbsp;&nbsp;&nbsp;
            <a class="block" style="display:none;" block="" type="1" href="javascript:;">商品基本属性</a>&nbsp;&nbsp;&nbsp;
            <a style="display:none;" type="2" class="block" block=""  href="javascript:;">商品销售属性</a>
        </div>
            <div id="form1">
            <form class="layui-form" action="" method="" enctype="multipart/form-data">
                {{csrf_field()}}
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
                <div class="layui-inline">
                        <label class="layui-form-label">请选择分类</label>
                        <div class="layui-input-inline">
                            <select name="quiz" lay-filter="select" class="se">
                                <option  value="">请选择</option>
                                @foreach($str as $k=>$v)
                                <optgroup label="">
                                    <option value="{{$v['cate_id']}}">{{str_repeat('------------------' , $v['lev']) . $v['cate_name'] }}</option>
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="layui-form-item" style="width:500px; hight:400px">
                    <label class="layui-form-label" >商品单价</label>
                    <div class="layui-input-block">
                        <input type="text" name="goods_price" required  lay-verify="required" placeholder="商品单价" autocomplete="off" class="layui-input">
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
        </div>
        <div id="form2"></div>
        <div id="form3"></div>
    </div>
<script>
    $(function(){
        layui.use(['form','layer'], function(){
            var form = layui.form;
            var layer = layui.layer;
            form.on('select(select)', function (data){ 
                cate_id=$('.se').val()
                $.ajax({
                    url:"goods2basicadd",
                    data:{cate_id:cate_id},
                    type:"post",
                    success:function(msg){
                        if(msg.status==1){
                            $('.block').attr('style','')
                            $('.block').attr('block',cate_id)
                        }else{
                            $('.block').css('display','none')
                            $('.block').attr('block',cate_id)
                        }
                    }
                })
            });
            $(document).on('click','.block',function(){
                type=$(this).attr('type')
                cate_id=$(this).attr('block')
                data={}
                data.type=type
                data.cate_id=cate_id
                $.ajax({
                    url:"goods2basictype",
                    data:data,
                    type:"post",
                    success:function(msg){
                        $('#form1').css('display','none')
                        $('#form2').html(msg)
                    }
                })
            })
        });
       
    })
</script>
@endsection

