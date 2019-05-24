<link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}">
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
