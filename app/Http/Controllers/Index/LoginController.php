<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cache;
class LoginController extends Controller
{
    public function Login()
    {
    	$data=request()->except('_token');
    	$email=$data['email'];
    	// $pwd=$data['pwd'];
    	// dd($pwd);
    	if(empty($email)){
    		return redirect('/login');
    	}else{
    		$res=Db::table('vip')->where('email',$email)->first();
    		// dd($res);
    		if(!$res){
    			return redirect('/login');
    		}
    		$pwd=md5($data['pwd']);
    		$res1=Db::table('vip')->where('pwd',$pwd)->first();
    		// dd($res1);
    		if($res1!=null){
    			$goods_id=session(['goods_id'=>$res->u_id]);
    			$user_id=session(['user_id'=>$res->user_id]);
    			// dd($goods_id);
    			return redirect('/');
    		}else{
    			return redirect('/login');
    		}
    	}
    }

    //用户退出
    public function tc()
    {
    	$email=request()->session()->forget('goods_id');
    	$user_id=request()->session()->forget('user_id');
    	return redirect('/login');
    }


    //用户详情
    public function user()
    {
    	return view('index/user');
    }
    //商品详情
    public function prolist($goods_id)
    {
    	// Cache::flush();
    	$data=cache('data_'.$goods_id);
    	
    	if(!$data){
    		// echo 112;
    		$data=Db::table('goods')->where('goods_id',$goods_id)->first();
    		cache(['data_'.$goods_id=>$data],12*60);
    	}

    	$da=Db::table('content')->where('goods_id',$goods_id)->orderBy('p_time','desc')->get();
    	
    	// dd($data);
    	return view('index/prolist',['data'=>$data,'da'=>$da]);
    }



    public function proinfo()
    {
    	$data=Db::table('goods')->get();
    	return view('index/proinfo',['data'=>$data]);
    }


    public function desc()
    {
    	$data=request()->fd;
    	if($data=='库存'){
    		$res=Db::table('goods')->orderBy('goods_kc','desc')->get();
    		// dd($res);
    		return $res;
    	}
    }
}
