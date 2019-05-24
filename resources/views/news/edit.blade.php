<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
<!-- <script src="{{asset('js/jquery.js')}}"></script> -->
</head>
<body>
	<form action="/news/update" method="post" enctype="multipart/form-data">
	<input type="hidden" name="news_id" value="{{$data->news_id}}">
	@csrf
	@if ($errors->any())
	 <div class="alert alert-danger">
	 <ul>
	 @foreach ($errors->all() as $error)
	 <li>{{ $error }}</li>
	 @endforeach
	 </ul>
	 </div>
	@endif
		<table>
			<p>
				文章标题：<input type="text" name="news_name" value="{{$data->news_name}}">
			</p>
			<p>
				文章分类：
				
				<select name="file_id" id="file_id">
					@foreach($date as $v)
					<option value="{{$v->file_id}}" @if($data->file_id==$v->file_id) selected @endif>{{$v->file_name}}</option>
					@endforeach
				</select>
				
			</p>
			<p>
				文章重要性：<input type="radio" name="news_zyx" value="1" @if($data->news_zyx==1) checked @endif>普通
							<input type="radio" name="news_zyx" value="2" @if($data->news_zyx==2) checked @endif>置顶
			</p>
			<p>
				是否显示：<input type="radio" name="news_show" value="1" @if($data->news_show==1) checked @endif>显示
							<input type="radio" name="news_show" value="2" @if($data->news_show==2) checked @endif>不显示
			</p>
			<p>
				文章作者：<input type="text" name="news_user" value="{{$data->news_user}}">
			</p>
			<p>
				作者email：<input type="email" name="news_email" value="{{$data->news_email}}">
			</p>
			<p>
				关键字：<input type="text" name="news_gjz" value="{{$data->news_gjz}}">
			</p>
			<p>
				网页描述：<textarea name="news_desc" id="" cols="20" rows="5">{{$data->news_desc}}</textarea>
			</p>
			<p>
				上传文件：<input type="file" name="news_file">
				原文件：<image src="{{config('app.img_url')}}{{$data->news_file}}" width="100"></image>
			</p>
			<p>
				<button id="btn">修改</button>
			</p>
		</table>

	</form>
</body>
</html>


		
