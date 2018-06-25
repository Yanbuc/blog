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
<form action="<?php echo U('Home/Login/checkLogin');?>" method="post" class="form form-horizontal" id="demoform-1">
    <div class="row cl" >
        <label class="form-label col-xs-4 col-sm-3">用户名：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" autocomplete="off" placeholder="用户名" style="width:40%;" id="user" name="user">
            <span style="font-size: 20px;color:red; display:none;" id="cuse">没有输入验证码</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($error['userError']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="password" class="input-text" autocomplete="off" placeholder="密码" style="width:40%;" id="password" name="password">
            <span style="font-size: 20px;color:red; display:none;" id="cpwd">没有输入验证码</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($error['passwordError']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">验证码</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="ver" name="ver" type="text" class="input-text" autocomplete="off" placeholder="验证码" style="width:20%;" >
            <img  src="<?php echo U('Home/Login/showCheckCode');?>" onclick="this.src = '<?php echo U('Home/Login/showCheckCode');?>'"/>
            <span style="font-size: 20px;color:red; display:none;" id="cver">没有输入验证码</span>
            <span style="font-size: 20px;color:red; " ><?php echo ($error['checkCodeError']); ?></span>
        </div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input class="btn btn-primary radius" type="button" value="登录" id="sub1">
        </div>
    </div>
</form>
</body>
  <script>
             $('#sub1').click(
                            function(){
                                /*
                                     $fg = checkAll();
                                     if ( !$fg ) {
                                          return false;
                                     }
                                 */
                                $('#demoform-1').submit();

                                   /*
                                     var data = {};
                                     data.user = $('#user').val();
                                     data.password = $('#password').val();
                                     data.ver = $('#ver').val();
                                     $.ajax({
                                           type:'post',
                                           url:'<?php echo U('Home/Login/checkLogin');?>',
                                           data:{"data":JSON.stringify(data)},
                                           success:function(data) {
                                                console.log(data);
                                           },
                                           error:function(e,x){

                                           }


                                     });
                                     */
                            }
             );
             function checkUser(){
                  var user = $('#user').val();
                  if (user == '') {
                    $('#cuse').show();
                     return false;
                  }
                  return true;
             }
             function checkPwd(){
                 var password = $('#password').val();
                 if (password == '') {
                     $('#cpwd').show();
                     return false;
                 }
                 return true;
             }
           function checkCheckCode(){
                 var checkCode = $('#ver').val();
                 if ( checkCode == '' ) {
                     $('#cver').show();
                     return false;
                 }
                 return true;
           }

           function checkAll(){
               var user = checkUser();
               var pwd = checkPwd();
               var checkCode = checkCheckCode();
               if (! user || ! pwd || ! checkCode ) {
                   return false;
               }
               return true;
           }

  </script>

</html>