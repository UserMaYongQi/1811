<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// 	// session(['uid'=>2]);
//     return view('auth.login');
// });
//品牌
Route::prefix('/brand')->group(function(){
	Route::get('add','BrandController@create');
	Route::post('add_do','BrandController@store');
	Route::get('show','BrandController@index');
	Route::get('index/{brand_id}','BrandController@xq');
	Route::get('destroy','BrandController@destroy');
	Route::get('edit','BrandController@edit');
	Route::post('update','BrandController@update');
});

//商品
Route::prefix('/goods')->middleware('checklogin')->group(function(){
	Route::get('add','GoodsController@create');
	Route::post('add_do','GoodsController@store');
	Route::get('index','GoodsController@index');
	Route::get('destroy','GoodsController@destroy');
	Route::get('edit','GoodsController@edit');
	Route::get('update','GoodsController@update');
});
//用户
Route::prefix('/user')->middleware('checklogin')->group(function(){
	Route::get('add','UserController@create');
	Route::post('add_do','UserController@store');
	Route::get('index','UserController@index');
	Route::get('destroy','UserController@destroy');
	Route::get('edit','UserController@edit');
	Route::get('update','UserController@update');
});

//随笔
Route::prefix('/hold')->group(function(){
	Route::get('add','HoldController@create');
	Route::post('add_do','HoldController@store');
	Route::get('index','HoldController@index');
	Route::get('destroy','HoldController@destroy');
	Route::get('edit','HoldController@edit');
	Route::get('update','HoldController@update');
});


// Route::get('/good', function () {
// 	return "<form method='post' action='/goods'><input type='text' name=name>".csrf_field()."<button>提交</button></form>";
// });
// Route::match(['get','post'],'/goods', function () {
//     return request()->name;
// });

Route::get('/s',function(){
	return "<form method='post' action='/email'><input type='text' name=email>".csrf_field()."<button>提交</button></form>";
});
Route::post('/email','GoodsController@email');

Route::get('from',function(){
	return "<form method='post' action='/sd'><input type='text' name=email><input type='password' name=password>".csrf_field()."<button>提交</button></form>";
});
Route::post('/sd','GoodsController@zu');

//文章
Route::prefix('/news')->group(function(){
	Route::get('add','NewsController@create');
	Route::post('add_do','NewsController@store');
	Route::get('index','NewsController@index');
	Route::post('destroy','NewsController@destroy');
	Route::get('edit','NewsController@edit');
	Route::post('update','NewsController@update');
	Route::post('check','NewsController@check');
	Route::get('cate','NewsController@cate');
});


// Route::get('/k/{cateid}/{id}',function($ids,$cateid){
// 	echo $cateid.$ids;
// });

// Route::get('/l/{cateid?}/{id?}',function($cateid=1,$ids=2){
// 	echo $cateid.$ids;
// })->where('id','\d+');


// Route::get('/y',function(){
// 	return "<form method='post' action='/i'><input type='text' name=name>".csrf_field()."<button>提交</button></form>";
// });

// Route::redirect('/i','/o',301);

// Route::get('/o',function(){
// 	echo "hello laravel";

// });

//Route::get('index','GoodsController@index');
//用户
Route::prefix('/users')->group(function(){
	Route::get('add','UsersController@create');
	Route::post('add_do','UsersController@store');
	Route::get('index','UsersController@index');
	Route::post('destroy','UsersController@destroy');
	Route::get('edit','UsersController@edit');
	Route::post('update','UsersController@update');
	Route::post('check','UsersController@check');
	Route::get('cate','UsersController@cate');
	Route::post('check','UsersController@check');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//模板前台控制器
//模板注册
Route::get('/','Index\IndexController@index');
Route::get('/reg','Index\IndexController@reg');
Route::get('/login','Index\IndexController@login');
Route::post('qf','Index\IndexController@qf');
Route::post('/check','Index\IndexController@check');
Route::post('/store','Index\IndexController@store');

//登陆控制器
//模板登陆
Route::post('/login','Index\LoginController@Login');
//模板用户详情
Route::get('/user','Index\LoginController@user');
//退出
Route::get('/tc','Index\LoginController@tc');
//模板列表详情
Route::get('/prolist/{goods_id}','Index\LoginController@prolist');
//模板全部商品
Route::get('/proinfo','Index\LoginController@proinfo');
//商品排序
Route::post('desc','Index\LoginController@desc');


//购物车控制器
//加入购物车
Route::post('/cart','Index\CartController@cart');
Route::post('/price','Index\CartController@price');
//购物车列表页
Route::get('/cartIndex','Index\CartController@cartIndex');
//购物车＋-
Route::post('/changeNumber','Index\CartController@changeNumber');
Route::post('/getCount','Index\CartController@getCount');
//结算页面
Route::get('/pay','Index\CartController@pay');
//配送地址
Route::any('/address','Index\CartController@address');
//订单
Route::get('/dingdan/{goods_id}','Index\CartController@dingdan');
//三级联动
Route::post('/san','Index\CartController@san');
//用户评论
Route::post('content','Index\CartController@content');
//市
Route::post('city','Index\CartController@city');
Route::any('dz','Index\CartController@dz');
//提交订单
Route::any('/success','Index\CartController@success');
//订单
Route::any('/dd','Index\CartController@dd');
Route::any('/zhifu','Index\CartController@zhifu');
//pc端支付
Route::any('/pcpay','Index\CartController@pcpay');
//移动端支付
Route::any('/telpay','Index\CartController@telpay');








