<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * [折扣活动满减满折]
     * @return [type] [description]
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/8/1 0026
     * Time: 16:31
     */
    //活动添加
    public function DiscountAdd(Request $request){
         $good_id=$request->all();
//        dd($good_id);
        if(empty($good_id)){
         echo "大哥你犯法了，注意一下子。请选择一个你要打折的商品";
        }else{
            return view('discount/discountAdd',['good_id'=>$good_id['goods_id']]);
        }


    }
    /**
     * 满折扣活动添加
     */
    public function DiscountDo(Request $request){
        $date=$request->all();
      //  dd($date);
        $shop_id=session('shop_id');//商户id
        //把满折满扣活动字段信息入库
        $arr=[
            'shop_id'=>$shop_id,
            'goods_id'=>$date['goods_id'],
            'date_name1'=>strtotime($date['date_name1']),
            'date_name2'=>strtotime($date['date_name2']),
            'subtract'=>$date['subtract'],
            'element'=>$date['element'],
            'but'=>$date['but'],
            'element4'=>$date['element4'],
            'time'=>time(),
            'valid'=>strtotime($date['date_name2'])-strtotime($date['date_name1']),
            'full'=>$date['full'],
            'full_num'=>$date['full1']
        ];
        $data=\DB::table('discount')->insertGetId($arr);
        //dd($data);
        if($data){
            $request=[
                'code'=>1,
                'font'=>'添加成功'
            ];
         return  json_encode($request);
        }else{
            $request=[
                'code'=>2,
                'font'=>'添加失败'
            ];
            echo  json_encode($request);
        }
    }
    /**
     * 测试
     */
    public function test(){
      $a=4;
        $b=1;
        $s=2;
      if($a>$b){

      }

        dd($c);
    }

}