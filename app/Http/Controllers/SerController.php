<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreAdsPost;
use App\Http\Requests\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**展示*/
    public function index(Request $request)
    {
        $data=DB::table('serve')->paginate(3);
       return view('ser/clientAdd',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service()
    {
        //客户服务管理展示
        return view('ser/service');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**添加*/
    public function serdo (Request $request)
    {
        $data=$request->all();
        //dd($data);
        unset($data['_token']);
     //dd($data);
       $res=DB::table('serve')->insert($data);


        if($res){
            return redirect('client/lists')->with('status', '添加成功');
            }else{

            }


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**删除*/
    public function del(Request $request){
        $id=$request->input('id');
        //dd($id);
        $where=[
            'id'=>$id,
        ];
        $res=DB::table('serve')->where($where)->delete();
        //dd($res);
        if($res){
            return redirect('client/lists')->with('sta', '删除成功');
        }else{

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**修改页面*/
    public function update(Request $request)
    {
      $id=$request->input('id');
        //dd($id);
        $where=[
            'id'=>$id,
        ];
        $data=DB::table('serve')->where($where)->get();
        //dd($data);
        return view('ser/updateDo',compact('data'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/**修改执行*/
    public function updateDo(Request $request)
    {
        $data=$request->all();
        //dd($data);
        unset($data['_token']);
        //$res=$res->where('ads_id',$data['ads_id'])->update($data);
        $data=DB::table('serve')->where('id',$data['id'])->update($data);
        //dd($data);
        if($data){
            return redirect('client/lists')->with('update', '修改成功');
        }else{

        }



        //
    }
}
