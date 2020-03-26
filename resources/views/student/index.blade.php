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
            <td>学生姓名</td>
            <td>学生性别</td>
            <td>学生班级</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)
        <tr>
            <td>{{$v->name}}</td>
            <td>{{$v->sex}}</td>
            <td>{{$v->class}}</td>
            <td>
                <a href="{{url('/student/edit/'.$v->id)}}">编辑</a>
                <a href="{{url('/student/destroy/'.$v->id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>