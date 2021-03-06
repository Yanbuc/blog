<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <title>月歌的后台页面</title>
    <link rel="Bookmark" href="<?php echo (H_UI_PATH); ?>favicon.ico" >
    <link rel="Shortcut Icon" href="<?php echo (H_UI_PATH); ?>favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/html5.js"></script>
    <script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo (H_UI_STATIC_PATH); ?>h-ui/css/H-ui.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (H_UI_PATH); ?>lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--<link href="<?php echo (H_UI_STATIC_PATH); ?>h-ui/css/style.css" rel="stylesheet" type="text/css" />--><!--自己的样式-->
    <!--[if IE 6]>
    <script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('.pngfix,.icon');</script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/layer/2.4/layer.js"></script>

</head>

<body>
<form action="<?php echo U('Home/Register/register');?>" method="post" class="form form-horizontal" id="demoform-1">
    <div class="row cl">
        <span style="position: absolute;left:420px;color:red;">用户名长度不超过20个字符，只能由数字下划线英文组成</span><br/>
        <label class="form-label col-xs-4 col-sm-3">用户名</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="user" name="user" type="text" class="input-text" autocomplete="off" placeholder="帐号" style="width:40%;">
            <span style="font-size: 20px;color:red; display:none;" id="cuser">没有输入用户名</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($data['user']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <span style="position: absolute;left:420px;color: red;">昵称长度不超过20个字符，只能由数字下划线英文组成</span><br/>
        <label class="form-label col-xs-4 col-sm-3">昵称</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input  id="nickname" name="nickname" type="text" class="input-text" autocomplete="off" placeholder="昵称" style="width:40%;">
            <span style="font-size: 20px;color:red; display:none;" id="cnickname">没有输入昵称</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($data['nickname']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <span style="position: absolute;left:420px;color: red;">密码长度至少为6</span><br/>
        <label class="form-label col-xs-4 col-sm-3">密码</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="password" name="password" type="password" class="input-text" autocomplete="off" placeholder="密码" style="width:40%;">
            <span style="font-size: 20px;color:red; display:none;" id="cpwd">没有输入密码</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($data['password']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">验证密码</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="checkPwd" name="checkPwd"  type="password" class="input-text" autocomplete="off" placeholder="验证密码" style="width:40%;">
            <span style="font-size: 20px;color:red; display:none;" id="ck">没有输入验证密码</span>
            <span style="font-size: 20px;color:red; display:none;" id="ccheckPwd">两次密码输入不正确</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($data['checkPwd']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">验证码</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="ver" name="ver" type="text" class="input-text" autocomplete="off" placeholder="验证码" style="width:20%;">
            <img  src="<?php echo U('Home/Register/showCheckCode');?>" onclick="this.src = '<?php echo U('Home/Register/showCheckCode');?>'"/>
            <span style="font-size: 20px;color:red; display:none;" id="cver">没有输入密码</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($data['ver']); ?></span>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">个性签名</label>
        <div class="formControls col-xs-8 col-sm-9">
            <textarea id="tip" name="tip" class="textarea" placeholder="不超过30个字" rows="" cols="" name="" style="width:50%;height:200px;"></textarea>
            <span style="font-size: 20px;color:red; display:none;" id="ctip">没有输入个性签名</span>
            <span style="font-size: 20px;color:red; display:none;" id="cm">个性签名字数超出</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($data['tip']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input class="btn btn-primary radius" type="button" value="注册" id="sub">
            <span style="font-size: 20px;color:red; " ><?php echo ($data['result']); ?></span>
        </div>
    </div>
</form>
</body>
     <script>
         //检查用户名
         function checkUser(){
             var user = $('#user').val();
             if (user == '') {
                 $('#cuser').show();
                 return false;
             }
             return true;
         }
         //检查用户昵称
         function checkNickName(){
             var nickName = $('#nickname').val();
             if (nickName == ''){
                 $('#cnickname').show();
                 return false;
             }
             return true;
         }
         //检查密码
         function checkPwds(){
           var pwd = $('#password').val();
           if (pwd == ''){
               $('#cpwd').show();
               return false;
           }
           return true;
         }
         //检查验证密码
         function checkComPwd(){
             var cpwd = $('#checkPwd').val();
             if (cpwd == ''){
                 $('#ck').show();
                 return false;
             }
             else {
                 var pwd = $('#password').val();
                 if (cpwd !== pwd ){
                     $('#ccheckPwd').show();
                     return false;
                 }
                 return true;

             }
         }

         function checkVer(){
             var ver = $('#ver').val();
             if (ver == ''){
                 $('#cver').show();
                 return false;
             }
             return true;

         }

         function checkTip(){
             var tip =  $('#tip').val();
             if (tip == ''){
                 $('#ctip').show();
                 return false;
             }

             if ($('#tip').val().length > 30 ){
                 $('#cm').show();
                 return false;
             }

             return true;

         }


         function checkAll(){
            var user = checkUser();
            var nickname = checkNickName();
            var pwd = checkPwds();
            var checkPwd =  checkComPwd();
            var ver = checkVer();
            var tip = checkTip();
            if ( ! user || ! nickname || !pwd || !checkPwd || !ver  || !tip) {
                 return false;
            }
            return true;
         }
       $('#sub').click(
             function(){
                // var fg =  checkAll();
                 fg = true;
                 if ( ! fg ) {
                     return ;
                 }
                $('#demoform-1').submit();
             }

       );


     </script>
</html>