<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>laravel添加</title>
	<!-- <script src="{{asset('js/jquery.js')}}"></script> -->
</head>
<body>
	<form action="add_do" method="post" enctype="multipart/form-data">
	@if ($errors->any())
	 <div class="alert alert-danger">
	 <ul>
	 @foreach ($errors->all() as $error)
	 <li>{{ $error }}</li>
	 @endforeach
	 </ul>
	 </div>
	@endif
	@csrf
	<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
		<table>
			商品名称：<input type="text" name="goods_name" id="goods_name"><br>
			商品价格：<input type="text" name="goods_price" id="goods_price"><br>
			商品图片：<input type="file" name="goods_file" id="goods_file"><br>
			是否上架：<input type="radio" name="is_down" value="1" id="is_down">是
					<input type="radio" name="is_down" value="2" id="is_down">否<br>
			<button>提交</button>
		</table>
	</form>
</body>
</html>
<!-- <script>
	$(function(){
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('button').click(function(){
			var goods_name=$('#goods_name').val();
			var goods_price=$('#goods_price').val();
			var goods_file=$('#goods_file').val();
			
		$.post(
			"add_do"

			)
		})
	})
</script> -->