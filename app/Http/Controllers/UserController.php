<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use DB;
use App\Http\Requests\StoreUserPost;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $name=request()->session()->get('uid');
        // dd($name);
        //取出session信息
        // request()->session()->get('uid');
        // request()->session()->forget('uid');
        // dd($name);
        //接收搜索条件
        $user_name=request()->user_name;
        
        
        // dump($user_name);
        $where=[];
        if(isset($user_name)){
            $where=[
                ['user_name','like',"%$user_name%"]
            ];
        }
        $data=Users::where($where)->paginate(2);
        return view('user.index',['data'=>$data,'user_name'=>$user_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session(['uid'=>10]);
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        
        //接收post请求
        $data=request()->except('_token');
        // dd($data);
        $data['created_at']=time();
        $res=Users::insert($data);
        if($res){
            echo json_encode(['content'=>'添加成功','icon'=>1]);
        }else{
            echo json_encode(['content'=>'errors','icon'=>2]);
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
