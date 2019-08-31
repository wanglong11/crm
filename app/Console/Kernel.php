<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        #查询最近一分钟创建的订单，去order_user表中查询创建的订单，在按照商户id进行写入
        $schedule->call(function () {
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
        })->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
