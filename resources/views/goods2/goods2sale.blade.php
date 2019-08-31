<form class="layui-form-item" action="" method="">
    {{csrf_field()}}
    @foreach($arr as $k=>$v)
        <div class="layui-form-item" style="width:500px; hight:200px">
            <label class="layui-form-label" >{{$v['sale_name']}}</label>
            <div class="layui-input-block">
                @foreach($v['son'] as $kk=>$vv)
                    <input type="checkbox" value="{{$vv}}">{{$vv}}
                @endforeach
            </div>
        </div>    
    @endforeach
</form>