<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 基本的表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>品牌展示页面<a style="float:right" href="{{url('/brand/create')}}" class="btn btn-default">添加</a></h2></center><hr/>
<form >
   <input type="text" name="name" placeholder="请输入名称.." value="{{$query['name']??''}}">
   <input type="text" name="url" placeholder="请输入网址.." value="{{$query['url']??''}}">
   <button>搜索</button>
</form>
<table class="table">
  <thead>
      <tr>
         <th>品牌ID</th>
         <th>品牌名称</th>
         <th>品牌网址</th>
         <th>品牌图片</th>
         <th>品牌介绍</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
   @foreach ($brandInfo as $v)
      <tr>
         <td>{{$v->brand_id}}</td>
         <td>{{$v->brand_name}}</td>
         <td>{{$v->brand_url}}</td>
         <td>
            @if($v->brand_logo)<img src="{{env('uploads_url')}}{{$v->brand_logo}}" with=35 height=35>@endif
         </td>
         <td>{{$v->brand_desc}}</td>
         <td>
         <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
         <a href="{{url('/brand/destroy/'.$v->brand_id)}}" type="button" class="btn btn-danger">删除</a>
         </td>
      </tr>
    @endforeach
    <tr><td colspan="6">{{$brandInfo->appends($query)->links()}}</td></tr>
   </tbody>
</table>

</body>
</html>