<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>列表展示</title>
	<link rel="stylesheet" href="{{asset('css/page.css')}}">
	<script src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
<form>
	<input type="text" name="news_name" value="{{$query['news_name']??''}}" placeholder="请输入文章标题">
	<input type="text" name="file_name" value="{{$query['file_name']??''}}" placeholder="请输入文章分类">
	<button>提交</button>
</form>
<meta name="csrf-token" content="{{ csrf_token() }}">
	<table border=1>
		<tr>
			<td>编号</td>
			<td>文章标题</td>
			<td>文章分类</td>
			<td>文章重要性</td>
			<td>是否显示</td>
			<td>添加日期</td>
			<td>图片</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)
		<tr news_id={{$v->news_id}}>
			<td>{{$v->news_id}}</td>
			<td>{{$v->news_name}}</td>
			<td>{{$v->file_name}}</td>
			<td>@if($v->news_zyx==1)普通@else置顶@endif</td>
			<td>@if($v->news_show==1)√@else×@endif</td>
			<td>{{date('Y-m-d H:i:s',$v->news_create)}}</td>
			<td><img src="{{config('app.img_url')}}{{$v->news_file}}" width="50"></td>
			<td>
				<a href="javascript:;" class="sc">删除</a>
				<a href="{{url('/news/edit')}}?news_id={{$v->news_id}}">修改</a>
			</td>
		</tr>
		@endforeach
	</table>
	{{$data->appends($query)->links() }}
</body>
</html>
<script>
	$(function(){
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});

		$('.sc').click(function(){
			var news_id=$(this).parents('tr').attr('news_id');
			$.post(
				"{{url('/news/destroy')}}",
				{news_id:news_id},
				function(res){
					if(res.icon==1){
						alert(res.content);
						location.href="{{url('/news/index')}}";
					}
				},
				'json'
				)	
		})
	})
</script>