<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index列表展示</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}">
	<script src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
	<form>
		<input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称">
		<input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入品牌网址">
		<button>搜索</button>
	</form>
	<div id="con">
	<table border="1" width="1000">
	<tr>
		<td>商品id</td>
		<td>商品名称</td>
		<td>商品logo</td>
		<td>商品url</td>
		<td>商品详情</td>
		<td>操作</td>
	</tr>
	@foreach($data as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td><a href="/brand/index/{{$v->brand_id}}">{{$v->brand_name}}</a></td>
			<td><img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="100"></td>
			<td>{{$v->brand_url}}</td>
			<td>{{$v->brand_desc}}</td>
			<td>
				<a href="destroy?id={{$v->brand_id}}">删除</a>||
				<a href="edit?brand_id={{$v->brand_id}}">修改</a>
			</td>
		</tr>
	
	@endforeach

	</table>
	{{$data->appends($query)->links()}}
</body>
</html>
</div>
<script>
	$(document).on('click','.pagination a',function(){
		//获取url
		var url=$(this).prop('href');
		$.ajax({
			url: url,
			type: 'get',
			data:'',
		})
		.done(function(msg) {
			$('#con').html(msg);
		})
		
		return false;
	})
</script>