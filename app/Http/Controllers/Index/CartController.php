<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    public function cart()
    {
    	//接收购买数量和商品id
    	$data=request()->all();
    	// dd($data);
    	//判断是否登陆
    	$u_id=request()->session()->get('goods_id');
    	if(empty($u_id)){
    		//未登录
    		echo 1;
    	}else{
    		//已登陆,判断之前是否加入过同样的商品id，如果有进行累加，否则添加
    		$info=Db::table('good')->where('goods_id',$data['goods_id'])->first();
    		if($info==null){
    			//添加
    			$goods_price=$data['goods_price']*$data['buy_number'];
    			$data['goods_price']=$goods_price;
    			// dd($data);
    			$data['goods_time']=time();
    			// dd($data);
    			$res=Db::table('good')->insert($data);
    			// dd($res);
    			if($res){
    				return ['code'=>1];
    			}
    		}else{
    			// dd($data);
    			//累加,判断是否有同样的goods——id；
    			$res=Db::table('good')->where('goods_id',$data['goods_id'])->first();
    			$buy_numbe=$res->buy_number+$data['buy_number'];
    			
    			$buy_number['buy_number']=$buy_numbe;
    			$buy_number['goods_price']=$buy_number['buy_number']*$data['goods_price'];
    			$buy_number['goods_file']=$data['goods_file'];

    			// dd($buy_number);
    			$buy_number['goods_time']=time();
    			$info=Db::table('good')->where('goods_id',$data['goods_id'])->update($buy_number);
    			if($info){
    				return ['code'=>1];
    			}
       		}
    	}	
    }


    //购物车列表页
    public function cartIndex()
    {
    	$user_id=session('user_id');

    	$data=Db::table('good')->join('goods', 'good.goods_id', '=', 'goods.goods_id')->where('user_id',$user_id)->get();
    	$count=Db::table('good')->where('user_id',$user_id)->count();
    	// dd($count);
    	// dd($res);
    	// dd($data);
    	return view('index/cartIndex',['data'=>$data,'count'=>$count]);
    	
    }

    
    public function price()
    {
    	// dd(1);
    	// $data=request()->all();
    	// // dd($data);
    	
    	// // return $info;
    	// $res=Db::table('goods')->where('goods_id',$data['goods_id'])->first();
    	// // dd($res);
    	// $info=$data['goods_price']*$data['buy_number'];
    	// $coun=0;
     //    //总价
     //    $coun+=$res->goods_price*$data['buy_number'];
     //    $count['goods_price']=$coun;
     //    // dd($count);
     //    $info=Db::table('goods')->where('goods_price',$res->goods_price)->update($count);
    	// $ress=Db::table('goods')->where('goods_price',$data['goods_price'])->first();

     //    // dd($info);
     //    // dd($count); 
    	// // dd($res);
    	// // $count=0;
    	// // foreach ($res as $k => $v) {
    		
     // //        $count+=$v->goods_price*$data['buy_number'];
        
    	// // }
    	// // dd($count);
    	// // $info=$data['buy_number']*$data['goods_price'];
    	// return $ress['goods_price'];
    }
    
    //点击+号改变数量
    public function changeNumber()
    {
    	$goods_id = request()->goods_id;
    	$buy_number = request()->buy_number;
    	if($buy_number<1){
       		return '至少购买一件商品';
      	}
      	$user_id = session('user_id');
      	 $cartwhere=[
          ['user_id','=',$user_id],
          ['goods_id','=',$goods_id]
        ];
        $res=Db::table('good')->where($cartwhere)->update(['buy_number'=>$buy_number]);
        if($res){
        	return ['code'=>1,'content'=>'修改成功'];
        }else{
        	return ['code'=>2,'content'=>'修改失败'];
        }
    }
    	
    //计算总价
    public function getCount()
    {
    	$goods_id=request()->goods_id;
    	$user_id=session('user_id');
    	//获取购买数量，商品价格
    	$where['user_id']=$user_id;
    	$info = DB::table('good')->where($where)->join('goods', 'good.goods_id', '=', 'goods.goods_id')->whereIn('good.goods_id',$goods_id)->get();
    	// dd($info);
    	$count=0;
    	foreach($info as $k=>$v){
            $count+=$v->goods_price*$v->buy_number;
        }
        if($count==0){
        	return 0;
        }else{
        	return $count;
        }
    }


    // //结算页面
    // public function pay()
    // {
    // 	$user_id=session('user_id');
    // 	$where['user_id']=$user_id;
    // 	$data = DB::table('good')->where($where)->get();
    // 	// $data=Db::table('good')->where('user_id',$user_id)->get();
    // 	// dd($data);
    // 	$count=0;
    // 	foreach ($data as $k => $v) {
    // 		$count+=$v->goods_price*$v->buy_number;
    // 	}
    // 	// dd($count);
    // 	return view('index/pay',['data'=>$data,'count'=>$count]);
    // }


    //订单
    public function dingdan($goods_id)
    {
        $goods_id=explode(',',$goods_id);
        // dd($goods_id);
        $user_id=session('user_id');
        $data=Db::table('good')->whereIn('good.goods_id',$goods_id)->where('user_id',$user_id)->join('goods','good.goods_id','=','goods.goods_id')->get();
        // dd($data);
        $count=0;
        foreach($data as $k=>$v){
            $count+=$v->buy_number*$v->goods_price;
        }
        $info=DB::table('dz')->orderBy('w_time','desc')->first();
        // dd($info);
        $res=DB::table('area')->where("id","$info->w_s")->first();
        $res1=DB::table('area')->where("id","$info->w_sh")->first();
        $res2=DB::table('area')->where("id","$info->w_q")->first();
        // dd($res);
        return view('index/pay',['data'=>$data,'count'=>$count,'info'=>$info,'res'=>$res,'res1'=>$res1,'res2'=>$res2]);
    }


    //配送地址页面
    public function address()
    {
    	$data=Db::table('area')->get();
    	$data=$this->san($data);
    	// dd($data);
    	return view('index/address',['data'=>$data]);
    }


    //三级联动
    public function san($data,$pid=0)
    {
    	foreach ($data as $k => $v) {
    		static $arr=[];
    		if($v->pid==$pid){
    			$arr[]=$v;
    		}
    	}
    	return $arr;
    }

    //市
    public function city()
    {
    	$id=request()->id;
    	// dd($id);
    	$data=DB::table('area')->where('pid',$id)->get();
    	// dd($data);
    	return $data;
    }
    public function content()
    {
    	//接收ajax表单数据
    	$data=request()->all();
    	$data['p_time']=time();
    	$res=Db::table('content')->insert($data);
    	$info=DB::table('content')->where('goods_id',$data['goods_id'])->orderby('p_time','desc')->first();
    	$info->p_time=date('Y-m-d H:i:s',time());
    	//dd($info->p_time);
// {{date('Y-m-d H:i:s',time())}}
    	if($res){
    		return ['icon'=>1,'content'=>'发表评论成功','info'=>$info];
    	}else{
    		return ['icon'=>2,'content'=>'发表评论失败'];
    	}
    }

    public function dz()
    {
    	$data=request()->all();
    	$data['w_time']=time();
    	// dd($data);
    	$info=Db::table('dz')->insert($data);
    	if($info){
    		return redirect('address');
    	}
    }


    public function success()
    {


    	$user_id=session('user_id');
    	$data=Db::table('dd')->where('user_id',$user_id)->orderBy('time','desc')->first();
    	// dd($data);
    	return view('index/success',['data'=>$data]);
    }


    //订单
    public function dd()
    {
    	$data=request()->all();
    	$data['rand']=time().rand(999,9999);
    	$data['time']=time();
    	$info=Db::table('dd')->insert($data);
    	if($info){
    		return ['icon'=>1,'content'=>'下单成功'];
    	}
    }


    public function zhifu()
    {
    	$user_id=session('user_id');
    	if(empty($user_id)){
    		return redirect('/login');
    	}else{
    		return view('index/succe');
    	}
    }



    //pc端支付
    public function pcpay()
    {
    	
    	$config=config('pay');
    	

		require_once app_path('libs\alipay\pagepay\service\AlipayTradeService.php');
		require_once app_path('libs\alipay\pagepay\buildermodel\AlipayTradePagePayContentBuilder.php');

		    //商户订单号，商户网站订单系统中唯一订单号，必填
		    $out_trade_no = trim($_POST['WIDout_trade_no']);

		    //订单名称，必填
		    $subject = trim($_POST['WIDsubject']);

		    //付款金额，必填
		    $total_amount = trim($_POST['WIDtotal_amount']);

		    //商品描述，可空
		    $body = trim($_POST['WIDbody']);

			//构造参数
			$payRequestBuilder = new AlipayTradePagePayContentBuilder();
			$payRequestBuilder->setBody($body);
			$payRequestBuilder->setSubject($subject);
			$payRequestBuilder->setTotalAmount($total_amount);
			$payRequestBuilder->setOutTradeNo($out_trade_no);

			$aop = new AlipayTradeService($config);

			/**
			 * pagePay 电脑网站支付请求
			 * @param $builder 业务参数，使用buildmodel中的对象生成。
			 * @param $return_url 同步跳转地址，公网可以访问
			 * @param $notify_url 异步通知地址，公网可以访问
			 * @return $response 支付宝返回的信息
		 	*/
			$response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

			//输出表单
			var_dump($response);
		    }
		 

		 	//移动端支付
		 	public function telpay()
 	{
 		
 	}

}
