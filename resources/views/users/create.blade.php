<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
<script src="{{asset('js/jquery.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<form id="form1" enctype="multipart/form-data">
		<table>
			<p>用户名：<input type="text" name="users_name" id="name"></p>
			<p>头像：<input type="file" name="users_file" id="file"></p>
			<p>性别：
				<input type="radio" name="users_sex" class="sex" value="1">男
				<input type="radio" name="users_sex" class="sex" value="2">女
			</p>
			<p><input type="button" value="提交" id="btn"></p>
		</table>
	</form>
</body>
</html>
<script>
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	
	$('#name').blur(function(){
		var _this=$(this).val();
		if(_this==''){
			alert('用户名不能为空');
			return;
		}
		var reg=/^\w{3,10}$/;
		if(!reg.test(_this)){
			alert('用户名由数字字母下划线组成，长度3-10位');
			return;
		}
	})
	$('#btn').click(function(){
		//用户名
		var name=$('#name').val();
		if(name==''){
			alert('用户名不能为空');
			return;
		}
		//头像
		var file=$('#file').val();
		if(file==''){
			alert('头像不能为空');
			return;
		}
		// console.log(file);
		// 性别
		var sex=$('.sex:checked').val();
		// console.log(sex);
		if(sex==undefined){
			alert('性别必选');
			return;	
		}
		var flag=true;
		$.ajax({
				url: '/users/check',
				type: 'post',
				async:false,
				data: {name:name},
				success:function(res){
					if(res.icon==1){
						alert(res.content);
						flag=false;
					}
				},
				dataType: 'json',
			})
		if(flag==false){
			return false;
		}

		var fd=new FormData($('#form1')[0]);
		$.ajax({
			url: '/users/add_do',
			type: 'post',
			anysc:false,
			data: fd,
			processData:false,
			contentType:false,
			success:function(msg){
				console.log(msg);
			},
			dataType: 'json',
		})
		
		
		// return false;
	})
</script>