<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        商品名称<input type="text" name="goods_name" id="goods_name" onblur="Check_name()"><b style="color:red">{{$errors->first('goods_name')}}</b><br>
        商品货号<input type="text" name="goods_no"><br>
        商品库存<input type="text" name="goods_num"><b style="color:red">{{$errors->first('goods_num')}}</b><br>
        商品价格<input type="text" name="goods_price"><b style="color:red">{{$errors->first('goods_price')}}</b><br>
        商品分类<select name="cate_id">
            <option value="">--请选择--</option>
            @foreach($cate_info as $k=>$v)
            <option value="{{$v->cate_id}}">{{str_repeat("——",$v->level*1)}}{{$v->cate_name}}</option>
            @endforeach
        </select><b style="color:red">{{$errors->first('cate_id')}}</b><br>
        商品品牌<select name="brand_id">
            <option value="">--请选择--</option>
            @foreach($brandInfo as $k=>$v)
            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
            @endforeach
        </select><b style="color:red">{{$errors->first('brand_id')}}</b><br>
        商品主图<input type="file" name="goods_img"><br>
        商品相册<input type="file" name="goods_imgs[]" multiple><br>
        是否上架
            <input type="radio" name="is_show" checked value="1">是
            <input type="radio" name="is_show" value="2">否<br>
        是否新品
            <input type="radio" name="is_new" checked value="1">是
            <input type="radio" name="is_new" value="2">否<br>
        是否精品
            <input type="radio" name="is_best" value="1" checked>是
            <input type="radio" name="is_best" value="2">否<br>
            是否幻灯片展示
            <input type="radio" checked name="is_up" value="1">是
            <input type="radio" name="is_up" value="2">否<br>
            是否热销
            <input type="radio" name="is_hot" checked value="1">是
            <input type="radio" name="is_hot" value="2">否<br>
        商品详情<textarea name="goods_desc"cols="30" rows="10"></textarea><br>
        <input type="submit" value="添加">
    </form>
</body>
</html>
<script>
    //获取商品名称的方法
    function Check_name(){
        var goods_name=document.getElementById("goods_name").value;
        if(goods_name==""){
            alert("商品名称必填");
        }
    }
</script>