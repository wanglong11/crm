<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\DB;//引入Db为使用事务
use Illuminate\Support\Facades\Redis;
use App\Model\DisModel;
class OrderController extends Controller
{
    /**
     * 处理订单业务
     */
    public function orderDo(Request $request)
    {
        $data = $request->all();
        $tel=$data['tel'];
        $city=$data['city'];
        $address=$data['address'];       // dd($data);
        $mail=$data['email'];
        $goods_id =  $data['goods_id'];
        // dd($goods_id);

        $user_id = 1;
        DB::beginTransaction();//开启事务
        //事务处理
        //事务处理
        try {
            if (empty($data['goods_id'])) {
                throw new \Exception('至少选择一个商品');
            }
            //订单order_master
            //获取订单号
            $order_no = $this->Ordernumber($user_id);
            // dd($order_no);
            echo 'order_no:' . $order_no . '<br>';
            //获取总金额
            // $total = $this->getTotal($good_id, $user_id);
            $data = [
                'order_no' => $order_no,
                'user_id' => $user_id,
                'count_price' => $data['totalPrice'],
                'pay_status' => 0,
            ];

            $table_num = $user_id % 10;  //1
            //dd($table_num);
            //创建主表
            $order_master='shop_order_0'.$table_num;
            $order_id = \DB::table($order_master)->insertGetId($data);
            if (!$order_id) {
                throw new \Exception('主表失败');
            }
            echo 'order_id:' . $order_id . '<br>';
            //子表order_son
            $good_id = explode(',',$goods_id);
            //dd($good_id);
            //获取商家&&商品数据&&购物车数据
            $good1info = $this->getgood($good_id);
            $cartinfo = $this->getgoodCart($good_id , $user_id);
            // dd($cartinfo);
//            //获取购买商品全部商家  =1
            $seller_all = [];
//
            foreach ($good1info as $k => $v) {
                if (!in_array($v['shop_id'], $seller_all)) {
                    $seller_all[] = $v['shop_id'];
                    //$buy_number_price[]
                }
            }
            //dd($seller_all);
//            $redis_order_son_id='order_son_id';
//            $order_son_id=Redis::get($redis_order_son_id);
//            $seller_all=json_decode($order_son_id,true);
           // dd($seller_all);
            //订单子编号
            $num = 1;
            //创建子订单
            //key值为订单号value为商户id
            $order_son_id = [];
            $order_son='shop_order_son_0'.$table_num;
            $order_son_num=  $order_no . '_' . $num;//子订单id
            // dd($order_son_num);
            foreach ($seller_all as $k => $v) {
                // echo $v;
                $data = [
                    'order_id' => $order_id,//主的订单id //分为子订单进行添加
                    'shop_id' => $v,//商户id
                    'order_son_no' =>   $order_son_num,//子订单号
                    'pay_status' => 0,//
                    'create_time' => time(),
                    'user_id'=>1
                ];
                $son_id = \DB::table($order_son)->insertGetId($data);
                if (!$son_id) {
                    throw new \Exception('子表失败');
                }
                // key值为订单号value为商户id
                $order_son_id[$son_id] = $v;
            }
            // dd($order_son_id) ;
            //详情表
            $shop_order_detail='shop_order_detail_0'.$table_num;
            foreach ($order_son_id as $son_id => $seller_id) {
                foreach ( $good1info as $k => $v) {
                    foreach ($cartinfo as $k1 => $v1) {
                        if ($v['goods_id'] == $v1['goods_id']) {
                            if ($seller_id == $v['shop_id']) {
                                $data = [
                                    'o_id' => $son_id,//子订单id
                                    'goods_id' => $v['goods_id'],//商品id
                                    'goods_name' => $v['goods_name'],//商品名称
                                    'buy_number' => $v1['buy_number'],
                                    'goods_price' => $v['goods_price'],
                                    'create_time' => time()
                                ];
                                $res = \DB::table($shop_order_detail)->insert($data);
                                if (!$res) {
                                    throw new \Exception('详情表失败');
                                }
                            }
                        }
                    }

                }
            }
            //地址表
            foreach ($order_son_id as $k => $v) {//根据子订单id
                $data4 = [
                    'o_id' => $k,//子订单id
                    'user_id' => $user_id,
                    'address_id'=>1,//用户收货地址表_id
                    'tel' =>$tel,
                    'city' => $city,
                    'province' => $city,
                    'area'=>$city,//收货的县
                    'address' => $address,//具体收货地址
                    'mail'=>$mail,//邮编
                    'create_time' => time()
                ];
                $order_address='shop_order_address_0'.$table_num;
                $res2 =\DB::table($order_address)->insert($data4);
                if (!$res2) {
                    throw new \Exception('地址表失败');
                }
            }
            //商家结算
            foreach ($order_son_id as $k => $v) {
                $res =  \DB::table($shop_order_detail)->where('o_id', $k)->get()->map(function ($value) {
                    return (array)$value;
                })->toArray();
                //判断有没有折扣

             //dd($res);
                //
                //$money=$discountInfo[''
                if ($res) {
                    $total = 0;

                    $discountInfo = $this->getdiscount($seller_all);
                   // dd($discountInfo);

                    $goods_id=[];
                    foreach($discountInfo as $key=>$val){
                        $goods_id[]=$val['goods_id'];
                    }
                   $goods_id=$goods_id['0'];
                    //dd($goods_id);
                    $money=[];
                    foreach($discountInfo as $key1=>$val1){
                        $money[]=$val1['element'];
                    }
                    $money=$money['0'];
                    $full=[];//获取满赠条件  满5赠1
                    foreach($discountInfo as $key2=>$val2){
                        $full[]=$val2['full'];
                    }
                    $full= $full['0'];
                   // dd($full);
                    $full_num=[];//获取满赠条件  满5赠1
                    foreach($discountInfo as $key3=>$val3){
                        $full_num[]=$val3['full_num'];
                    }
                    $full_num= $full_num['0'];
                   // dd($full_num);
                    $New_buy_num='';
                    foreach ($res as $k1 => $v1) {
                            if($v1['goods_price'] * $v1['buy_number']>100 && $v1['goods_id']==$goods_id && $v1['buy_number']>=$full){//购买钱到优惠价格 购买的商品是否达到满赠满减满折
                                //查询折扣表
                               // echo 111;
                               $total += $v1['goods_price'] *$v1['buy_number']- ($v1['buy_number']*$money);
                             // echo $total;
                                $New_buy_num =$v1['buy_number']+1;
                             //  echo $New_buy_num;
                                $res1=\DB::table($shop_order_detail)->where(['goods_id'=>$v1['goods_id']])->update(['buy_number'=>$New_buy_num]);
                                echo $res1;
                            }else{
                                $total += $v1['goods_price'] * $v1['buy_number'];
                               // echo $total;
                            }

                        }

                    $res =\DB::table($order_son)->where('o_id', $k)->update(['total' => $total]);

                  // dd($res1);
                    if (!$res) {
                        throw new \Exception('商家结算有误');
                    }
                } else {

                    throw new \Exception('商家订单有误');
                }
            }
        } catch (\Exception $e) {

            // 回滚事务
            DB::rollBack();
            //no($e->getMessage());
            $e->getMessage();
        }
    }
    /**
     * 折扣满赠判断有效时间是否过期
     */
    public function getdiscount($shop_id){
        $Disinfo=[];
        $info=DisModel::whereIn('shop_id', $shop_id )->get()->toArray();
        if($info){
            foreach($info as $k=>$v){                                     //过期时间
                if(time()-($v['date_name2'])<0){//当前时间-（添加时间+有效时间）<0
                    $Disinfo[]=$v;
                }
            }
        }
        return  $Disinfo;

    }
    /**
     * 订单号生成
     */
    public function Ordernumber($user_id)
    {
        return date('Ymdhis') . $user_id . rand(1000, 9999);
    }
    //获取商品信息
    public function getgood($goods_id )
    {
    // dd($goods_id) ;
        $goodinfo = GoodsModel::whereIn('goods_id', $goods_id )->get()->toArray();
        return $goodinfo;
    }
    //获取购物车数（指定用户指定good_id）
    public function getgoodCart($good_id , $user_id)
    {
        $where=[
            'user_id'=>$user_id,
            //'goods_id'=>$goods_id
        ];
        $cartinfo = CartModel::where($where )->whereIn('goods_id', $good_id)->get()->toArray();;
        return $cartinfo;
    }
    //获取购买商品价格
    public function buy_number_price($good_id,$seller_all){

        $buy_number_price = GoodsModel::where('goods_id', $good_id)->whereIn('shop_id',$seller_all )->get()->toArray();
        return $buy_number_price;
    }
    /**
     * 获取各个表中最大id
     */
    public function max_id(){
        $insert_id=\DB::table('user_id_auto')->insertGetId(['id'=>null]);
          $insert_id=$insert_id+1;
          $table_num='shop_order_0'.($insert_id%10);
           return $table_num;

    }





    /**
     * 后台商家订单展示
     *
     */

    public function admin_goods_show_order(){
        //查询商户商品订单展示
        $user_id=1;
        $shop_id=session('shop_id');
        //定位表
        $table_num = $user_id % 10;  //1
        $order_son='shop_order_son_0'.$table_num;

        $res =\DB::table($order_son)->where(['shop_id'=>$shop_id])->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
     //  dd($res);
        return view('goods/order',compact('res'));


    }

/**
 * 提交订单
 */
public  function submitOrder(){
    //echo 111;
    //模拟要提交的数据
    $arr=[1,2];
    #创建订单
    /**
     * 0、判断库存（购买的商品数量有没有超过库存）
     * 1、生成订单主表数据
     * 2、写入订单主表数据 根据用户id进行分表
     * 3、根据商家id进行拆分  （有几个商家分成几个子订单，数据写入子订单I表）
     * 4、根据订单子表数据，写入订单详情表
     * 5、根据不同的商家写入收货地址表
     * 6、减少库存
     */
    #查询购物车的数据
$cateinfo=\DB::table('shop_cart')->whereIn('cart_id',$arr)->get()->map(function ($value) {
         return (array)$value;
   })->toArray();
  //dd($cateinfo);

    #检测商品是否超过库存 库存判断
    foreach ($cateinfo as $k=>$v){
       $result= $this-> checkGoodsStock($v['goods_id'],$v['buy_number']);
       // echo $result;
        if($result['status']!=10000){//ok可以通过
            return ['data'=>'商品库存不足'];
        }
    }
    //生成随机订单号进行如主订单表
   echo 2222;


}

    /**
     * 判断商品库存
     */
 public  function checkGoodsStock($goods_id,$buy_number){
      #判断库存 查询数据库查询商品库存 进行判断库存
      $GoodsInfo=GoodsModel::where(['goods_id'=>$goods_id])->first()->toArray();
        //var_dump($GoodsInfo);
         if($GoodsInfo['goods_stock']>=$buy_number){
            // echo 111;
             return ['status'=>10000, 'msg'=>'success'];
         }else{
        // echo 222;
     }
      //
  }

    /**
     * @param Request $request
     * 使用session开启和设置值
     */
    public function session_id(Request $request){
        session_start();
        $sid= session_id();//获取session_id 唯一的
        //dd($sid);
        session_start();
        session_id($sid);  //先开启session 设置session_id 键
        $text1='111';
        $_SESSION['code']=$text1;

        session_id($sid);
        session_start();//通过session_id唯一键的 开启session_id 获取他设置的值
         $text1=$_SESSION['code'];


    }
    public function session_id1(){
        $user_id=1;
        $goods_id='1,3';
        $good_id = explode(',',$goods_id);
        //dd($good_id);
        //获取商家&&商品数据&&购物车数据
        $goodinfo = $goodinfo = GoodsModel::whereIn('goods_id', $good_id )->get()->toArray();
       //dd($goodinfo);
        //获取购买商品全部商家  =1
        $seller_all = [];

        foreach ($goodinfo as $k => $v) {
            if (!in_array($v['shop_id'], $seller_all)) {
                $seller_all[] = $v['shop_id'];
                //$buy_number_price[]
            }
        }
        //订单子编号
        $num = 1;
        $table_num=1;
        //创建子订单
        //key值为订单号value为商户id
        $order_son_id = [];
        $order_son='shop_order_son_0'.$table_num;
        /**
         * 订单号生成
         */
        $order_no=date('Ymdhis') . $user_id . rand(1000, 9999);
        $order_son_num=  $order_no . '_' . $num;//子订单id
        //$redis_key='order_id';
        //从redis取出order_id 来
        $order_id=1;
        // dd($order_son_num);
        foreach ($seller_all as $k => $v) {
            // echo $v;
            $data = [
                'order_id' => $order_id,//主的订单id //分为子订单进行添加
                'shop_id' => $v,//商户id
                'order_son_no' =>   $order_son_num,//子订单号
                'pay_status' => 0,//
                'create_time' => time(),
                'user_id'=>1
            ];
            $son_id = \DB::table($order_son)->insertGetId($data);
           // dd($son_id);
            if (!$son_id) {
                throw new \Exception('子表失败');
            }
            // key值为订单号value为商户id
            $order_son_id[$son_id] = $v;
        }
        //把值表数据存入redis中
        $redis_order_son_id='order_son_id';
        $order_son_id=json_encode($order_son_id);
        $order_value=Redis::set($redis_order_son_id, $order_son_id);
          $data=Redis::get('order_son_id');
           $data=json_decode($data,true);
          //  dd($data);




    }
    public function getgood1($goods_id )
    {
        // dd($goods_id) ;
        $goodinfo = GoodsModel::whereIn('goods_id', $goods_id )->get()->toArray();
        return $goodinfo;
    }




}
