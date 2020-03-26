<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $res=Category::get();
        return view("category/index",['res'=>$res]);
    }

    /**表单展示页面
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateInfo=Category::get();
        $cate_info=$this->getCateInfo($cateInfo);
        // dd($cate_info);
        return view("category/create",['cate_info'=>$cate_info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=request()->except('_token');
        $res=Category::insert($post);
        if($res){
           return redirect("/cate/index");
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
        $data=Category::find($id);
        $cateInfo=Category::get();
        $cate_info=$this->getCateInfo($cateInfo);
        return view("category/edit",['data'=>$data,'cate_info'=>$cate_info]);
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
       $data=request()->except('_token');
       $res=Category::where("cate_id",$id)->update($data);
       if($res!==false){
          return redirect("/cate/index");
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Category::destroy($id);
        if($res){
            return redirect("/cate/index");
        }
    }
    //无限极分类的方法
    public function getCateInfo($cateInfo,$pid=0,$level=1){
        //定义静态空数组
        static $info=[];
        foreach($cateInfo as $v){
            if($v->pid==$pid){
                $v->level=$level;
                $info[]=$v;
                // dd($info);
               self::getCateInfo($cateInfo,$v->cate_id,$level+2);
            }
        }
        return $info;
    }
}
