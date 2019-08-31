<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>注册登录界面</title>
    <meta name="keywords" content="注册登录界面" />
    <meta name="description" content="注册登录界面" />
    <meta name="author" content="php中文网" />
    <meta name="copyright" content="php中文网" />
    <link type="text/css" rel="stylesheet" href="/crm/public/css/style.css">
</head>

<body>
<div class="materialContainer">
    <div class="box">
        <div class="title">登录</div>
        <div class="input">
            <label for="name">用户名</label>
            <input type="text" name="name" id="name">
            <span class="spin"></span>
        </div>
        <div class="input">
            密码
            <input type="password" name="pass" id="password">
            <span class="spin"></span>
        </div>
        <div class="button login">
            <button><span id="Log">立即登录</span> <i class="fa fa-check"></i></button>
        </div>
        <a href="" class="pass-forgot">忘记密码？</a>
    </div>
    <div class="overbox">
        <div class="material-button alt-2"><span class="shape"></span></div>
        <div class="title">注册</div>
        <div class="input">
            <label for="regname">用户名</label>
            <input type="text" name="regname" id="regname">
            <span class="spin"></span>
        </div>
        <div class="input">
            <label for="regpass">密码</label>
            <input type="password" name="regpass" id="regpass">
            <span class="spin"></span>
        </div>
        <div class="input">
            <label for="reregpass">确认密码</label>
            <input type="password" name="reregpass" id="reregpass">
            <span class="spin"></span>
        </div>
        <div class="button">
            <button><span>下一步</span></button>
        </div>
    </div>
</div>
<script type="text/javascript" src='/crm/public/js/jquery-1.10.2.min.js'></script>
<script type="text/javascript" src="/crm/public/js/index.js"></script>
</body>
</html>
<script>
    $(function(){
       // alert(111);
        //点击登录
        $('#Log').click(function(){
            var name=$('#name').val();//账号
            var password=$('#password').val();//密码
            // console.log(account);
            //前段非空验证
            if(name==''||password==''){
                alert('请填写完整的信息');
                return false;
            }
            //点击登录
            $.ajax({
                url :'/crm/public/index.php/userLogDo',
                data:{name:name,password:password},
                method:'post',
                dataType:'json',
                success:function(res){
                    //alert(1111);
                   // console.log(res);
                    if(res.code=='1'){
                        alert(res.font);
                        location.href='/crm/public/index.php/service/index';
                    }else{
                        alert(res.font);

                    }
                }
            })


           // return false;


        })
   })
</script>
