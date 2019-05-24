<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>心愿管理-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<link rel="stylesheet" href="{{asset('css/page.css')}}" />

</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{asset('img/coin02.png')}}" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>

		<div class="page">
			<!-- wish页面样式 -->
			<div class="wish">
				<div class="conform">
					<form>
						<div class="cfD">
							用户名称：<input class="vinput" type="text" name="user_name" value="{{$user_name??''}}"/>
							<button class="button">搜索</button>
						</div>
					</form>
				</div>
				<!-- wish 表格 显示 -->
				<div class="wishShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
				
							<td width="175px" class="tdColor">用户名称</td>
							<td width="175px" class="tdColor">添加时间</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@foreach($data as $v)
						<tr>
							<td>{{$v->user_id}}</td>
							
							<td>{{$v->user_name}}</td>
							
							<td>{{$v->created_at}}</td>
							<td><img class="operation delban" src="{{asset('img/delete.png')}}"></td>
						</tr>
						@endforeach
					</table>
					{{$data->appends(['user_name' =>$user_name])->links() }}
				</div>
				<!-- wish 表格 显示 end-->
			</div>
			<!-- wish页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="img/shanchu.png"/></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>
</html>
