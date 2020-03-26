<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/plot/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    小区名称<input type="text" name="pname"><br>
    房屋导购<input type="text" name="pman"><br>    
    联系方式<input type="text" name="ptel"><br>
    房屋面积<input type="text" name="pacre"><br>
    图片<input type="file" name="pimg"><br>
    相册<input type="file" multiple name='pimgs[]'><br>
    价格<input type="text" name="pprice"><br>
    <input type="submit" value="添加">
    </form>
</body>
</html>