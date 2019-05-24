@include('public.top')
<script src="{{asset('js/jquery.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="dingdanlist" >
      <table>
       <tr onClick="window.location.href='/address'">
        <td class="dingimg" width="75%" colspan="2">新增收货地址</td>
		
        <td align="right"><img src="/index/images/jian-new.png" /></td>
		
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       
       <!-- <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr> -->
       <!-- <tr> -->
       <td id="xq">@if ($info!=''){{$res->name}}{{$res1->name}}{{$res2->name}}{{$info->w_w}}{{$info->w_name}}{{$info->w_tel}} @else ('请先登陆') @endif</td>
        <tr>
        <td width="75%" colspan="2">支付方式</td>
        <td align="right">
            <select name="pay" id="pay">
              <option value="支付宝">支付宝</option>
              <option value="微信">微信</option>
              <option value="银行卡">银行卡</option>
            </select>
        </td>
          
       </tr>
       <!-- </tr> -->
       <!-- <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr> -->
       
       
       
       
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>

       
	@foreach($data as $v)
       <tr class="tt" goods_id="{{$v->goods_id}}">
        <td class="dingimg" width="15%"><img src="{{config('app.img_url')}}{{$v->goods_file}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->goods_time)}}</time>
        </td>
        <td align="right"><span class="qingdan">{{$v->buy_number}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
    @endforeach
      </table>
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="oranges">¥{{$count}}</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--jq加减-->
    <script src="js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script>
	$('.jiesuan').click(function(){
		//用户详情
		var user=$('#xq').text();
		//支付详情
		var pay=$('#pay').val();
		//总计
		var count=$('.oranges').text();
		//商品id
		// var goods_id=$('.tt').attr('goods_id');
		// alert(goods_id);
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});

		$.post(
			'/dd', 
			{user:user,pay:pay,count:count},
			 function(res) {
				if(res.icon==1){
					alert(res.content);
					location.href="/success";
				}
			},
			'json'
		);
	})
</script>