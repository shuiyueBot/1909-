@extends('layouts.shop')
@section('title', '商品列表')
@section('content')
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      @foreach($goodsInfo as $k=>$v)
      <dl goods_id="{{$v->goods_id}}">
       <dt><a href="{{url('/goods/'.$v->goods_id)}}"><img src="{{env('uploads_url')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/goods/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     @include('index.public.footer')
    @endsection
    <script src="/static/index/js/jquery.min.js"></script>
    <script>
      //点击切换
        $(document).on("click","li",function(){
            var _this=$(this);
            _this.addClass("pro-selCur");
            _this.siblings().removeClass("pro-selCur");
        })
      //点击进入列表详情
      
    </script>