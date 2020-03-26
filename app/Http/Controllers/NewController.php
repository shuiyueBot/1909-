<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Type;
class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info=News::join("type","news.type_id","=","type.type_id")->
              paginate(3);
              if(request()->ajax()){
                    return view("new/ajaxpaage",['info'=>$info]);          
              }
        return view("new/index",['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $TypeInfo =Type::get();
        $info=getOption($TypeInfo);
        return view("new/create",['info'=>$info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //验证
        $request->validate([
            'new_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,30}$/u|unique:news',
            'new_man'=>'required',
        ],[
            'new_name.required'=>'新闻名称必填',
            'new_name.regex'=>'新闻名称必须由中文或数字字母下划线组成',
            'new_name.unique'=>'新闻名称已存在',
            'new_man.required'=>'新闻作者必填',
        ]);
        //添加入库
        $post=$request->except('_token');
        $post['new_time']=time();
        $res=News::insert($post);
        if($res){
           return redirect("/new/index");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
