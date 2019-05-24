<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{asset('img/coin02.png')}}" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;会员注册
			</div>
		</div>
		<div class="page ">
		@if ($errors->any())
		 <div class="alert alert-danger">
		 <ul>
		 @foreach ($errors->all() as $error)
		 <li>{{ $error }}</li>
		 @endforeach
		 </ul>
		 </div>
		@endif

		<!-- @csrf -->
		<meta name="csrf-token" content="{{ csrf_token() }}"> 
			<!-- 会员注册页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>会员注册</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						用户名：<input type="text" name="user_name" class="input3" id="jj"/>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;密码：<input type="password" name="user_pwd" id="kk" class="input3" />
					</div>
					<div class="bbD">
						确认密码：<input type="password1" class="input3" id="ll" />
					</div>
					<div class="bbD">
						<p class="bbDP">
							<a class="btn_ok btn_yes" href="#" id="ok">提交</a> 
							
						</p>
					</div>
				</div>
			</div>

			<!-- 会员注册页面样式end -->
		</div>
	</div>
</body>
</html>
<script>
	$.ajaxSetup({    
	 headers: {      
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
	    } 
	}); 
	$(function(){
		$('#ok').click(function(){
			var user_name=$('#jj').val();
			var user_pwd=$('#kk').val();
			var user_pwd1=$('#ll').val();
			

			//进行判断
			if(user_name==''){
				alert('用户名不能为空');
				return false;
			}

			if(user_pwd==''){
				alert('密码不能为空');
				return false;
			}

			if(user_pwd1==''){
				alert('确认密码不能为空');
				return false;
			}

			if(user_pwd1!==user_pwd){
				alert('两次密码不一致');
				return false;
			}
			$.post(
				"{{url('/user/add_do')}}",
				{user_name:user_name,user_pwd:user_pwd},
				function(res){
					if(res.icon==1){
						alert(res.content);
						location.href="{{url('/user/index')}}";
					}else{
						alert(res.content);
					}
				},
				'json'
				)

		})
		


	})
</script>