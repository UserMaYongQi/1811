<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hold;
use App\Http\Requests\StoreHoldPost;
use DB;
class HoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //数据库中读取数据
        $data=Hold::paginate(2);
        return view('hold.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Hold/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoldPost $request)
    {
        //接收值
        $data=request()->input();
        // dd($data);
        // $data['hold_create']=time();
        $res=Hold::insert($data);
        if($res){
            echo json_encode(['content'=>'添加成功','icon'=>1]);
        }else{
            echo json_encode(['content'=>'添加失败','icon'=>2]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        echo 44;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        echo 55;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        echo 66;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        echo 77;
    }
}
