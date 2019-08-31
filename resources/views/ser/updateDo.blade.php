@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
 @parent
@endsection
@section('content')

<div style="padding:30px">
	<script src="/crm/public/layui/layui.js"></script>
	@foreach ($data as $k=>$v)
	<form class="layui-form" action="/crm/public/client/updateDo" method="get" >
		<input type="hidden" name="id" value="{{$v->id}}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">

		<h3>客户服务修改</h3>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label">服务类型</label>
			<div class="layui-input-block">
				<select  lay-verify="required" name="s_type">
				@if ($v->s_type == 1)
						<option value=""></option>
						<option value="1" selected>上门服务</option>
						<option value="2">解决客户投诉</option>
						<option value="3">客户培训</option>
				@elseif ($v->s_type == 2)
						<option value=""></option>
						<option value="1" >上门服务</option>
						<option value="2" selected>解决客户投诉</option>
						<option value="3">客户培训</option>
				@else
						<option value=""></option>
						<option value="1" >上门服务</option>
						<option value="2" >解决客户投诉</option>
						<option value="3" selected>客户培训</option>
				@endif


				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">服务日期</label>
			<div class="layui-input-inline">
				<input type="date" name="s_date" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="{{$v->s_date}}">
			</div>
			<div class="layui-form-mid layui-word-aux"></div>
		</div>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label" >客户名称</label>
			<div class="layui-input-block">
				<input type="text" name="s_name" required  lay-verify="required" placeholder="请输入客户名称" autocomplete="off" class="layui-input" value="{{$v->s_name}}">
			</div>
		</div>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label" >联系人</label>
			<div class="layui-input-block">
				<input type="text" name="s_linkman" required  lay-verify="required" placeholder="请输入联系人名称" autocomplete="off" class="layui-input" value="{{$v->s_linkman}}">
			</div>
		</div>
		<div class="layui-form-item" >
			<div class="layui-input-block" >
				<button class="layui-btn" lay-submit lay-filter="formDemo">修改提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
	@endforeach
	<script>
		//Demo
		layui.use('form', function(){
			var form = layui.form;

			//监听提交
			form.on('submit(formDemo)', function(data){
				$.get(
						'/client/clientDo',
						data.fied,
						function (res){
							console.log(res);
						}

//							if(res.code==3){
//								layer.msg(res.font,{icon:res.code,time:1500},function(){
//									location.href="/index/login";
//								});
//							}else{
//								layer.msg(res.font,{icon:res.code});
//							}
//
//						},
//						'json'
				)
				return false;

			});
		});
	</script>
</div>
@endsection

