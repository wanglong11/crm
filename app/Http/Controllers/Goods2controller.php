<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Goods2controller extends Controller
{
    public function goods2add(){
        $arr=\DB::table('shop_category')->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
        $str=$this->getSubTree($arr);
        // var_dump($str);
        return view('goods2.goods2add',compact('str'));
    }
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
    public function goods2basicadd(Request $request){
        $cate_id=$request->input('cate_id');
        $data=DB::Table('shop_basic_attr')->where('cate_id',$cate_id)->get();
        $data=json_decode(json_encode($data),true);
        // print_R($data);exit;
        if(!empty($data)){
            return [
                'status'=>1
            ];
        }else{
            return [
                'stauts'=>2
            ];
        }
    }
    public function goods2basictype(Request $request){
        $cate_id=$request->input('cate_id');
        $type=$request->input('type');
        if($type==1){
            $data=DB::Table('shop_basic_attr')->where('cate_id',$cate_id)->get();
            $data=json_decode(json_encode($data),true);
            $arr=[];
            foreach($data as $k=>$v){
                $valuedata=DB::TAble('shop_basic_value')->where('basic_attr_id',$v['basic_attr_id'])->get();
                $valuedata=json_decode(json_encode($valuedata),true);
                $arr[$k]['cate_id']=$v['cate_id'];
                $arr[$k]['basic_name']=$v['basic_name'];
                $arr[$k]['status']=$v['status'];
                foreach($valuedata as $kk=>$vv){
                    $arr[$k]['son'][$kk]=$vv['basic_value'];
                }
            }
            return view('goods2.goods2attr',['arr'=>$arr]);
        }else if($type==2){
            $data=DB::Table('shop_sale_attr')->where('cate_id',$cate_id)->get();
            $data=json_decode(json_encode($data),true);
            $arr=[];
            foreach($data as $k=>$v){
                $valuedata=DB::TAble('shop_sale_value')->where('sale_attr_id',$v['sale_attr_id'])->get();
                $valuedata=json_decode(json_encode($valuedata),true);
                $arr[$k]['cate_id']=$v['cate_id'];
                $arr[$k]['sale_name']=$v['sale_name'];
                $arr[$k]['status']=$v['status'];
                foreach($valuedata as $kk=>$vv){
                    $arr[$k]['son'][$kk]=$vv['sale_value'];
                }
            }
            return view('goods2.goods2sale',['arr'=>$arr]);
        }
    }
}
