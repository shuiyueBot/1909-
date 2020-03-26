<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Goods;
use App\Brand;
use Illuminate\Validation\Rule;
use App\Http\Requests\GoodsBlogPost;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=request()->name;
        $where=[];
        if($name){
            $where[]=['goods_name','like',"%$name%"];
        }
        $goodsInfo=Goods::select('goods.*','category.cate_name','brand.brand_name')->
                    leftjoin("Brand","goods.brand_id","=","brand.brand_id")->
                    leftjoin("category","goods.cate_id","=","category.cate_id")->
                    where($where)->
                    paginate(3);
                    $query=request()->all();
        return view("goods/index",['goodsInfo'=>$goodsInfo,'name'=>$name,'query'=>$query]);
    }

    /**表单的展示页面
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //查询品牌表数据
        $brandInfo=Brand::get();
        //查询分类表数据
        $cateInfo=Category::get();
        $cate_info=$this->getCateInfo($cateInfo);
        return view("goods/create",['cate_info'=>$cate_info,'brandInfo'=>$brandInfo]);
    }

    /**将数据保存在数据库中
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsBlogPost $request)
    {
        //接收数据值
        $post=$request->except('_token');
        //文件上传的方法
        if($request->file('goods_img')){
            $post['goods_img']=uploads('goods_img');
        }
        //相册的方法
        if($request->file('goods_imgs')){
            $goods_imgs=moreuploads("goods_imgs");
            $post['goods_imgs']=implode('|',$goods_imgs);
        }
        $res=Goods::insert($post);
        if($res){
            return redirect("/goods/index");
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Goods::find($id);
        //查询品牌表数据
        $brandInfo=Brand::get();
        //查询分类表数据
        $cateInfo=Category::get();
        $cate_info=$this->getCateInfo($cateInfo);
        // dd($res);
        return view("goods.edit",['res'=>$res,'brandInfo'=>$brandInfo,'cate_info'=>$cate_info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'goods_name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                Rule::unique("goods")->ignore($id,'goods_id'),
            ],
            'goods_num'=>'required|max:8|not_regex:/^\d{8}$/',
            'goods_price'=>'required',
            'cate_id'=>'required',
            'brand_id'=>'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_name.regex'=>'请使用中文或者数字字母下划线2位以上50位以下',
            'goods_name.unique'=>'该商品已存在',
            'goods_num.required'=>'库存不能为空',
            'goods_num.max'=>'库存过大',
            'goods_num.not_regex'=>'请填写真实库存',
            'goods_price.required'=>'商品价格不能为空',
            'cate_id.required'=>'分类不能为空',
            'brand_id.required'=>'品牌不能为空',
        ]
        );   
        //接收数据值
        $post=$request->except('_token');
        //文件上传的方法
        if($request->file('goods_img')){
            $post['goods_img']=uploads('goods_img');
        }
        //相册的方法
        if($request->file('goods_imgs')){
            $goods_imgs=moreuploads("goods_imgs");
            $post['goods_imgs']=implode('|',$goods_imgs);
        }
        $res=Goods::where("goods_id",$id)->update($post);
        if($res!==false){
            return redirect("/goods/index");
        }  
    }

    /**删除的方法
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Goods::destroy($id);
        if($res){
            return redirect("goods/index");
        }
    }
     //无限极分类的方法
     public function getCateInfo($cateInfo,$pid=0,$level=0){
        //定义静态空数组
        static $info=[];
        foreach($cateInfo as $v){
            if($v->pid==$pid){
                $v->level=$level;
                $info[]=$v;
                // dd($info);
               self::getCateInfo($cateInfo,$v->cate_id,$level+1);
            }
        }
        return $info;
    }
}
