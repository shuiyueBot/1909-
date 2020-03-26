<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('new/store')}}" method="post">
    @csrf
    新闻名称<input type="text" name="new_name"><b style="color:red">{{$errors->first("new_name")}}</b><br>
    新闻分类<select name="type_id">
        <option value="0">--请选择--</option>
        @foreach($info as $k=>$v)
        <option value="{{$v->type_id}}">{{str_repeat("---",$v->level)}}{{$v->type_name}}</option>
        @endforeach
    </select><br>
    新闻作者<input type="text" name="new_man"><b style="color:red">{{$errors->first("new_man")}}</b><br>
    <button>添加</button>
    </form>
</body>
</html>