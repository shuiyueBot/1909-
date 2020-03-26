<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Admin::get();
        return view("admin.index",['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("/admin/create");
    }

    /**添加的方法
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //验证
        $request->validate([
            'admin_name'=>
            'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:admin|required',
            'admin_pwd'=>'required|between:6,12',
            'admin_email'=>'required|email',
            'admin_tel'=>'required|numeric|regex:/^1[357]\d{9}$/',
        ],[
            'admin_name.required'=>'管理员名称必填',
            'admin_name.regex'=>'请使用中文或者数字字母下划线2位以上16位以下',
            'admin_name.unique'=>'该管理员已存在',
            'admin_pwd.required'=>'密码不能为空',
            'admin_pwd.between'=>'请使用6位以上12位以下组成密码',
            'admin_email.required'=>'邮箱必填',
            'admin_email.email'=>'邮箱格式不正确',
            'admin_tel.required'=>'手机号必填',
            'admin_tel.numeric'=>'请填写数字手机号',
            'admin_tel.regex'=>'手机号长度为11位',
        ]
        );
        //接收数据
        $post=$request->except('_token');
        if($request->file('admin_img')){
           $post['admin_img']=uploads('admin_img');
        }
        //密码加密
        $post['admin_pwd']=encrypt($post['admin_pwd']);
        //保存到库中
        $res=Admin::insert($post);
        if($res){
            return redirect("/admin/index");
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
        $res=Admin::find($id);
        return view("admin.edit",['res'=>$res]);
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
        //验证
        $request->validate([
            'admin_name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
                Rule::unique("admin")->ignore($id,'admin_id'),
            ],
            'admin_pwd'=>'required|between:6,12',
            'admin_email'=>'required|email',
            'admin_tel'=>'required|numeric|regex:/^1[357]\d{9}$/',
        ],[
            'admin_name.required'=>'管理员名称必填',
            'admin_name.regex'=>'请使用中文或者数字字母下划线2位以上16位以下',
            'admin_name.unique'=>'该管理员已存在',
            'admin_pwd.required'=>'密码不能为空',
            'admin_pwd.between'=>'请使用6位以上12位一下组成密码',
            'admin_email.required'=>'邮箱必填',
            'admin_email.email'=>'邮箱格式不正确',
            'admin_tel.required'=>'手机号必填',
            'admin_tel.numeric'=>'请填写数字手机号',
            'admin_tel.regex'=>'手机号长度为11位',
        ]
        );
        $post=$request->except('_token');
        if($request->file('admin_img')){
           $post['admin_img']=uploads('admin_img');
        }
        $post['admin_pwd']=encrypt($post['admin_pwd']);
        //保存到库中
        $res=Admin::where("admin_id",$id)->update($post);
        if($res!==false){
            return redirect("/admin/index");
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
        $res=Admin::destroy($id);
        if($res){
            return redirect("/admin/index");
        }
    }
}
