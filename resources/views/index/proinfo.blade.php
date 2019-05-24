@include('public.top')
  <body>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;" id="xp">新品</a></li>
      <li><a href="javascript:;" id="kc">库存</a></li>
      <li><a href="javascript:;" id="jg">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      <dl>
      @foreach($data as $v)
       <dt><a href="proinfo.html"><img src="{{config('app.img_url')}}{{$v->goods_file}}" width="100" height="100" /></a></dt>
       <dd>
		
        <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>{{$v->goods_price}}</strong> <span>{{$v->goods_price}}</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>库存：{{$v->goods_kc}}</em></div>
		
       </dd>
       <div class="clearfix"></div>
       @endforeach
      </dl>
      
      
     </div><!--prolist/-->
     <div class="height1"></div>
     @include('public.footer')
  </body>
</html>
<script>
	$.ajaxSetup({
	 headers: {
	 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 }
	});
	$('#kc').click(function(){
		var fd=$(this).text();
		console.log(fd);
		$.post(
			"/desc",
			{fd:fd},
			function(res){
				$('#kc').after(res);
			},
			'json'
			)
	})

	$('#jg').click(function(){
		var fd=$(this).text();
		console.log(fd);
	})
</script>