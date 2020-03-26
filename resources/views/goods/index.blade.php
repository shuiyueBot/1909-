<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form>
    <input type="text" name="name" value="{{$name}}" placeholder="请输入名称">
    <button>搜索</button>
</form>
    <table border=1>
        <tr>
            <td>商品id</td>
            <td>商品名称</td>
            <td>商品库存</td>
            <td>商品价格</td>
            <td>商品主图</td>
            <td>商品相册</td>
            <td>商品序号</td>
            <td>是否上架</td>
            <td>是否新品</td>
            <td>是否精品</td>
            <td>商品介绍</td>
            <td></td>
        </tr>
        @foreach($goodsInfo as $k=>$v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_num}}</td>
            <td>{{$v->goods_price}}</td>
            <td>
                @if($v->goods_img)            
                <img src="{{env('uploads_url')}}{{$v->goods_img}}" with=35 height=35>
                @endif
            </td>
            <td>
                @php $goods_imgs=explode('|',$v->goods_imgs) @endphp
                @foreach($goods_imgs as $vv)
                   @if($v->goods_imgs)
                    <img src="{{env('uploads_url')}}{{$vv}}" with=35 height=35>
                    @endif
                @endforeach
            </td>
            <td>{{$v->goods_no}}</td>
            <td>{{$v->is_show==1?'√':'×'}}</td>
            <td>{{$v->is_new==1?'√':'×'}}</td>
            <td>{{$v->is_best==1?'√':'×'}}</td>
            <td>{{$v->goods_desc}}</td>
            <td>
                <a href="{{url('goods/destroy/'.$v->goods_id)}}">删除</a>
                <a href="{{url('goods/edit/'.$v->goods_id)}}">编辑</a>
             </td>
        </tr>
        @endforeach
    </table>
    {{$goodsInfo->appends($query)->links()}}
</body>
</html>