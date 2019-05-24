<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>laravel修改</title>
</head>
<body>
	<form action="update" method="post" enctype="multipart/form-data">
		<input type="hidden" name="brand_id" value="{{$data->brand_id}}">
	@csrf
		<table>
			商品名称：<input type="text" name="brand_name" value="{{$data->brand_name}}"><br>
			商品logo：<image src="{{config('app.img_url')}}{{$data->brand_logo}}" width="100"></image>
					<input type="file" name="brand_logo"><br>
			商品详情：<textarea type="text" name="brand_desc" >{{$data->brand_desc}}</textarea><br>
			商品地址：<input type="text" name="brand_url" value="{{$data->brand_url}}"><br>
			<button>修改</button>
		</table>
	</form>
</body>
</html>