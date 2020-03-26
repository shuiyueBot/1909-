<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form>
    <input type="text" name="name" value="{{$name}}" placeholder="请输入标题..."><input type="submit" value="搜索">
</form>
    <table>
        <tr>
            <td>新闻ID</td>
            <td>新闻标题</td>
            <td>新闻添加人</td>
            <td>新闻添加时间</td>
            <td>操作</td>
        </tr>
        <tbody id="tbody">  
        @foreach($newsInfo as $k=>$v)
        <tr>
            <td>{{$v->new_id}}</td>
            <td>{{$v->new_title}}</td>
            <td>{{$v->new_man}}</td>
            <td>{{date("Y-m-d H:i:s",$v->new_time)}}</td>
            <td></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5">{{$newsInfo->appends(['name'=>$name])->links()}}</td>
        </tr>
        </tbody>
    </table>
</body>
</html>
<script src="/static/jquery.js"></script>
<script>
    $(document).on("click",".pagination a",function(){
        var url=$(this).attr("href");
        $.get(
            url,
            function(res){
                $("#tbody").html(res);
            })
        return false;
    })
</script>