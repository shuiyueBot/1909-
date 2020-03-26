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
<center><h2>文章添加页面</h2></center>
<form class="form-horizontal" role="form" action="{{url('/article/store')}}" method="post" enctype="multipart/form-data"> 
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control name" id="firstname" name="article_name" 
				   placeholder="请输入标题">
                   <span style="color:red">*</span><b style="color:red">{{$errors->first("article_name")}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
            <select name="types_id">
                <option value="">--请选择--</option>
                @foreach($TypesInfo as $k=>$v)
                <option value="{{$v->types_id}}">{{$v->types_name}}</option>
                @endforeach
            </select>
			<b style="color:red">{{$errors->first("types_id")}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio"  name="article_top" checked value="1">普通
            <input type="radio"  name="article_top" value="2">置顶
			<b style="color:red">{{$errors->first("article_top")}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_show" checked value="1" >是
            <input type="radio"  name="is_show" value="2" >否
			<b style="color:red">{{$errors->first("is_show")}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="article_man" 
				   placeholder="请输入作者">
		</div>
	</div>

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="article_email" 
				   placeholder="请输入邮箱">
		</div>
	</div>
    
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="keyword" 
				   placeholder="请输入关键字">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="firstname" name="article_desc"></textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="article_img" 
				   >
		</div>
	</div>



	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
//文章标题验证
$(document).on('blur','input[name="article_name"]',function(){
    var admin_name = $(this).val();
    var reg = /^[\u4e00-\u9fa5\w-.]{2,50}$/;
    if(!reg.test(admin_name)){
        $(this).next().text("管理员名称需由中文数字字母下划线2-50位组成");
        return;
    }
    $.ajax({
        url:"/article/CheckOnly",
        data:{_name:_name},
        // type:get,
        // async:true,
        dataType:'json',
        success:function(res){
            if(res.count>0){
                $('input[name="article_name"]').next().text("品牌名称已存在");
            }
            console.log(res);
        }
    })
})
$(document).on('click',"button",function(){
    var nameflag = true;
    var _name = $('input[name="article_name"]').val();
    var reg = /^[\u4e00-\u9fa5\w-.]{2,50}$/;
    if(!reg.test(article_name)){
        $('input[name="article_name"]').next().text("品牌名称需由中文数字字母下划线2-50位组成");
        return;
    }
    $.ajax({
        url:"/article/CheckOnly",
        data:{_name:_name},
        // type:get,
        async:false,
        dataType:'json',
        success:function(res){
            if(res.count>0){
                $('input[name="article_name"]').next().text("品牌名称已存在");
                nameflag = false;
            }
            console.log(res);
        }
    })
    if(!nameflag){
        return;
    }
    $("form").submit();
})
//文章

</script>