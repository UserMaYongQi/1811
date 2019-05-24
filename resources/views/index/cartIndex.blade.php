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
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
    
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" id="allbox"/> 全选</a></td>
       </tr>
       
     
     
	@foreach($data as $v)
	<div class="dingdanlist">
      <table>
       <tr goods_num="{{$v->goods_kc}}" goods_id="{{$v->goods_id}}">
        <td width="4%">
        	<input type="checkbox" class="box" name="1" />
        </td>
        <td class="dingimg" width="15%"><img src="{{config('app.img_url')}}{{$v->goods_file}}" /></td>
        <td width="50%">
        <h3>{{$v->goods_name}}</h3>
        <time>下单时间：{{date('Y-m-d H:i:s',$v->goods_time)}}</time>
        </td>
        <div class="des_join">
                <div class="j_nums">
                  	<input type="hidden" class="goods_num" value="{{$v->goods_kc}}">

                    <input type="button" id="add" value="-" class="n_btn_1" />
                    <input type="text" value="{{$v->buy_number}}"  class="n_ipt" />
                    <input type="button" id="less" value="+" class="n_btn_2" />   
                </div>
                
                <input type="hidden" id="goods_id" value="{{$v->goods_id}}">
            </div>  
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr>
      </table>
      </div><!--dingdanlist/-->
		@endforeach
     
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="count">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
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
   
  </body>
</html>
<script>
	// $('.spinnerExample').spinner({});
    //点击+号
      $('.n_btn_2').click(function(){
      	var _this=$(this);
      	// console.log(_this);
      	//库存input框
        var goods_num = _this.parent().children().first();
        // console.log(goods_num);
        //购买数量input框
        var buy_num = _this.prev();
        // console.log(buy_num);
        //购买数量
        var buy_number = parseInt(buy_num.val());
        // console.log(buy_number);
        //库存
        var goods_number = parseInt(goods_num.val());
        // console.log(goods_number);
                if(buy_number>=goods_number){
                   		buy_num.val(goods_number);                  
                }else{
                   		buy_number=buy_number+1;
                   		buy_num.val(buy_number);
                }
                

                var goods_id=_this.parents('div[class="des_join"]').next().find('tr').eq(0).attr('goods_id');
                // console.log(goods_id);
            	$.ajaxSetup({
              	 	headers: {
               		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               		}
          		});
          		var flag=0;
                $.ajax({
                	url: '/changeNumber',
                	type: 'POST',
                	dataType: 'json',
                	async:false,
                	data: {buy_number:buy_number,goods_id:goods_id},
                	success:function(res){
                		if(res.code==2){
                			alert(res.content,{icon:res.icon});
                			flag=1;
                		}
                	}
                });
                if(flag==1){
                	return false;
                }
                //当前行的复选框选中
                checkedTr(_this);
                
                //重新获取总价
                getCount();
                
        });


        //点击-号
        $('.n_btn_1').click(function(){
           var _this = $(this);
           var goods_num = _this.parent().children().first();
           var buy_num = _this.next();
           var buy_number = parseInt(buy_num.val());
           var goods_number = parseInt(goods_num.val());
           var buy_number=parseInt(buy_num.val());
           if(buy_number<=1){
                    buy_num.val(1);
                   
                }else{
                    buy_number=buy_number-1;
                    buy_num.val(buy_number);
                }
            var goods_id=_this.parents('div[class="des_join"]').next().find('tr').eq(0).attr('goods_id');
             $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                });
              var flag=0;
	          $.ajax({
	            type:'post',
	            url:"/changeNumber",
	            data:{buy_number:buy_number,goods_id:goods_id},
	            async:false,
	            success:function(res){
	              if(res.code==2){
	              	alert(res.content,{icon:res.icon});
	                flag=1;
	              }
	            },
	            dataType:'json'
	          });
	          if(flag==1){
	            return false;
	          }
	          //当前行的复选框选中
              checkedTr(_this);
           	  //重新获取总价
              getCount();
        });


        //失去焦点
        $('.n_ipt').blur(function(){
            var _this = $(this);
            var goods_num = _this.parent().children().first();
            var buy_num = _this;
            var buy_number = parseInt(buy_num.val());
            var goods_number = parseInt(goods_num.val());
            var reg=/^\d+$/;


            if(buy_number==''||buy_number<=1||!reg.test(buy_number)){
                _this.val(1);
            }else if(buy_number>=goods_number){
                _this.val(goods_number);
            }else{
                buy_number=parseInt(buy_number);
                _this.val(buy_number);
            }
            //当前行的复选框选中
            checkedTr(_this);
            //重新获取总价
            getCount();
        });

         // 点击全选
         $('#allbox').click(function(){
            var _this=$(this);
            var status=_this.prop('checked');
            // console.log(status);
            $('.box').prop('checked',status);
            getCount();
         });

          //点击复选框
          $('.box').click(function(){
            getCount();
          })

           //当前行复选框选中
         function checkedTr(_this){
         	// console.log(_this);
            _this.parents('div[class="des_join"]').next().find('input[class="box"]').prop('checked',true)
         }

         //重新获取总价
         function getCount(){
         	// console.log(3);
            //获取选中的复选框的id
            var goods_id=new Array();
            // console.log(goods_id);
            $('.box:checked').each(function(index){
            	// console.log(index);
              //获取goods_id 并做逗号拼接
              goods_id.push($(this).parents('tr').attr('goods_id'));
             // goods_id+=$(this).parents('tr').attr('goods_id')+',';
              //console.log(goods_id);
            })
            //截取字符串（2,3,4,）去掉最后的逗号
           // goods_id=goods_id.substr(0,goods_id.length-1);
            //console.log(goods_id);
            
            $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                });
            $.post(
            	"/getCount",
            	{goods_id:goods_id},
            	function(res){
            		$('#count').text(res);	
            	},
            	'json'
            	)
           }


    //点击结算
      $('.jiesuan').click(function(){
        var len=$(".box:checked").length;
        // console.log(len);
        if(len==0){
          alert('请选择一个商品');
          return false;
        }
        var goods_id='';
        
        $('.box:checked').each(function(index){
        	// console.log(index);
        	// return false;
          goods_id+=$(this).parents('tr').attr('goods_id')+',';
          // console.log(goods_id);
        })
        
        // return false;
        goods_id=goods_id.substr(0,goods_id.length-1);
        location.href='/dingdan/'+goods_id;
        });
</script>