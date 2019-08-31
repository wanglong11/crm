<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
class CartController extends Controller
{
    //添加购物车
    public function cartAdd(){
        $goods_id=$_GET['goods_id'];
      //  dd($goods_id);
        $user_id=1;

        $data=[
            'goods_id'=>$goods_id,
            'buy_number'=>1,
            'user_id'=>$user_id,
            'status'=>0,//购物车状态
            'create_time'=>time()
        ];
        $res=\DB::table('shop_cart')->insert($data);
        if($res){
            echo '购物车添加成功';
            header("refresh:2,url=/crm/public/index.php/cart/cartList");
        }else{
            echo '购物车添加失败';
        }
    }
    /**
     * [购物车列表]
     * @return [type] [description]
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/7/26 0026
     * Time: 11:31
     */
    public function cartList()
    {
        //echo 11;
        $data=CartModel::get()->toArray();
       // dd($data);
        $totalPrice=0;
        $cart_id='';
        foreach($data as $k=>$v){
            $goodsInfo=GoodsModel::where(['goods_id'=>$v['goods_id']])->first()->toArray();//查询商品表得到该商品价格
           // dd($goodsInfo);
            $data[$k]['image']=$goodsInfo['goods_img'];//商品图片
            $data[$k]['name']=$goodsInfo['goods_name'];//商品名
            $data[$k]['price']=$goodsInfo['goods_price'];//商品价格
            $data[$k]['goods_num']=$goodsInfo['goods_stock'];//库存
            $totalPrice+=$v['buy_number']*$goodsInfo['goods_price'];//总价钱
            $cart_id.=$v['cart_id'].',';
            $data[$k]['buy_number']=$v['buy_number'];
        }

        $cart_id=rtrim($cart_id,',');//购物车id
      // dd($totalPrice);
        return view('index/cart_list',compact('data','totalPrice','cart_id'));
    }
}
