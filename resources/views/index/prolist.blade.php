@include('public/top')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     
      <img id="goods_file" src="{{config('app.img_url')}}{{$data->goods_file}}" />
      
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th>
       	<strong class="orange" id="price">{{$data->goods_price}}</strong>
       </th>
       <td>
       <div class="des_join">
                <div class="j_nums">
                  	<input type="hidden" id="goods_num" value="{{$data->goods_kc}}">

                    <input type="button" id="add" value="-" class="n_btn_1" />
                    <input type="text" value="1" id="buy_number"   class="n_ipt" />
                    <input type="button" id="less" value="+" class="n_btn_2" />   
                </div>
                
                <input type="hidden" id="goods_id" value="{{$data->goods_id}}">
            </div>  
       </td>
      </tr>
      <tr>
       <td>
        <strong id="goods_name">{{$data->goods_name}}</strong>
        <p class="hui">{{$data->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur">
      	<a href="javascript:;">{{$data->goods_gg}}</a>
      </li>
      
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{config('app.img_url')}}{{$data->goods_file}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id="addCart">加入购物车</a></td>
      </tr>
     </table>
     	<div width="300" height="200">
     		<div>用户评论</div>
			@foreach($da as $v)
			<i class="o">
			<p>{{$v->p_email}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      {{$v->p_exp}}星</p>
			
			<p>{{$v->p_content}}</p>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date('Y-m-d H:i:s',$v->p_time)}}</p>
			<hr/>
		</i>
			@endforeach
     	</div><hr/>
    	<form>
    		<table width="300" height="200">
    			<p>用户名：<input type="text" name="p_name" id="p_name"></p>
    			<p>E-mail：<input type="email" name="p_email" id="p_email"></p>
    			<p>评价等级：<input type="radio" name="p_exp" class="p_exp" value="1">1级
			    			<input type="radio" name="p_exp" class="p_exp" value="2">2级
			    			<input type="radio" name="p_exp" class="p_exp" value="3">3级
			    			<input type="radio" name="p_exp" class="p_exp" value="4">4级
			    			<input type="radio" name="p_exp" class="p_exp" value="5" checked>5级
			    </p>
			    <p>评论内容：<textarea name="p_content" id="p_content" cols="40" rows="5"></textarea></p>
			    <p><input type="hidden" goods_id="goods_id" value="{{$data->goods_id}}"></p>
			    <p><input type="button" id="btn" value="提交评论"></p>
    		</table>
    	</form>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <script src="/index/js/jquery.spinner.js"></script>
  
  </body>
</html>
<script>
	// $('.spinnerExample').spinner({});
    //点击+号
      $('#less').click(function(){
            var goods_num =$('#goods_num').val();
            // var buy_number=$('#buy_number').val()
            // console.log(goods_num);
            // console.log(buy_number);
            var buy_number=parseInt($('#buy_number').val());
            
            // console.log(price);
            // console.log(buy_number);
                if(buy_number>=goods_num){
                    $('#buy_number').val(goods_num);
                    //+号失效
                    $(this).prop('disabled',true);
                }else{
                     buy_number=buy_number+1;
                    $('#buy_number').val(buy_number);


                    //-号生效
                    $(this).next('input').prop('disabled',false);
                }
            	var goods_price=$('#price').text();
            	var goods_id=$('#goods_id').val();

            	$.ajaxSetup({
              	 	headers: {
               		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               		}
          		});
                $.ajax({
                	url: '/price',
                	type: 'POST',
                	dataType: 'json',
                	async:false,
                	data: {goods_price:goods_price,buy_number:buy_number,goods_id:goods_id},
                	success:function(res){
                		$('.orange').text(res.goods_price);
                	}
                })       
        });


        //点击-号
        $('#add').click(function(){
           
           
            var buy_number=parseInt($('#buy_number').val());
            //console.log(buy_number);
                if(buy_number<=1){
                    $('#buy_number').val(1);
                    //-号失效
                    $(this).prop('disabled',true);
                }else{
                     buy_number=buy_number-1;
                    $('#buy_number').val(buy_number);
                    //+号生效
                    $(this).prev('input').prop('disabled',false);
                }
                var goods_price=$('#price').text();
            	$.ajaxSetup({
              	 	headers: {
               		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               		}
          		});
                $.ajax({
                	url: '/price',
                	type: 'POST',
                	dataType: 'json',
                	async:false,
                	data: {goods_price:goods_price,buy_number:buy_number},
                	success:function(res){
                		$('#price').text(res.price);
                	}
                }) 
        });


        //失去焦点
        $('#buy_number').blur(function(){
            var _this=$(this);
            var buy_number=_this.val();
            var goods_num=$('#goods_num').val();
            var reg=/^\d+$/;


            if(buy_number==''||buy_number<=1||!reg.test(buy_number)){
                _this.val(1);
            }else if(buy_number>=goods_num){
                _this.val(goods_num);
            }else{
                buy_number=parseInt(buy_number);
                _this.val(buy_number);
            }
        });


        $('#addCart').click(function(){
            // alert(111);
            //获取商品id
            var goods_id=$('#goods_id').val();
            // console.log(goods_id);
            var goods_file=$('#goods_file').prop('src');
            // console.log(goods_file);
            // return false;
            var goods_name=$('#goods_name').text();

            //获取购买数量
            var buy_number=$('#buy_number').val();
            //alert(buy_number);
            var goods_price=$('#price').text();
            $.ajaxSetup({
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          	});
           $.post(
                "/cart",
                {goods_id:goods_id,buy_number:buy_number,goods_name:goods_name,goods_price:goods_price,goods_file:goods_file},
                function(res){                  
                        if(res.code==1){
                          alert('加入成功');
                            location.href="/cartIndex";
                        }else{
                          alert('加入失败');
                          location.href="/prolist?goods_id="+goods_id;
                        }                 
                },
                'json'
            );
        });


		//点击提交评论
		$('#btn').click(function(){
			var p_name=$('#p_name').val();
			if(p_name==''){
				p_name='匿名用户';

			}

			var p_email=$('#p_email').val();
			var reg=/^\d{5,10}@qq.com$/;
			if(p_email==''){
				alert('邮箱不能为空');
				return false;
			}
			if(!reg.test(p_email)){
				alert('邮箱格式错误');
				return false;
			}

			var p_content=$('#p_content').val();
			if(p_content==''){
				alert('评论不能为空');
				return false;
			}

			var p_exp=$('.p_exp:checked').val();

			var goods_id=$(this).parent('p').prev('p').children('input').val();
			

			$.ajaxSetup({
			 headers: {
			 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 }
			});
			$.post(
				"/content",
				{p_name:p_name,p_email:p_email,p_exp:p_exp,p_content:p_content,goods_id:goods_id},
				function(res){
					
				var _html="<i><p>"+res.info.p_email+"</p><p>"+res.info.p_exp+"</p><p>"+res.info.p_content+"</p><p>"+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+res.info.p_time+"</p></i></br>";
				$('.o').html(_html);
						// alert(res.content);
					
				},
				'json'
				)


		})

	</script>