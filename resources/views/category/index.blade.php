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
            <td>分类ID</td>
            <td>分类名称</td>
            <td>所属分类</td>
            <td>是否上架</td>
            <td>介绍</td>
            <td>操作</td>
        </tr>
        @foreach($res as $k=>$v)
        <tr>
            <td>{{$v->cate_id}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->pid}}</td>
            <td>{{$v->cate_show}}</td>
            <td>{{$v->cate_desc}}</td>
            <td>
                <a href="{{url('/cate/edit/'.$v->cate_id)}}">编辑</a>
                <a href="{{url('/cate/destroy/'.$v->cate_id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>