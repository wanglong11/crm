@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')
    <div style="padding:30px">
        <script src="/crm/public/layui/layui.js"></script>
        <form class="layui-form" action="/crm/public/index.php/basicDo" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h3>商品基本属性</h3>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">请选择分类</label>
                    <div class="layui-input-inline">
                        <select name="quiz">
                            <option value="">请选择</option>
                            @foreach($str as $k=>$v)
                            <optgroup label="">
                                <option value="{{$v['cate_id']}}">{{str_repeat('------------------' , $v['lev']) . $v['cate_name'] }}</option>
                            </optgroup>
                            @endforeach
                        </select>

                    </div>
                    <input type="button" id="btn" value="添加属性" class="layui-btn layui-btn-primary">
                </div>
                <span id="mark"></span>
                <div class="all_attr">
                </div>
                <div class="layui-input-block" >
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <style>
            .son{
                margin-left:10px;
            }
        </style>
        <script>
            //Demo
            layui.use('form', function(){
                var form = layui.form;

//
            });
        </script>
        <script>
         var len =1;
            $(document).on('click','#btn',function (){
                console.log(len);
                var b_attr='<div class="one" len='+len+'>'+
                        '<br/>属性名：<input type="text" name="attr['+len+']">'+
//                        '<button class="del" type="button">-</button>'+
                        ' <button type="button" class="layui-btn layui-btn-sm" id="del"><i class="layui-icon"></i></button>'+
//                        '<button class="add" type="button">+</button><br/>'+
                        '<button type="button" class="layui-btn layui-btn-sm" id="add"><i class="layui-icon"></i></button>'+
                        '</div>';
                        $('.all_attr').append(b_attr);
                len ++;
            });
            $(document).on('click','#del',function(){
                $(this).parent().remove();
            });
            $(document).on('click','#delson',function(){
                $(this).parent().remove();
            });
            $(document).on('click','#add',function(){
                var this_len=$(this).parent().attr('len');
                var b_value="<div class='son'>"+
                        "属性值：<input name='son["+this_len+"][]'type='text'>"+
//                        "<button class='delson'>-</button>"+"</div>";
                '<button type="button" class="layui-btn layui-btn-sm" id="delson"><i class="layui-icon"></i></button>'+'</div>';

                $(this).parent().append(b_value);
            });









        </script>
    </div>
@endsection

