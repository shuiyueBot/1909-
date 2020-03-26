<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\News;
class NewsController extends Controller
{
    public function index(){
        //1.当关键字未空时设置key，时效5分钟
        //2.当key存在
        // Redis::flushall();
        $page=request()->page??1;
        $name=request()->name??'';
        $newsInfo=Redis::get("name".$page.$name);
        // dump($newsInfo);
        //未设置关键字
        if(empty($newsInfo)){
            echo "Db===";
            $where=[];
            if($name){
                $where[]=['new_title',"like","%$name%"];
            }
            $newsInfo=News::where($where)->paginate(3);
            // Redis::del("name");
            $newsInfo=serialize($newsInfo);
            $newsInfo=Redis::setex("name".$page.$name,60*5,$newsInfo);
        }
        $newsInfo=unserialize($newsInfo);
        // dd($newsInfo);
        //判断如果$name未空的话，消除index
        //设置关键字     
        
        //判断是否是ajax请求
       if(request()->ajax()){
           return view("news.page",['newsInfo'=>$newsInfo,'name'=>$name]);
       }
       return view("news.index",['newsInfo'=>$newsInfo,'name'=>$name]); 
    }
}
