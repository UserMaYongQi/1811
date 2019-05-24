<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    public function index()
    {
    	$u_id=request()->session()->get('goods_id');
    	// dd($u_id);
    	if(!empty($u_id)){
    		$res=Db::table('vip')->where('u_id',$u_id)->first();
    		// dd($res);
    		$email=$res->email;
    		// dd($email);
    	}else{
    		$email='还未登陆';
    	}
    	$data=Db::table('goods')->get();
    	return view('index/index',['data'=>$data,'email'=>$email]);
    }

    //注册页面
    public function reg()
    {
    	return view('index/reg');
    }

    //注册页面
    public function login()
    {
    	return view('index/login');
    }

    //验证邮箱唯一性
    public function check()
    {
    	$email=request()->email;
    	
    	$data=Db::table('vip')->where('email',$email)->count();
    	// dd($data);
    	if($data){
    		return ['icon'=>1,'content'=>'该邮箱或手机号已经存在'];
    	}
    }
    //区分邮箱还是手机号
    public function qf()
    {
    	$email=request()->email;
    	// dd($email);
    	if(strpos($email,'@')){
    		//邮箱
    		$res=$this->regs();
    		echo json_encode(['icon'=>$res['code'],'content'=>$res['content']]);
    	}else{
    		//手机
    		$res=$this->shouji($email);
    		echo json_encode(['icon'=>1,'content'=>'短信已发送，请注意查收']);
    	}
    }
    	

    //邮件发送验证码
    public function regs()
    {
    	$email=request()->email;
    	$data=rand(1000,9999);
    	 \Mail::raw("$data" ,function($message)use($email){
        //设置主题
            $message->subject("欢迎注册滕浩有限公司");
        //设置接收方
            $message->to($email);
        });
    	session(['data'=>$data]);
    	return ['code'=>1,'content'=>'验证码已经发送'];
    }

    //手机号发送验证码
    public function shouji($email)
    {
    	$data=rand(1000,9999);
    	$host = "http://dingxin.market.alicloudapi.com";
	    $path = "/dx/sendSms";
	    $method = "POST";
	    $appcode = "05b6db55af8146dd9cc1c61dee001886";
	    $headers = array();
	    array_push($headers, "Authorization:APPCODE " . $appcode);
	    $querys = "mobile=$email&param=code%3A$data&tpl_id=TP1711063";
	    $bodys = "";
	    $url = $host . $path . "?" . $querys;

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl, CURLOPT_FAILONERROR, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HEADER, false);
	    if (1 == strpos("$".$host, "https://"))
	    {
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    }
	    session(['data'=>$data]);
	    return curl_exec($curl);
    }


    //注册用户
    public function store()
    {
    	$data=request()->all();
    	// dd($data);
    	$code=request()->session()->get('data');
    	// dd($code);
    	if($data['code']!=$code){
    		return ['icon'=>1,'content'=>'验证码不正确'];
    	}
    	$data['created_at']=time();
    	$data['pwd']=md5($data['pwd']);
    	//进行添加
    	$res=Db::table('vip')->insert($data);
    	if($res){
    		return ['icon'=>2,'content'=>'添加成功'];
    	}
    }
}
