<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Admin;
class LoginController extends Controller
{
    public function login(){
    //    dd(request()->session()->get('adminuser'));
        return view("login/login");
    }
    //登陆的方法
    public function logindo(){
        //接收表单的账户密码
        $post=request()->except('_token');
        //根据账号进行查询数据
        $res=Admin::where("admin_name",$post['admin_name'])->first();
        if(decrypt($res->admin_pwd)!=$post['admin_pwd']){
            return redirect("/login/login")->with('msg',"用户名或密码错误");
        }else{
            session(["adminuser"=>$res]);
            return redirect("/index/index");
            
        }
    }
}
