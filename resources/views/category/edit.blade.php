<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品分类编辑页面<a style="float:right" href="{{url('/cate/index')}}" class="btn btn-default">展示</a></h2></center><hr/>

<form class="form-horizontal" role="form" action="{{url('/cate/update/'.$data->cate_id)}}" method="post" >
	<div class="form-group">
	@csrf
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname"  name="cate_name" value="{{$data->cate_name}}"
				   placeholder="请输入名称">
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分级分类</label>
		<div class="col-sm-8">
			<select name="pid">
                <option value="0">顶级分类</option>
                @foreach($cate_info as $k=>$v)
                    <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                @endforeach
            </select>
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">介绍</label>
		<div class="col-sm-8">
			<textarea  class="form-control" id="firstname" name="cate_desc" 
				   placeholder="请输入介绍">{{$data->cate_desc}}</textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-8">
			
                <input type="radio" name="cate_show" value="1">是
                <input type="radio" name="cate_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>
</body>
</html>