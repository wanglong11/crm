<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        #查询最近一分钟创建的订单，去order_user表中查询创建的订单，在按照商户id进行写入

            $user_id=1;
            $goods_id='1,2';
            $good_id = explode(',',$goods_id);
            //dd($good_id);
            //获取商家&&商品数据&&购物车数据
            $good1info = GoodsModel::whereIn('goods_id', $goods_id )->get()->toArray();
            //获取购买商品全部商家  =1
            $seller_all = [];

            foreach ($good1info as $k => $v) {
                if (!in_array($v['shop_id'], $seller_all)) {
                    $seller_all[] = $v['shop_id'];
                    //$buy_number_price[]
                }
            }
        //把值表数据存入redis中
        $redis_order_son_id='order_son_id';
        //把值表数据存入redis中
        $redis_order_son_id='order_son_id';
        $order_son_id=json_encode($seller_all);
        $order_value=Redis::set($redis_order_son_id, $order_son_id);
//            //订单子编号
//            $num = 1;
//            $table_num=1;
//            //创建子订单
//            //key值为订单号value为商户id
//            $order_son_id = [];
//            $order_son='shop_order_son_0'.$table_num;
//            /**
//             * 订单号生成
//             */
//            $order_no=date('Ymdhis') . $user_id . rand(1000, 9999);
//            $order_son_num=  $order_no . '_' . $num;//子订单id
//            $redis_key='order_id';
//            //从redis取出order_id 来
//            $order_id=Redis::get( $redis_key);
//            // dd($order_son_num);
//            foreach ($seller_all as $k => $v) {
//                // echo $v;
//                $data = [
//                    'order_id' => $order_id,//主的订单id //分为子订单进行添加
//                    'shop_id' => $v,//商户id
//                    'order_son_no' =>   $order_son_num,//子订单号
//                    'pay_status' => 0,//
//                    'create_time' => time(),
//                    'user_id'=>1
//                ];
//                $son_id = \DB::table($order_son)->insertGetId($data);
//                if (!$son_id) {
//                    throw new \Exception('子表失败');
//                }
//                // key值为订单号value为商户id
//                $order_son_id[$son_id] = $v;
//            }
            //把值表数据存入redis中
            $redis_order_son_id='order_son_id';
            $order_value=Redis::set($redis_order_son_id, $order_son_id);





    }
}
