<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    /**
     * 商品属性添加
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/8/30 0030
     * Time: 19:47
     */
    /**
     * 商品基本属性添加
     */
    public function BasicAdd(){
        $arr=\DB::table('shop_category')->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
        $str=$this->getSubTree($arr);
        //var_dump($str);
        return view('goods/basic',compact('str'));
    }
    /**
     * 获取子类
     */
    function getSubTree($data , $id = 0 , $lev = 0) {
        static $son = array();
        foreach($data as $key => $value) {
            if($value['parent_id'] == $id) {
                $value['lev'] = $lev;
                $son[] = $value;
                $this->getSubTree($data , $value['cate_id'] , $lev+1);
            }
        }

        return $son;
    }
    /**
     * 商品属性基本添加
     */
    public function BasicDo(Request $request){
        $attr=$request->post('attr');
       $cate_id=$request->post('quiz');
       //便利添加
        foreach($attr as $k=>$v){
            //写入属性表
            $arr=[
              'cate_id'=>$cate_id,
                'basic_name'=>$v,
                'status'=>1,
                'c_time'=>time()
            ];
            $data=\DB::table('shop_basic_attr')->insertGetId($arr);
          //写入属性值表
            //查找是否存在子节点
            $son=$_POST['son'][$k] ?? '';
            echo '/'.$data.'/';
            if($son){
                foreach ($son as $kk=>$vv){
                    $arr=[
                        'basic_attr_id'=>$data,
                        'cate_id'=>$cate_id,
                        'basic_value'=>$vv,
                        'status'=>1,
                        'c_time'=>time()
                    ];
                    $data1=\DB::table('shop_basic_value')->insertGetId($arr);
                }
                echo "添加成功";
            }
        }

    }

}
