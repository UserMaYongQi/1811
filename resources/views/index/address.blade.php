@include('public.top')
  <body>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="/dz" method="get" class="reg-login">
      <div class="lrBox">
       <div class="lrList"><input type="text" id="w_name" name="w_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" id="w_w" name="w_w" placeholder="详细地址" /></div>

       <div class="lrList" id="provice">
		
        <select class="area" id="w_s" name="w_s">
        <!-- <option>省份/直辖市</option> -->
        @foreach($data as $v)
         <option value="{{$v->id}}">{{$v->name}}</option>
        @endforeach
        </select>
		
       </div>
       <div class="lrList">
        <select class="area" id="w_s" name="w_sh">
         <option>市</option>
        </select>
       </div>


       <div class="lrList">
        <select class="area" id="w_s" name="w_q">
         <option>区县</option>
        </select>
       </div>

       <div class="lrList"><input type="text" id="tel" name="w_tel" placeholder="手机" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="btn" value="保存" />
      </div>
     </form><!--reg-login/-->
     
     <div class="height1"></div>
     @include('public.footer')
  </body>
</html>
<script>
	$('#btn').click(function(){
		var w_name=$('#w_name').val();
		if(w_name==''){
			alert('收货人姓名不能为空');
			return false;
		}

		var reg=/^[\u2E80-\u9FFF]+$/;
		if(!reg.test(w_name)){
			alert('收货人必须是中文');
			return false;
		}

		var w_w=$('#w_w').val();
		if(w_w==''){
			alert('收货人地址不能为空');
			return false;
		}

		// var w_s=$('#w_s').val();
		// if(w_s=='省份/直辖市'){
		// 	alert('省份不能为空');
		// 	return false;
		// }

		// var w_q=$('#w_q').val();
		// if(w_q=='区县'){
		// 	alert('区县不能为空');
		// 	return false;
		// }

		var tel=$('#tel').val();
		var reg=/^1[3|4|5|8][0-9]\d{4,8}$/;
		if(tel==''){
			alert('手机号不能为空');
			return false;
		}

		if(!reg.test(tel)){
			alert('手机号格式错误');
			return false;
		}
	})

	$.ajaxSetup({
	 headers: {
	 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 }
	});

	$('.area').change(function(){
		var id=$(this).val();
		var _this=$(this);
		// console.log(id);
		// return false;
		$.post(
			"city",
			{id:id},
			function(res){
				var _option="<option>--请选择--</option>";
				for(var i=0;i<res.length;i++){
					_option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>";
				}
				_this.parent('div').next('div').children('select').html(_option);
			},
			'json'
			);
		
		 $('#btn').prop('type','submit');

	})
</script>