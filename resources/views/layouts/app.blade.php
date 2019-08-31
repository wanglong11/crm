<!DOCTYPE html>
<html> 
	<head>
	 	<title>应用名称 - @yield('title')</title>
	 	 	  <meta charset="utf-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			  <link rel="stylesheet" href="/crm/public/layui/css/layui.css">
		        <script src="/crm/public/layui/layui.js"></script>

	</head>
	<body> 
		@section('sidebar') 
			
			
			 
			<body class="layui-layout-body">
			<div class="layui-layout layui-layout-admin">
			  <div class="layui-header">
			    <div class="layui-logo">layui 后台布局</div>
			    <!-- 头部区域（可配合layui已有的水平导航） -->
			    <ul class="layui-nav layui-layout-left">
			      <li class="layui-nav-item"><a href="">控制台</a></li>
			      <li class="layui-nav-item"><a href="">商品管理</a></li>
			      <li class="layui-nav-item"><a href="">用户</a></li>
			      <li class="layui-nav-item">
			        <a href="javascript:;">其它系统</a>
			        <dl class="layui-nav-child">
			          <dd><a href="">邮件管理</a></dd>
			          <dd><a href="">消息管理</a></dd>
			          <dd><a href="">授权管理</a></dd>
			        </dl>
			      </li>
			    </ul>
			    <ul class="layui-nav layui-layout-right">
			      <li class="layui-nav-item">
			        <a href="javascript:;">
			          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
			          贤心
			        </a>
			        <dl class="layui-nav-child">
			          <dd><a href="">基本资料</a></dd>
			          <dd><a href="">安全设置</a></dd>
			        </dl>
			      </li>
			      <li class="layui-nav-item"><a href="/crm/public/index.php/userLog">退了</a></li>
			    </ul>
			  </div>
			  
			  <div class="layui-side layui-bg-black">
			    <div class="layui-side-scroll">
			      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
			      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
			        <li class="layui-nav-item layui-nav-itemed">
			          <a class="" href="javascript:;">客户服务管理</a>
			          <dl class="layui-nav-child">
			            <dd><a href="crm/public/index.php/service/index">列表一</a></dd>
			            <dd><a href="crm/public/client/lists">列表二</a></dd>
			          </dl>
			        </li>
                      <li class="layui-nav-item layui-nav-itemed">
                          <a class="" href="javascript:;">商家管理</a>
                          <dl class="layui-nav-child">
                              <dd><a href="/crm/public/index.php/goods">商品添加</a></dd>
                              <dd><a href="/crm/public/index.php/goodsList">商品展示</a></dd>
							  <dd><a href="/crm/public/index.php/goodsAudit">商品审核</a></dd>
							  <dd><a href="/crm/public/index.php/admin_goods_show_order">商品商家订单</a></dd>
                          </dl>
                      </li>
					  <li class="layui-nav-item layui-nav-itemed">
						  <a class="" href="javascript:;">商家满折活动</a>
						  <dl class="layui-nav-child">
							  <dd><a href="/crm/public/index.php/discount">添加满折商品</a></dd>
							  <dd><a href="/crm/public/index.php/discountList">满折商品展示</a></dd>
						  </dl>
					  </li>
					  <li class="layui-nav-item layui-nav-itemed">
						  <a class="" href="javascript:;">商品属性管理</a>
						  <dl class="layui-nav-child">
							  <dd><a href="/crm/public/index.php/basicAdd">基本属性</a></dd>
							  <dd><a href="/crm/public/index.php/saleAdd">销售属性</a></dd>
						  </dl>
					  </li>
                      <li class="layui-nav-item layui-nav-itemed">
                          <a class="" href="javascript:;">商品管理</a>
                          <dl class="layui-nav-child">
                              <dd><a href="/crm/public/index.php/goods2list">商品列表</a></dd>
                              <dd><a href="/crm/public/index.php/goods2add">商品添加</a></dd>
                          </dl>
                      </li>
			        <li class="layui-nav-item"><a href="">云市场</a></li>
			        <li class="layui-nav-item"><a href="">发布商品</a></li>
			      </ul>
			    </div>
			  </div>
			  
			  <div class="layui-body">
		@show 
		<div class="container"> @yield('content') </div> 
		  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
  </div>
</div>

<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>
	</body>
</html>