<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行家-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<script type="text/javascript" src="js/page.js" ></script>
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
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							<input class="addUser" type="text" placeholder="输入用户名" />
							<button class="button">搜索</button>
							
						</div>
					</form>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="170px" class="tdColor">头像</td>
							<td width="135px" class="tdColor">姓名</td>
							<td width="140px" class="tdColor">是否上架</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@foreach($data as $v)
						<tr>
							<td>{{$v->hold_id}}</td>
							<td>{{$v->hold_file}}</td>
							<td>{{$v->hold_name}}</td>
							<td>@if($v->hold_show==1)是@else否@endif</td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="{{asset('img/update.png')}}"></a> <img class="operation delban"
								src="{{asset('img/delete.png')}}"></td>
						</tr>
						@endforeach
					</table>
					{{ $data->links() }}
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="{{asset('img/shanchu.png')}}" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>