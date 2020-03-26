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
<center><h2>品牌编辑页面<a style="float:right" href="{{url('/brand/index')}}" class="btn btn-default">展示</a></h2></center><hr/>

<form class="form-horizontal" role="form" action="{{url('/brand/update/'.$res->brand_id)}}" method="post" enctype="multipart/form-data">
	<div class="form-group">
	@csrf
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname"  name="brand_name"
				value="{{$res->brand_name}}"   placeholder="请输入名字">
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="brand_url"
            value="{{$res->brand_url}}"   placeholder="请输入网址">
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" id="firstname" name="brand_logo"
				   >
		</div>
		@if($res->brand_logo)<img src="{{env('uploads_url')}}{{$res->brand_logo}}" with=35 height=35>@endif
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">介绍</label>
		<div class="col-sm-6">
			<textarea  class="form-control" id="firstname" name="brand_desc" 
				   placeholder="请输入介绍">{{$res->brand_desc}}</textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-7">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>