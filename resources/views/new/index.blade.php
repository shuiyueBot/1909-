<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/static/jquery.js"></script>
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>新闻ID</td>
            <td>新闻名称</td>
            <td>新闻分类</td>
            <td>添加人</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        <tbody id="tbody">
        @foreach($info as $k=>$v)
        <tr>
            <td>{{$v->new_id}}</td>
            <td>{{$v->new_name}}</td>
            <td>{{$v->type_name}}</td>
            <td>{{$v->new_man}}</td>
            <td>{{date("Y-m-d H:i:s",$v->new_time)}}</td>
            <td><a href="#">删除</a></td>
        </tr>
        @endforeach
      <tr><td colspan="6">{{$info->links()}}</td></tr>  
        </tbody>
    </table>
</body>
</html>
<script>

    //点击页码获取跳转地址
   $(document).on("click",".pagination a",function(){
       var url=$(this).attr('href');//获取跳转地址
       //使用ajax将跳转地址传给控制器
       $.get(
           url,
           function(res){
               $("#tbody").html(res);
           })
       return false;
   })
</script>