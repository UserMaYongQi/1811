<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{asset('img/coin02.png')}}" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>上传广告</span>
				</div>
				
				<div class="baBody">
				<meta name="csrf-token" content="{{ csrf_token() }}">
				@if ($errors->any())
				 <div class="alert alert-danger">
				 <ul>
				 @foreach ($errors->all() as $error)
				 <li>{{ $error }}</li>
				 @endforeach
				 </ul>
				 </div>
				@endif
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						名称：<input type="text" class="input1" name="hold_name" id="hold_name"/>
					</div>
					<div class="bbD">
						链接地址：<input type="text" class="input1" name="hold_url" id="hold_url"/>
					</div>
					<div class="bbD">
						上传图片：
						<div class="bbDd">
							<div class="bbDImg">+</div>
							<input type="file" class="file" name="hold_file" id="hold_file"/> <a class="bbDDel" href="#">删除</a>
						</div>
					</div>
					<div class="bbD">
						是否显示：<label>
									<input type="radio" value="1" name="hold_show" class="hold_show" checked="checked" />是
								</label> 
								<label>
									<input type="radio" value="2" name="hold_show" class="hold_show"/>否
								</label>
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#" id="btn">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
			
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	$(function(){
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#btn').click(function(){
			var hold_name=$('#hold_name').val();
			var hold_url=$('#hold_url').val();
			var hold_file=$('#hold_file').val();
			var hold_show=$('.hold_show').val();

			if(hold_name==''){
				alert('名称不能为空');
				return false;
			}
			if(hold_url==''){
				alert('连接不能为空');
				return false;
			}
			if(hold_file==''){
				alert('图片不能为空');
				return false;
			}
			if(hold_show==''){
				alert('是否显示不能为空');
				return false;
			}

			$.post(
				"{{url('/hold/add_do')}}",
				{hold_name:hold_name,hold_url:hold_url,hold_file:hold_file,hold_show:hold_show},
				function(res){
					if(res.icon==1){
						alert(res.content);
						location.href="{{url('/hold/index')}}";
					}
				},
				'json'
				)
		})

	})

	
</script>