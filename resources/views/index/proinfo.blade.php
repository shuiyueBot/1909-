@extends('layouts.shop')
@section('title', '首页')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     @if($goodsInfo->goods_imgs)
     @php $goodsimgs=explode("|",$goodsInfo->goods_imgs);@endphp
     @foreach($goodsimgs as $v) 
     <img src="{{env('uploads_url')}}{{$v}}" />
     @endforeach 
     @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$goodsInfo->goods_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goodsInfo->goods_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>
       </td>
       <td align="right">
        <center>当前访问量:{{$count}}</center> 
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
       @if($goodsInfo->goods_img)
      <img src="{{env('uploads_url')}}{{$goodsInfo->goods_img}}" width="636" height="822" />
      @endif 
    </div><!--proinfoList/-->
     <div class="proinfoList">
     {{$goodsInfo->goods_desc}}
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id="addcart" href="javascript:;">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    

@include('index.public.footer')
<script src="/static/index/js/jquery.min.js"></script>
<script>
//点击加入购物车
$(document).on("click","#addcart",function(){
    var buy_num=$(".spinnerExample").val();
    var goods_id={{$goodsInfo->goods_id}};
    if(buy_num<1){
      alert("请更改购买数量");
      return;
    }
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    $.post('/goods/addcart',{goods_id:goods_id,buy_num:buy_num},function(res){  
      if(res.code=='00003'){
            location.href="/log?refer="+location.href;
        }
        if(res.code==00004){
          alert(res.msg);
          return;
        }
        // alert(res);
        if(res.code==00000){
          alert(res.msg);
        }
    },'json')
})
</script>       
@endsection

