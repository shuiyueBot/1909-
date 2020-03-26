@extends('layouts.shop')
@section('title', '首页')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" class="boxAll" name="1" /> 全选</a></td>
       </tr>
       @foreach($cartInfo as $k=>$v)
       <tr goods_id="{{$v->goods_id}}" user_id="{{$v->user_id}}" price="{{$v->goods_price*$v->buy_num}}">
        <td width="4%"><input type="checkbox" class="box" /></td>
        <td class="dingimg" width="15%"><img src="{{env('uploads_url')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>{{$v->addtime}}</time>
        </td>
        <td align="right">
        <input type="button" id="add" value="+">
        <input type="text" id="buy_num" value="{{$v->buy_num}}">
        <input type="button" id="less" value="-"></td>
       </tr>
       <tr>
        <th colspan="4"><strong id="price" class="orange"></strong></th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong id="money" class="orange">¥0.00</strong></td>
       <td width="40%"><a href="javascript:;" id="query" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    
     <!-- @include('index.public.footer') -->
    @endsection 
    <script src="/static/index/js/jquery.min.js"></script>
    <script>

         //点击多选框
         $(document).on("click",".box",function(){
               getMoney();
         })
         //点击全选
         $(document).on("click",".boxAll",function(){
          var _status=$(".boxAll").prop("checked");
                //给所有复选框选中
                $(".box").prop("checked",_status);
                getMoney();
         })
         //点击提交
         $(document).on("click","#query",function(){
            var _box=$(".box:checked");
          var goods_id='';
            _box.each(function(index){
                goods_id+=$(this).parents("tr").attr("goods_id")+','; 
            })
            goods_id=goods_id.substr(0,goods_id.length-1);
          //   alert(goods_id)
               if(_box.length>0){
                   //已选中商品,跳转页面
                   location.href="/cart/query/?goods_id="+goods_id;
               }else{
                   //未选中,提示
                   alert("您还没有选中商品,不能进行结算");
               }
          })
         //算总价的方法
         function getMoney(){
              var box=$(".box:checked");
              var goods_id="";
              box.each(function(index){
                  goods_id+= $(this).parents("tr").attr("price")+',';
              })
              goods_id=goods_id.substr(0,goods_id.length-1);
          //     console.log(goods_id);
          //     return;
               //使用ajax将商品ID传到后台方法
               $.get(
                    "/cart/getMoney",
                     {goods_id:goods_id},
                     function(res){
                         console.log(res);
                         $("#money").text("￥"+res);
                     }
                )
          }  
          //点击+1       
          $(document).on("click","#add",function(){
               var _this=$(this);
              var buy_num= _this.next("input").val();
               var goods_id=_this.parents("tr").attr("goods_id");
               var user_id=_this.parents("tr").attr("user_id")
              var new_num= parseInt(buy_num)+1;
              cheakNum(new_num,goods_id,user_id);
          })
          //点击-1       
          $(document).on("click","#less",function(){
               var _this=$(this);
              var buy_num= _this.prev("input").val();
               // alert(buy_num
              var new_num= parseInt(buy_num)-1;
              if(new_num<1){
                   return;
              }
              var goods_id=_this.parents("tr").attr("goods_id");
               var user_id=_this.parents("tr").attr("user_id")
               cheakNum(new_num,goods_id,user_id);
          })
          //改变数据库购买数量
          function cheakNum(new_num,goods_id,user_id){
               $.get(
                    '/cart/AddBuy',
                    {new_num:new_num,goods_id:goods_id,user_id:user_id},
                    function(res){
                         $("#buy_num").val(new_num)
                    }
              )
          }
          //失去焦点时间
          $(document).on("blur","#buy_num",function(){
               var _this=$(this);
              var buy_num= _this.val();
              
              if(buy_num<1){
                   _this.val(1);
              }

          })

   </script>