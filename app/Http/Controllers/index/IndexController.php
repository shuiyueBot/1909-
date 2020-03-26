<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    public function index(){
        //查询主图
        $goods_img=Cache::get("is_up");
        if(!$goods_img){
            // echo 'DB====';
            $goods_img=Goods::select("Goods.goods_img","goods_id")->where('is_up',1)->OrderBy("goods_id","desc")->take(5)->get();
            // dd($goods_img);
            Cache::put("is_up",$goods_img,60*60*24);
        }
        $category=Category::where("pid","0")->get();
        $goodsInfo=Goods::select("Goods.goods_img","Goods.goods_name","Goods.goods_price")->get();
        return view("index.index",['goods_img'=>$goods_img,'category'=>$category,'goodsInfo'=>$goodsInfo]);
    }
}
