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
//     // echo chinese;
//     return view('welcome');
// });
// Route::get('/goods', 'IndexController@goods');
// Route::get('/add','IndexController@add');
// Route::post('/adddo','IndexController@adddo');
// Route::match(['get','post'],'/add','IndexController@add');
//必填参数  //闭包函数测试
// Route::get('/new/{id}/{name}',function($id,$name){
//     echo $id."+++".$name;
// })
//运用到方法测试
// Route::get('/show/{id}/{name}','IndexController@show');
//可选参数 闭包函数测试
// Route::get('/new/{id?}/{name?}',function($id=null,$name=null){
//     echo $id."<br>".$name;
// })
//运用到方法中测试
// Route::get('/delete/{id?}/{name?}','IndexController@delete');
//加入正则验证，限制参数类型
// Route::get('select/{id}/{name}','IndexController@select')->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);

//展示品牌的路由
Route::prefix('brand')->group(function () {
    Route::get('create','BrandController@create');
    Route::post('store','BrandController@store');
    Route::get('index','BrandController@index');
    Route::get('edit/{id}','BrandController@edit');
    Route::post('update/{id}','BrandController@update');
    Route::get("destroy/{id}",'BrandController@destroy');
});
//学生路由
Route::get('/student/create','StudentController@create');
Route::post('/student/store','StudentController@store');
Route::get('/student/index','StudentController@index');
Route::get('/student/edit/{id}','StudentController@edit');
Route::post('/student/update/{id}','StudentController@update');
Route::get('/student/destroy/{id}','StudentController@destroy');
//商品分类的路由
Route::get('/cate/create','CateController@create');
Route::post('/cate/store','CateController@store');
Route::get('/cate/index','CateController@index');
Route::get('/cate/edit/{id}','CateController@edit');
Route::post('/cate/update/{id}','CateController@update');
Route::get('/cate/destroy/{id}','CateController@destroy');
//房屋的路由
Route::get('/plot/create','PlotController@create');
Route::post('/plot/store','PlotController@store');
Route::get('/plot/index','PlotController@index');
//商品路由
Route::prefix('goods')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store');
    Route::get('index','GoodsController@index');
    Route::get('destroy/{id}','GoodsController@destroy');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update');
});
//图书的路由
Route::prefix('book')->group(function(){
    Route::get('create','BookController@create');
    Route::post('store','BookController@store');
    Route::get('index','BookController@index');
    Route::get('destroy/{id}','BookController@destroy');
    Route::get('edit/{id}','BookController@edit');
    Route::post('update/{id}','BookController@update');  
});
//管理员路由 
Route::prefix('admin')->group(function(){
    Route::get('create','AdminController@create');
    Route::post('store','AdminController@store');
    Route::get('index','AdminController@index');
    Route::get('destroy/{id}','AdminController@destroy');
    Route::get('edit/{id}','AdminController@edit');
    Route::post('update/{id}','AdminController@update');  
});
//新闻的路由
Route::prefix('new')->group(function(){
    Route::get('create','NewController@create');
    Route::post('store','NewController@store');
    Route::get('index','NewController@index');
    Route::get('destroy/{id}','NewController@destroy');
    Route::get('edit/{id}','NewController@edit');
    Route::post('update/{id}','NewController@update');  
});
//登陆的路由
Route::get("/login/login","LoginController@login");
Route::post("/login/logindo","LoginController@logindo");
//首页的路由
// Route::get("/index/index","IndexController@index");
//文章的路由
Route::prefix('article')->middleware('isset')->group(function(){
    Route::get('create','ArticleController@create');
    Route::post('ajax',"ArticleController@ajax");
    Route::post('store','ArticleController@store');
    Route::get('index','ArticleController@index');
    Route::get('destroy/{id}','ArticleController@destroy');
    Route::get('edit/{id}','ArticleController@edit');
    Route::post('update/{id}','ArticleController@update');
    Route::get('ajaxdelete','ArticleController@ajaxdelete'); 
     
});
Route::get('/article/session','ArticleController@session');
//商城首页
Route::get("/","index\IndexController@index")->name("index");
//登陆
Route::get("/log","index\LoginController@log");
//注册
Route::get("/reg","index\LoginController@reg");
//手机号发送验证码方法
Route::get("/login/sendSms","index\LoginController@sendSms");
//注册执行 
Route::post("/login/regDo","index\LoginController@regDo");
//登陆执行

Route::post("/login/loginDo","index\LoginController@loginDo");
Route::get("/login/test","index\LoginController@test");
//发送 邮件
Route::get('/login/sendEmail','index\LoginController@sendEmail');
//商品列表首页
Route::get('/goods/list','index\GoodsController@goodsList');
//商品详情页
Route::get('/goods/{id}','index\GoodsController@goodsInfo')->name("proinfo");
//添加购物车ajax请求
Route::post('/goods/addcart','index\GoodsController@addcart');
//购物车列表
Route::get('/cart/show','index\CartController@cartshow')->name("cart");
//获取总价的ajax方法
Route::get('/cart/getMoney','index\CartController@getMoney');
//购买数量
Route::get('/cart/AddBuy','index\CartController@AddBuy');
//确认订单结算
Route::get('/cart/query','index\CartController@query');
Route::get('/cart/order','index\CartController@order');
Route::get('/cart/pay','index\CartController@pay');
Route::get('/cart/success','index\CartController@success');
Route::get('/cart/alipay/{id}','index\CartController@alipay');
Route::get('/return_url','index\CartController@return_url');
Route::get('/news',"NewsController@index");
/****************/
 Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); 

?>
