<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/student/store')}}" method="post">
    @csrf
    学生姓名<input type="text" name="name" ><br>
    学生性别<input type="radio" name="sex" value="男">男
            <input type="radio" name="sex" value="女">女<br>
    学生班级<select name="class">
                <option >1909phpA</option>
                <option >1908phpA</option>
                <option >1907phpA</option>
                <option >1910phpA</option>
    </select>        <br>
    <input type="submit" value="添加">
    </form>
</body>
</html>