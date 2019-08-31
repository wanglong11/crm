<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get','post'],'service/index','SerController@service');//



//商家登录
Route::get('userLog','UserController@userLog');
//商家登录信息
Route::post('userLogDo','UserController@userLogDo');

//商品添加视图
Route::get('goods','GoodeController@goods');
Route::post('goodsDO','GoodeController@goodsDO');
//商品展示
Route::get('goodsList','GoodeController@goodsList');
//商品审核
Route::get('goodsAudit','GoodeController@goodsAudit');
//商家商品订单展示
Route::get('admin_goods_show_order','OrderController@admin_goods_show_order');
//商品审核控制器
Route::post('goodsAuditDO','GoodeController@goodsAuditDO');
//活动满减满折点击传递goods_id
Route::post('goods_id','GoodeController@goods_id');
//满减满折活动 页面
Route::get('discount','DiscountController@DiscountAdd');
//满减满折活动 添加
Route::post('DiscountDo','DiscountController@DiscountDo');

Route::get('DiscountDo1','DiscountController@test');
//前台 页面
Route::get('index','UserController@index');
//商品展示
Route::get('ShowGoods','GoodeController@ShowGoods');
//添加购物车
Route::get('cart/cartAdd','CartController@cartAdd');
//购物车列表
Route::get('cart/cartList','CartController@cartList');
//商品结算
Route::get('goods/checkout','GoodeController@checkout');
//订单提及
Route::post('goods/order','OrderController@orderDo');

///订单提价
Route::get('submitOrder','OrderController@submitOrder');
Route::get('session_id','OrderController@session_id');

//考试题
Route::get('session_id1','OrderController@session_id1');



//商品属性管理

//商品基本属性
Route::get('basicAdd','BasicController@BasicAdd');
//添加商品基本属性
Route::post('basicDo','BasicController@BasicDo');
//商品销售属性
Route::get('saleAdd','SaleController@SaleAdd');
//商品销售属性添加
Route::post('saleDo','SaleController@saleDo');
//商品
Route::get('goods2add','Goods2controller@goods2add');
Route::post('goods2basicadd','Goods2controller@goods2basicadd');
Route::post('goods2basictype','Goods2controller@goods2basictype');














