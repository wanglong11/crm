@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
 @parent
@endsection
@section('content')

<div style="padding:30px">
	<script src="/crm/public/layui/layui.js"></script>

	<form class="layui-form" action="/crm/public/client/clientDo" method="get" >
		{{csrf_field()}}
		<h3>客户服务管理</h3>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label">服务类型</label>
			<div class="layui-input-block">
				<select  lay-verify="required" name="s_type">
					<option value=""></option>
					<option value="1">上门服务</option>
					<option value="2">解决客户投诉</option>
					<option value="3">客户培训</option>
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">服务日期</label>
			<div class="layui-input-inline">
				<input type="date" name="s_date" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
			</div>
			<div class="layui-form-mid layui-word-aux"></div>
		</div>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label" >客户名称</label>
			<div class="layui-input-block">
				<input type="text" name="s_name" required  lay-verify="required" placeholder="请输入客户名称" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label" >联系人</label>
			<div class="layui-input-block">
				<input type="text" name="s_linkman" required  lay-verify="required" placeholder="请输入联系人名称" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item" style="width:500px; hight:400px">
			<label class="layui-form-label" >服务预计成本</label>
			<div class="layui-input-block">
				<input type="text" name="s_fucost" required  lay-verify="required" placeholder="请输入预计成本￥" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label" >时间成本</label>
			<div class="layui-input-block">
				<input type="text" name="event_cost" required  lay-verify="required" placeholder="请输入预计成本" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item layui-form-text" style="width:750px; hight:200px">
			<label class="layui-form-label">服务内容描述</label>
			<div class="layui-input-block">
				<textarea  placeholder="请输入内容"  name="s_desc" class="layui-textarea"></textarea>
			</div>
		</div>
		<h3>客户反馈</h3>
		<div class="layui-form-item" style="width:500px; hight:200px">
			<label class="layui-form-label">客户满意度</label>
			<div class="layui-input-block">
				<select  lay-verify="required" name="sati">
					<option value=""></option>
					<option value="1">一般</option>
					<option value="2">还行</option>
					<option value="3">满意</option>
					<option value="4">超级满意</option>
				</select>
			</div>
		</div>
		<div class="layui-form-item layui-form-text" style="width:600px; hight:200px">
			<label class="layui-form-label">客户反馈意见：</label>
			<div class="layui-input-block">
				<textarea name="idea" placeholder="请输入内容"   class="layui-textarea"></textarea>
			</div>
		</div>

		<h3>描述：</h3>
		<div class="layui-form-item layui-form-text" style="width:600px; hight:200px">
			<label class="layui-form-label">备注1：</label>
			<div class="layui-input-block">
				<textarea  placeholder="请输入内容"  name="remark" class="layui-textarea"></textarea>
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

