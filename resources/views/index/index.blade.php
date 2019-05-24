<!-- 引用头部公共部分和样式-->
@include('public.top')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">
    <div class="head-top">
        <img src="/index/images/head.jpg" />
      <dl>
       <dt><a href="/user"><img src="/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">{{$email}}</h1>
        <ul>
         <li><a href="/proinfo"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty" ></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      @if("$email"!='还未登陆')
        <li><a href="javascript:;">欢迎{{$email}}登录</a></li>
        <li><a href="/tc" class="rlbg">退出</a></li>
      @else
      <li><a href="/login">登录</a></li>
      <li><a href="/reg" class="rlbg">注册</a></li>
      @endif
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
    @foreach($data as $v)
      <img src="{{config('app.img_url')}}{{$v->goods_file}}" />
    @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
    @foreach($data as $v)
      <li><a href="/prolist/{{"$v->goods_id"}}">{{$v->goods_name}}</a></li>
    @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
    @foreach($data as $v)
      <div class="index-pro1-list">
       <dl>
        <dt>
          <a href='/prolist/{{"$v->goods_id"}}'>
            <img src="{{config('app.img_url')}}{{$v->goods_file}}" />
          </a>
        </dt>
        <dd class="ip-text"><a href="proinfo.html">{{$v->goods_name}}</a><span>已售：488</span></dd>
        <dd class="ip-price"><strong>{{$v->goods_price}}</strong> <span>¥599</span></dd>
       </dl>
      </div>
    @endforeach
   
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
  
    <!-- 引用底部公共文件 -->
    @include('public.footer')
  </body>
</html>
