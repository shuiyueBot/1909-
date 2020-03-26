<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/book/store')}}" method="post" enctype="multipart/form-data">
       @csrf
        图书名称<input type="text" name="bname"><b style="color:red">{{$errors->first('bname')}}</b><br>
        图书作者<input type="text" name="bman"> <b style="color:red">{{$errors->first('bman')}}</b><br>
        图书售价<input type="text" name="bprice"><br>
        图书封面<input type="file" name="bimg"><br>
        <input type="submit" value="添加">
    </form>
</body>
</html>