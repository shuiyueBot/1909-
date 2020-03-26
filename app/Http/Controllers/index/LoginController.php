<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCodemail;
use Illuminate\Support\Facades\Mail;
use App\index\User;
class LoginController extends Controller
{
    //登陆展示方法
    public function log(){

        return view("index.login");
    }
    //注册的展示方法
    public function reg(){

        return view("index.reg");
    }
    public function sendSms(){
        $name=request()->name;
        $reg="/^1[35678]\d{9}$/";
        if(!\preg_match($reg,$name)){
            return errorly("000001","请输入正确的邮箱或手机号");
        }
        $code=rand(100000,999999);
        $res=$this->Send($code,$name);
        if($res['Message']=='OK'){
            session(['code'=>$code]);
            return successly("00000","发送成功!");
        }else{
            return errorly("000001","发送失败");
        }
    }
    //发送验证码方法
    public function Send($code,$name){
   

        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4FtjShQ7uxBcxCRGZmN9', 'jwYGmfLavtAL7RBCyntGcztfcmHzZa')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => $name,
                                                'SignName' => "佳璇便利",
                                                'TemplateCode' => "SMS_183241729",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
             return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }

    }
    //注册的执行方法
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regDo(Request $request){
           $request->validate([
            'user_account'=>
            'required|unique:user',
            'user_num'=>'required',
            'user_pwd'=>'required',
            'user_repwd'=>'required',
        ],[
            'user_account.required'=>'文章标题必填',
            'user_account.unique'=>'该文章已存在',
            'user_num.required'=>'验证码必填',
            'user_pwd.required'=>'密码必填',
            'user_repwd.required'=>'确认密码必填',
        ]
        );
        $post=request()->except('_token');
        $code=session('code');
        if($post['user_num']!=$code){
            return '验证码有误';
        }
        if($post['user_pwd']!=$post['user_repwd']){
            return "两次密码输入不一致";
        }
        $res=User::insert($post);
        if($res){
            return \redirect("/log");
        }
    }
    //登陆的执行方法
    public function loginDo(){
        $post=request()->all();
        $user=User::where("user_account",$post['user_account'])->first();
        if($user->user_pwd!=$post['user_pwd']){
            return redirect("/log")->with('msg','用户名密码错误');
        }
        session(['user_account'=>$user]);
        if($post['refer']){
            return redirect($post['refer']);
        }
        return \redirect("/");
    }  
    public function test(){
      echo  session("user_account");
    }
    //发送邮件的方法
    public function sendEmail(){
        $name=request()->name;
        echo $name;
        $reg="/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/";
        if(!\preg_match($reg,$name)){
            return errorly("000001","请输入正确的邮箱或手机号");
        }
        $code=rand(100000,999999);
        Mail::to($name)->send(new SendCodemail($code));
        session(['code'=>$code]);
        return successly('00000','发送邮件成功');
    }
}
?>

