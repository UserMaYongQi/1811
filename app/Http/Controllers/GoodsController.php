<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGoodsPost;
use DB;
class GoodsController extends Controller
{
    public function zu()
    {
        $email=request()->email;
        $password=request()->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            dump(Auth::user(),Auth::id(),Auth::attempt(['email' => $email, 'password' => $password]));
            echo '登陆成功';
            // 认证通过...
            // return redirect()->intended('dashboard');
        }else{
            echo '登陆失败';
        }
    }

    public function email()
    {
        $email=request()->email;
        $this->sendemail($email);
    }

    public function sendemail($email)
    {

       $res=\Mail::send('email',['name'=>$email],function($message)use($email){
            //设置主题
            $message->subject('欢迎注册');
            //设置接收方
            $message->to($email);
        });
       if($res==''){
            echo '发送成功'; 
       }
       // \Mail::raw('23333',function($message)use($email){

       //      //设置主题
       //      $message->subject('欢迎注册');
       //      //设置接收方
       //      $message->to($email);
       //  });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords=request()->keywords;
        $where=[];
        if($keywords){
            $where=[
                ['goods_name','like',"%$keywords%"]
            ];
        }
        $pagesize=config('app.pageSize');
        $data=Db::table('goods')->where($where)->paginate($pagesize);
        

        return view('goods.index',['data'=>$data,'keywords'=>$keywords]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {

        $data=$request->except('_token');
        //图片上传
        if($request->hasFile('goods_file')){
            $res=$this->uplode('goods_file');
            if($res){
                $data['goods_file']=$res['imgurl'];
            }
        }
        $info=Db::table('goods')->insert($data);
        if($info){
            return redirect('/goods/index');
        }
    }


    public function uplode($file)
    {   
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            $store_result = $photo->store(date('Ymd'));
            // dd($store_result);
            //$store_result = $photo->storeAs('photo', 'test.jpg');
            return ['code'=>1,'imgurl'=>$store_result];
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
