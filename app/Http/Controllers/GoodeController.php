<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
class GoodeController extends Controller
{
    /**
* Created by PhpStorm.
* User: 杜甫
* Date: 2019/7/25 0025
* Time: 21:36
*/
    public function goods(){
       // echo 111;
        return view('goods/goods');
    }

    /**
     * 后台商品添加
     */
    public function goodsDO(Request $request){
        $shop_ip=session('shop_id');
        //dd($shop_ip);
        $arr=$request->all();
       // dd($arr);
       // dd($arr);
        unset($arr['_token']);
        $file=$this->uplode($request,'goods_img');
       // dd($file);
        $arr1=[
        'goods_name'=>$arr['goods_name'],//商品名
         'shop_id' =>$shop_ip,//商户id
          'goods_stock' =>$arr['goods_stock'] ,//库存
            'goods_price'=>$arr['goods_price'],//商品单价
            'goods_desc'=>$arr['goods_desc'],//商品介绍
            'goods_img'=>$file,//图片路径
            'goods_status'=>$arr['goods_status']
        ];
       // dd($arr1);
        $data=\DB::table('shop_goods')->insertGetId($arr1);
        //dd($data);
        if($data){
            header("refresh:2,url=/crm/public/index.php/goodsList");
        }else{
            echo "商品添加出错了";
        }




    }
    /**文件上传*/
    public function uplode(Request $request,$filename){
        // dd($filename);
        //你可以使用 hasFile 方法判断文件在请求中是否存在,使用 isValid 方法判断文件在上传过程中是否出错：
        if ($request->hasFile($filename) && $request->file($filename)->isValid()) {
            $photo = $request->file($filename);
            //dd($photo);
            $store_result = $photo->store('image/images');
            return $store_result;

        }
        exit('未获取到上传文件或上传过程出错');
    }
    /**
     *后台 商品展示
     */
    public function goodsList(){
        //查询数据  商品数据上线、和未通过审核
        $where=[
          'goods_status' =>1,
           // 'goods_examine'=>3
        ];
        $data=\DB::table('shop_goods')->where($where)->get();
        //dd($data);

        return view('goods/gooodsLiset',compact('data',$data));
    }
    /**
     * 后台商品审核
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/7/26 0026
     * Time: 9:25
     */
    public function goodsAudit(){
        //查询数据  商品数据上线、和未通过审核
        $where=[
            'goods_status' =>1,
             'goods_examine'=>3
        ];
        $data=\DB::table('shop_goods')->where($where)->get();
        //dd($data);

        return view('goods/gooodsAudit',compact('data',$data));
    }

    /**
     * @param Request $request
     * 后台审核执行
     */
    public function goodsAuditDO(Request $request){
        $data=$request->all();
        //dd($data);
        $where=[
            'goods_id'=>$data['goods_id'],
            'goods_examine'=>$data['audit']
        ];
        $where1=[
            'goods_examine'=>2
        ];
        $arr=\DB::table('shop_goods')->where($where)->update($where1);
        //dd($arr);
if($arr){
    $request=[
        'code'=>1,
        'font'=>'审核通过'
       ];
       echo  json_encode($request);
     }else{
    $request=[
        'code'=>2,
        'font'=>'审核失败'
    ];
    echo  json_encode($request);
}


    }

    /**
     * 前台商品展式
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/7/26 0026
     * Time: 10:37
     */

    public function ShowGoods(){
        //查询数据  商品数据上线、和未通过审核
        $where=[
            'goods_status' =>1,//上架
             'goods_examine'=>2//通过审核查询出来
        ];
        $data=\DB::table('shop_goods')->where($where)->get();
        //dd($data);

        return view('index/ShowGoods',compact('data',$data));
    }
    /**
     * [商品结算]
     * @return [type] [description]
     */
    public function checkout()
    {
        $user_id=1;
        $cart_id=request()->input('cart_id');
        $cart_id=explode(',', $cart_id);
        //TODA  业务逻辑
        //通过购物车穿过的购物车id 与商品id 查询该用户买的商品数量和单价 总价 赋值给模板展示
        $where=[
            'user_id'=>$user_id,
        ];
        $goods_data=CartModel::join('shop_goods','shop_cart.goods_id','=','shop_goods.goods_id')->where($where)->whereIn('cart_id',$cart_id)->get()->toArray();
        //dd($goods_data);
        //查出数据计算总价
        $countTotal=0;
        $goods_id='';
        foreach ($goods_data as $k => $v) {
            $goods_data[$k]['count']=$v['goods_price']*$v['buy_number'];//要计算的商品
            $countTotal+=$v['goods_price']*$v['buy_number'];//商品总价
            $goods_id.=$v['goods_id'].',';
        }
        $goods_id=rtrim($goods_id,',');
        //dd($goods_id);

        return view('index/checkout',compact('goods_data','countTotal','goods_id'));

    }

    /**
     * 后台点击减满减折传递goods_id
     */
     public function goods_id(Request $request){
         $goods_id=$request->goods_id;
         //dd($goods_id);
         if(empty($goods_id)){//为空不能跳转
             $request=[
                 'code'=>1,
                 'font'=>'请选择您要选择活动商品'
             ];
             echo  json_encode($request);

         }else{
             $request=[
                 'code'=>2,
                 'font'=>'正在跳转该活动的页面',
                 'goods_id'=>$goods_id
             ];
            echo   json_encode($request);
         }

     }
}
