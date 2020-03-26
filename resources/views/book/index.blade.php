<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <input type="text" name="name" placeholder="请输入图书名称..." value="{{$name}}">
        <button>搜索</button>
    </form>
    <table border=1>
        <tr>
            <td>图书ID</td>
            <td>图书名称</td>
            <td>图书作者</td>
            <td>图书价格</td>
            <td>图书封面</td>
            <td>操作</td>
        </tr>
        @foreach($res as $k=>$v)
        <tr>
            <td>{{$v->bid}}</td>
            <td>{{$v->bname}}</td>
            <td>{{$v->bman}}</td>
            <td>{{$v->bprice}}</td>
            <td><img src="{{env('uploads_url')}}{{$v->bimg}}" with=35 height=35></td>
            <td></td>
        </tr>
        @endforeach
    </table>
    {{$res->appends($query)->links()}}
</body>
</html>