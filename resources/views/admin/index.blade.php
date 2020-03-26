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
            <td>管理员ID</td>
            <td>管理员名称</td>
            <td>手机号</td>
            <td>邮箱</td>
            <td>头像</td>
            <td>操作</td>
        </tr>
        @foreach($res as $k=>$v)
        <tr>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
            <td>{{$v->admin_email}}</td>
            <td><img src="{{env('uploads_url')}}{{$v->admin_img}}" with=35 height=35></td>
            <td>
                <a href="{{url('/admin/destroy/'.$v->admin_id)}}">删除</a>
                <a href="{{url('/admin/edit/'.$v->admin_id)}}">修改</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>