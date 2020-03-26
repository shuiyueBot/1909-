<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use App\Brand;
use DB;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //接收搜索条件
        $name=request()->name;
        //定义空的搜索条件
        $where=[];
        //拼接搜索条件
        if($name){
            $where[]=['brand_name','like',"%$name%"];
        }
        $url=request()->url;
        if($url){
            $where[]=['brand_url','like',"%$url%"];
        }
        $brandInfo=Brand::where($where)->paginate(3);
        // dd($brandInfo);
        $query=request()->all();
        return view("brand/index",['brandInfo'=>$brandInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("brand/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreBlogPost $request)//第二张表单验证
    public function store(Request $request)
    { 
        //第一种表单验证方式
        // $request->validate([
        //     'brand_name' => 'required|unique:brand|max:12',
        //     'brand_url' => 'required'
        // ],
        //     [
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_name.max'=>'品牌名称请在12位以内',
        //     'brand_url.required'=>'品牌网址必填'
        // ]);
          //接收表单数据
        $post=$request->except('_token');
        //第三种表单验证
        $validator = Validator::make($post,
            [
                'brand_name' => 'required|unique:brand|max:12',
                'brand_url' => 'required'
            ],[
                'brand_name.required'=>'品牌名称必填',
                'brand_name.unique'=>'品牌名称已存在',
                'brand_name.max'=>'品牌名称请在12位以内',
                'brand_url.required'=>'品牌网址必填'
            ]);
            if ($validator->fails()) {
                return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
                }
        if(request()->file('brand_logo')){
            // echo 1;die;
           $post['brand_logo']=$this->uploads("brand_logo");//文件上传的方法
        }
        $res=Brand::create($post);
        if($res){
            return redirect("/brand/index");
        }
    }
    //判断文件上传过程中有没有误
    public function uploads($img){
        if(request()->file($img)->isValid()){
           $file= request()->$img;//接收上传文件
           $store_res= $file->store('uploads');//保存
            return $store_res;
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
        $res=Brand::find($id);
        // dd($res);
        return view("brand.edit",['res'=>$res]);
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
        $data=request()->except(['_token','brand_logo']);
        // dd($data);
        if(request()->file('brand_logo')){
            // echo 1;die;
           $data['brand_logo']=$this->uploads("brand_logo");//文件上传的方法
        }
        $res=Brand::where('brand_id',$id)->update($data);
        // dd($res);
        if($res!==false){
          return   redirect("/brand/index");
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
        $res=Brand::destroy($id);
        if($res){
            return redirect("/brand/index");
        }
    }
}
