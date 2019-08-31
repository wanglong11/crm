@extends('layouts.app')
@section('title', 'layui后台大布局')
@section('sidebar')
	@parent
    <link rel="stylesheet" href="/crm/public/css/page.css">
    <script src="/crm/public/jquery/jquery-3.2.1.min.js"></script>
@endsection
@section('content')
	<div style="padding:30px">

	@if (session('status'))
		<script>
			alert("{{ session('status') }}");
		</script>
	@endif
		@if (session('sta'))
			<script>
				alert("{{ session('sta') }}");
			</script>

		@endif
		@if (session('update'))
			<script>
				alert("{{ session('update') }}");
			</script>

		@endif
	<table class="layui-table">
		<colgroup>
			<col width="150">
			<col width="200">
			<col>
		</colgroup>
		<thead>
		<tr>
			<th>ID</th>
			<th>服务类型</th>
			<th>服务时间</th>
			<th>客户名称</th>
			<th>服务内容</th>
			<th>操作</th>
		</tr>
		</thead>
		@foreach ($data as $k=>$v)
		<tbody>
		<tr>
			<td>{{$v->id}}</td>
			<td>
					@if ($v->s_type == 1)
						上门服务
					@elseif ($v->s_type == 2)
						解决客户投诉
					@else
						客户培训
					@endif

			</td>
			<td>{{$v->s_date}}</td>
			<td>{{$v->s_name}}</td>
			<td>{{$v->s_desc}}</td>
			<td><a href="/crm/public/client/updata?id={{$v->id}}">编辑</a>
				<a href="/crm/public/client/die/?id={{$v->id}}">删除</a>
			</td>

		</tr>
		</tbody>

		@endforeach

	</table>
	{{ $data->links() }}
</div>
@endsection

