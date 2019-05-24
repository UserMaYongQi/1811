<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Userss;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 11;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($fd);
        // $users_name=$_POST['users_name'];
        // $users_sex=$_POST['users_sex'];
        $data = request()->all();
      
        if ($request->hasFile('users_file')){
            $res=$this->uplode('users_file');
            // dd($res);
            if($res['icon']==1){
                $data['users_file']=$res['img_url'];
                // dd($users_file);
            }
        }

        // print_r($data);die;
        // dd($users_name,$users_sex,$users_file);
        // $date=[$fd,$users_file];
        // dd($date);
        $data=Userss::create($data);
        dd($data);
    }

    public function uplode($file)
    {
        // dd($file);
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            // dd($photo);
            $store_result = $photo->store(date("Ymd"));
            // dd($store_result);
            return ['icon'=>1,'img_url'=>$store_result];
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

    public function check()
    {
        $name=request()->name;
        $data=Db::table('userss')->where('users_name',$name)->first();
        if($data!==null){
            return ['content'=>'用户名已经存在','icon'=>1];
        }
    }
}
