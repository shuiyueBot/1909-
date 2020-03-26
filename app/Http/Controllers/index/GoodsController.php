<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Cache;
class GoodsController extends Controller
{
    //商品列表的方法
    public function goodsList(){
        $goodsInfo=Goods::get();
        return view("index.prolist",['goodsInfo'=>$goodsInfo]);
    }
    //商品详情的方法
    public function goodsInfo($id){
       $count= Cache::add("count".$id,1)?Cache::get("count".$id):Cache::increment("count".$id);
        $goodsInfo=Goods::find($id);
        return view("index.proinfo",['goodsInfo'=>$goodsInfo,'count'=>$count]);
    }
    //加入购物车方法
    public function addcart(Request $request){
        //判断用户是否登陆
        $user=session("user_account");
        if(!$user){
            return errorly('00003',"请您先登录");
        }
        $goods_id=$request->goods_id;
        $buy_num=request()->buy_num;
        //判断库存
        $goods=Goods::find($goods_id);
        //判断库存
        if($goods->goods_num<$buy_num){
            return errorly("00004","库存不足");
        }
        //判断用户之前是否添加个此商品
        $cart=Cart::where(['user_id'=>$user->user_id,'goods_id'=>$goods_id])->first();
        
        if($cart){
            //判断库存
            $buy_num=$cart->buy_num+$buy_num;
            if($goods->goods_num<$buy_num){
                $buy_num=$goods->goods_num;
            }
            $res=Cart::where("cart_id",$cart->cart_id)->update(['buy_num'=>$buy_num]);
        }else{
            $data=[
                'user_id'=>$user->user_id,
                'goods_id'=>$goods_id,
                'buy_num'=>$buy_num,
                'goods_name'=>$goods->goods_name,
                'goods_price'=>$goods->goods_price,
                'goods_img'=>$goods->goods_imgs,
                'addtime'=>time()
            ];
            $res=Cart::create($data);
        }
        if($res){
            return successly("00000","成功添加");
        }
    }
}
