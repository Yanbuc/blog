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

<body style="background-image: url(<?php echo (IMAGE_PATH); ?>admin.jpg);background-size: 100%;">
<div>
    <form action="<?php echo U('Admin/Index/checkLogin');?>" method="post" class="form form-horizontal" id="demoform-1"style="width:50%" >
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3" style="color:greenyellow;">账号</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" autocomplete="off" placeholder="帐号" name="acc" id="acc" style="width:200px;">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3" style="color:greenyellow;" >密码</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="password" class="input-text" autocomplete="off" placeholder="密码" name="pwd" id="pwd" style="width:200px;">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3" style="color:greenyellow;">验证码</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" autocomplete="off" placeholder="验证码" name="ck" id="ck" style="width:200px;"><br/><br/>
                <img src="<?php echo U('Admin/Index/showCheckCode');?>" onclick="this.src='<?php echo U('Admin/Index/showCheckCode');?>'" />
            </div>
        </div>
        <div class="row cl" >
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="button" value="登录" id="sub" >
            </div>
        </div>
    </form>
</div>
</body>
<script>
      $('#sub').click(function(){
          var ob={};
          ob.acc = $('#acc').val();
          ob.pwd = $('#pwd').val();
          ob.ck  = $('#ck').val();
          $.ajax({
                url:"<?php echo U('Admin/Index/checkLogin');?>",
                type:'post',
                data:{
                    "data":JSON.stringify(ob),
                 },
               dataType:'JSON',
                success:function(data,textStatus){
                    if (data.status == 200) {
                         window.location = data.data;
                         alert(data.information);
                   }
                   else {
                         console.log(data.information);
                   }
                 },
               error :function(e,r,x){
                    console.log(e);
               }
          });

      });

</script>

<script type="text/javascript" src="<?php echo (H_UI_STATIC_PATH); ?>h-ui/js/H-ui.js"></script>
</html>