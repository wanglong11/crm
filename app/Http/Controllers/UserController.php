<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商家登录页面
     */
    public function userLog(){
        return view('user/Log');
    }
    /**
     * 商家登录执行
     */
    public function userLogDo(Request $request){
        $arr=$request->all();
        //登录查询user_id 到商户表里面 查询出来吧shop_id商户id把他存入session中
        $name=$arr['name'];//用户名
        $password=$arr['password'];//密码
        $data=\DB::table('user')->where(['name'=>$name])->first();
        //dd($data);
        if($data){//用户登录查询商户表进行查询到商户的_id
            $user_id=$data->user_id;
            $data=\DB::table('business')->where(['user_id'=>$user_id])->first();
            //得到shop_id 商户id 把商户id 存入session中
            $shop_id=$data->shop_id;
            session(['shop_id'=>$shop_id]);
            $data=session('shop_id');
            //dd($data);
            $request=[
                'code'=>1,
                'font'=>'登录成功'
            ];
            echo  json_encode($request);
            //header("refresh:2,url=/crm/public/index.php/service/index");
        }else{
            echo "没有查询出来";
        }


    }
    /**
     * 前台页面
     */
    public function index(){
        return view('index/index/index');
    }
}
