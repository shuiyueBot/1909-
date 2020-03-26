<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border=1>
        <tr>
            <td>小区名称</td>
            <td>房屋导购</td>
            <td>联系方式</td>
            <td>房屋面积</td>
            <td>房屋相册</td>
            <td>房屋图片</td>
            <td>价格</td>
            <td>操作</td>
        </tr>
        @foreach($info as $k=>$v)
        <tr>
            <td>{{$v->pname}}</td>
            <td>{{$v->pman}}</td>
            <td>{{$v->ptel}}</td>
            <td>{{$v->pacre}}</td>
            <td>
                @if($v->pimgs)
                    @php $pimgs=explode("|",$v->pimgs);  @endphp
                    @foreach($pimgs as $vv)
                    <img src="{{env('uploads_url')}}{{$vv}}" with=50 height=50>
                    @endforeach
                @endif
            </td>
            <td>@if($v->pimg)
                    <img src="{{env('uploads_url')}}{{$v->pimg}}" with=50 height=50>
                @endif</td>
            <td>{{$v->pprice}}</td>
            <td><a href="#">删除</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>