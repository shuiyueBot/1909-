<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plot;
class plotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info=Plot::get();
        return view("plot/index",['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("plot.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        //单文件上传
        if(request()->file('pimg')){
          $data['pimg'] = $this->uploads('pimg');
        }
        //多文件上传
        if($request->file('pimgs')){
           $pimgs=$this->Moreuploads('pimgs');
           //将返回的数组分割为字符串并入库
           $data['pimgs']=implode("|",$pimgs);
        }
        //添加入库
        $res=Plot::insert($data);
        if($res){
            return redirect("/plot/index");
        }

    }
    //多文件上传的方法
    public function Moreuploads($img){
        //判断文件是否上传
        $file=request()->file($img);
        //循环接收到的多文件数组
        foreach($file as $k=>$v){
            //检查对象变量是否实例化
            if($v->isValid()){
             $store_file[$k] = $v->store('uploads');
            }
        }
        return $store_file;
    }
    //文件上传的方法
    public function uploads($img){
        //接收文件信息
        $file=request()->file($img);
        //检查对象变量是否实例
        if($file->isValid()){
            //保存文件并起名字
            $info=$file->store('uploads');
            return $info;
        }else{
            exit("文件上传失败");
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
