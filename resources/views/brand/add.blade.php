<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>laravel添加</title>
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
		<table>
			商品名称：<input type="text" name="brand_name"><br>
			商品logo：<input type="file" name="brand_logo"><br>
			商品简介：<textarea type="text" name="brand_desc"></textarea><br>
			商品地址：<input type="text" name="brand_url"><br>
			<button>提交</button>
		</table>
	</form>
</body>
</html>