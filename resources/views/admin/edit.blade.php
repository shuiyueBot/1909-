<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/admin/update/'.$res->admin_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        管理员名称<input type="text" id="name" onblur="Check_name()" name="admin_name" value="{{$res->admin_name}}">{{$errors->first('admin_name')}}<br>
        密码<input type="password" id="pwd" onblur="Check_pwd()" name="admin_pwd" value="{{$res->admin_pwd}}">{{$errors->first('admin_pwd')}}<br>
        手机号<input type="text" id="tel" onblur="Check_tel()" name="admin_tel" value="{{$res->admin_tel}}">{{$errors->first('admin_tel')}}<br>    
        邮箱<input type="text" id="email" onblur="Check_email()" name="admin_email" value="{{$res->admin_email}}">{{$errors->first('admin_email')}}<br>
        头像<input type="file" name="admin_img"><br>
        <button>修改</button>
    </form>
</body>
</html>
<script>
    function Check_name(){
        var name=document.getElementById("name").value;
        if(name==''){
            alert("名称不能为空")
        }
    } 
        function Check_pwd(){
        var pwd=document.getElementById("pwd").value;
        if(pwd==''){
            alert("密码不能为空")
        }
    }    
    function Check_tel(){
        var tel=document.getElementById("tel").value;
        if(tel==''){
            alert("密码不能为空")
        }
    }
    function Check_email(){
        var email=document.getElementById("email").value;
        if(email==''){
            alert("密码不能为空")
        }
    }
</script>