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
//CRM系统
Route::any("linkman/linkman","LinkmanController@linkman");
//客户服务
Route::match(['get','post'],'service/index','SerController@service');//
Route::match(['get','post'],'client/clientDo','SerController@serdo');//添加
Route::match(['get','post'],'client/lists','SerController@index');//展示
Route::match(['get','post'],'client/die','SerController@del');//删除
Route::match(['get','post'],'client/updata','SerController@update');//修改
Route::match(['get','post'],'client/updateDo','SerController@updateDo');//执行修改
