<?php

// ********公共文件***********//

//文件上传的方法
 function uploads($img){
    $file=request()->file($img);
    if($file->isValid()){
        $store_file=$file->store('uploads');    
        return $store_file;
    }
}
//多文件上传的方法
 function moreuploads($img){
    $file=request()->file($img);
    foreach($file as $k=>$v){
        if($v->isValid()){
            $store_file[$k]=$v->store('uploads');    
        }   
    }
    return $store_file;
}
//无限极分类
function getOption($data,$pid=0,$level=0){
    static $array=[];
    foreach($data as $v){
        if($v->pid==$pid){
            $v->level=$level;
            $array[]=$v;
            getOption($data,$v->type_id,$level+1);
        }
    }
    return $array;
}
//json返回的结果为正确的
function successly($code,$msg){
    return   json_encode(['code'=>$code,'msg'=>$msg]);
    // die;
}
function errorly($code,$msg){
    return json_encode(['code'=>$code,'msg'=>$msg]);
    // die;
}

?>