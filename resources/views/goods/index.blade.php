<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index列表展示</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}">
</head>
<body>
	<form>
		<input type="text" name="keywords"><button>搜索</button>
	</form>
	<table border="1" width="1000">
	<tr>
		<td>商品id</td>
		<td>商品名称</td>
		<td>商品价格</td>
		<td>商品图片</td>
		<td>是否上架</td>
	</tr>
	@foreach($data as $v)
		<tr>
		
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td><img src="{{config('app.img_url')}}{{$v->goods_file}}" width="80"></td>
			<td>@if($v->is_down==1)是@else否@endif</td>
		</tr>
	@endforeach

	</table>
	{{$data->appends(['keywords' => $keywords])->links()}}
</body>
</html>