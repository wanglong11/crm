<form class="layui-form-item" action="" method="">
    {{csrf_field()}}
    @foreach($arr as $k=>$v)
        @if($v['status']==2)
        <div class="layui-form-item" style="width:500px; hight:200px">
            <label class="layui-form-label" >{{$v['basic_name']}}</label>
            <div class="layui-input-block">
                <select name="" id="">
                    <option value="">选择</option>
                    @foreach($v['son'] as $kk=>$vv)
                        <option value="">{{$vv}}</option>
                    @endforeach
                </select>
            </div>
        </div>    
        @else
        <div class="layui-form-item" style="width:500px; hight:200px">
            <label class="layui-form-label" >{{$v['basic_name']}}</label>
            <div class="layui-input-block">
                    @foreach($v['son'] as $kk=>$vv)
                        <input type="text" value="{{$vv}}">
                    @endforeach
               
            </div>
        </div>        
        @endif
    @endforeach
</form>