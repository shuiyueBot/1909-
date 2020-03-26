@extends('layouts.shop')
@section('title', '首页')
@section('content')
     <header>
     <script src="/static/index/js/jquery.min.js"></script>
     <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/login/regDo')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="/log">登陆</a></h3>
      <div class="lrBox">
           @csrf
       <div class="lrList"><input type="text" id="name" name="user_account" placeholder="输入手机号码或者邮箱号" />{{$errors->first('user_account')}}</div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="user_num" /> <button type="button">获取验证码</button>{{$errors->first('user_num')}}</div>
       <div class="lrList"><input type="password" name="user_pwd" placeholder="设置新密码（6-18位数字或字母）" />{{$errors->first('user_pwd')}}</div>
       <div class="lrList"><input type="password" name="user_repwd" placeholder="再次输入密码" />{{$errors->first('user_repwd')}}</div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     <script>
         //点击获取验证码
         $(document).on("click","button",function(){
               var name=$("#name").val();//获取手机号
               //正则验证手机号是否合法
               var reg=/^1[35678]\d{9}$/;
               if(reg.test(name)){
                    //使用ajax将手机号传到控制器
                    $.get(
                         "/login/sendSms",
                         {name:name},
                         function(res){
                              if(res.code==00000){
                              return  alert(res.msg);
                              }else{
                              return alert(res.msg);
                              }
                         },'json'
                    )      
               }
               //正则验证手机号是否合法
               var reg=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
               if(reg.test(name)){
                    //使用ajax将邮箱传到控制器
               $.get(
                    "/login/sendEmail",
                    {name:name},
                    function(res){
                         console.log(res)
                         if(res.code==00000){
                            return  alert(res.msg);
                         }else{
                             return alert(res.msg);
                         }
                    },'json'
               )
               
          }
               
               //设置定时器，进入倒计时
				//1.通过点击事件获取按钮的值
				$(this).text('60s');
				//点击按钮后失效
				$(this).css('pointer-events','none');
				//2.设置定时器
				_time=setInterval(timeLess,1000);
				//3.新建自减的方法，进行定时器自减
				function timeLess(){
					var scend= $("button").text();
					//将字符串转化为数值
					scend=parseInt(scend);
					if(scend==0){
						//消除计时器
						clearInterval(_time);
						//点击按钮生效
						$("button").css('pointer-events','auto');
						$("button").text("获取");
					}else{
						scend=scend-1;
						$("button").text(scend+'s');
					}
				}
         })
    </script>
     @include('index.public.footer')
    @endsection  
    