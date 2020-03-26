<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form>
    <input type="text" name="name">
    <select name="types_name">
        <option value="">--请选择--</option>
        @foreach($TypesInfo as $k=>$v)
        <option value="{{$v->types_name}}">{{$v->types_name}}</option>
        @endforeach
    </select>
    <button>搜索</button>
</form>
    <table>
        <tr>
            <td>文章ID</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>文章显示</td>
            <td>文章图片</td>
            <td>操作</td>
        </tr>
        @foreach($articleData as $k=>$v)
        <tr>
            <td>{{$v->article_id}}</td>
            <td>{{$v->article_name}}</td>
            <td>{{$v->types_name}}</td>
            <td>{{$v->article_top==1?'普通':'顶置'}}</td>
            <td>{{$v->is_show==1?'√':'×'}}</td>
            <td>@if($v->article_img)<img src="{{env('uploads_url')}}{{$v->article_img}}" with=35 height=35>@endif</td>
            <td>
                <button id="del" article_id="{{$v->article_id}}">删除</button>
                <button><a href="{{url('/article/edit/'.$v->article_id)}}">修改</a></button>
            </td>
        </tr>
        @endforeach
    </table>
    {{$articleData->appends($query)->links()}}
</body>
</html>
<script src="/static/jquery.js"></script>
<script>
    //点击删除
  
 $(document).on("click","#del",function(){
        var _this=$(this);
         var article_id= _this.attr("article_id");
        $.get(
            "{{url('/article/ajaxdelete')}}",
             {article_id:article_id},
             function(res){
                 if(res.code=='00000'){
                     location.reload();
                 }
             },'json'
        )
    })
</script>