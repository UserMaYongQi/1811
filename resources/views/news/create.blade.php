<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
<script src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
	<form action="/news/add_do" method="post" enctype="multipart/form-data">
	@csrf
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
		<table>
			<p>
				文章标题：<input type="text" name="news_name" id="tatil">
			</p>
			<p>
				文章分类：
				
				<select name="file_id" id="file_id">
					<option value="">请选择</option>
				@foreach($data as $v)
					<option class="file_name" value="{{$v->file_id}}">{{$v->file_name}}</option>
				@endforeach
				</select>
				
			</p>
			<p>
				文章重要性：<input type="radio" name="news_zyx" class="news_zyx" value="1" checked>普通
							<input type="radio" name="news_zyx" class="news_zyx" value="2">置顶
			</p>
			<p>
				是否显示：<input type="radio" name="news_show" class="news_show" value="1" checked>显示
							<input type="radio" name="news_show" class="news_show" value="2">不显示
			</p>
			<p>
				文章作者：<input type="text" name="news_user">
			</p>
			<p>
				作者email：<input type="email" name="news_email">
			</p>
			<p>
				关键字：<input type="text" name="news_gjz">
			</p>
			<p>
				网页描述：<textarea name="news_desc" id="" cols="20" rows="5"></textarea>
			</p>
			<p>
				上传文件：<input type="file" name="news_file">        
			</p>
			<p>
				<!-- <button id="btn">提交</button> -->
				<input type="submit" id="btn" value="提交">
			</p>
		</table>

	</form>
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
			var tatil=$('#tatil').val();
			var file_name=$('.file_name:selected').val();
			var news_zyx=$('.news_zyx:checked').val();
			var news_show=$('.news_show:checked').val();
			if(tatil==''){
				alert('标题不能为空');
				return false;
			}
			if(file_name==undefined){
				alert('分类不能为空');
				return false;
			}

			if(news_zyx==undefined){
				alert('重要性不能为空');
				return false;
			}
			if(news_show==undefined){
				alert('是否显示不能为空');
				return false;
			}

			var reg=/^\w{3,10}$/;
			if(!reg.test(tatil)){
				alert('标题不符合规则');
				return false;
			}
			var flag=true;
			$.ajax({
				url: '/news/check',
				method:'post',
				anysc:false,
				data: {tatil:tatil},
				success:function(res){
					if(res.icon==1){
						flag=false;
						alert(res.content);
					}
					
				},
				dataType:'json'

			})
			
			

			// $.post(
			// 	"{{url('news/check')}}",
			// 	{tatil:tatil},
			// 	function(res){
			// 		if(res.icon==1){
			// 			alert(res.content);
			// 			return false;
			// 		}
			// 	},
			// 	'json'
			// 	)
		})
		
	})
</script>


		
