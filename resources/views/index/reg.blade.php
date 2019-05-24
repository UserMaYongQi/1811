@include('public.top')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="login.html" method="get" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="/login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_email" id="email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" id="code" /> <button id="yzm">获取验证码</button></div>
       <div class="lrList"><input type="password" name="u_pwd" id="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" id="pwd1" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="btn" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     @include('public.footer')
  </body>
</html>
<script>
	$('#yzm').click(function(){
		var email=$('#email').val();
		if(email==''){
			alert('邮箱号或手机号不能为空');
			return false;
		}	
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});
		var reg1=/^[1][3,4,5,7,8][0-9]{9}$/;
		var reg2=/^\w{5,11}@qq.com$/;
		if(reg1.test(email) || reg2.test(email)){
			var flag=true;
			//验证邮箱手机号唯一性
			$.ajax({
				url: '/check',
				type: 'post',
				async:false,
				dataType: 'json',
				data: {email:email},
				success:function(msg){
					if(msg.icon==1){
						flag=false;
						alert(msg.content);
					}
				}
			});
			if(flag==false){
				return false;
			}

			$.post(
				"/qf",
				{email:email},
				function(res){
					if(res.icon==1){
						alert(res.content);
					}
				},
				'json'
				)
		}else{
			alert('邮箱或手机号格式不正确');
			return false;
		}


		return false;
	})


	$('#btn').click(function(){
		var email=$('#email').val();
		if(email==''){
			alert('邮箱号不能为空');
			return;
		}

		var code=$('#code').val();
		if(code==''){
			alert('验证码不能为空');
			return;
		}

		var pwd=$('#pwd').val();
		if(pwd==''){
			alert('密码不能为空');
			return;
		}
		var reg=/^\w{6,18}$/;
		if(!reg.test(pwd)){
			alert('密码不符合规则');
			return;
		}
		var pwd1=$('#pwd1').val();
		if(pwd1==''){
			alert('确认密码密码不能为空');
			return;
		}

		if(pwd1!==pwd){
			alert('两次密码不一致');
			return;
		}
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});
		var flag=true;
			//验证邮箱手机号唯一性
			$.ajax({
				url: '/check',
				type: 'post',
				async:false,
				dataType: 'json',
				data: {email:email},
				success:function(msg){
					if(msg.icon==1){
						flag=false;
						alert(msg.content);
					}
				}
			});
			if(flag==false){
				return false;
			}
		$.ajax({
			url: '/store',
			type: 'POST',
			dataType: 'json',
			anysc:false,
			data: {email:email,code:code,pwd:pwd},
			success:function(res){
				if(res.icon==1){
					alert(res.content);
					return false;
				}else{
					alert(res.content);
					location.href="/login";
				}
			}
		})
	})
</script>

