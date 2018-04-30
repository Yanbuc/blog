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

<style>
      button{
              width:120px;
              height:40px;
      }
      #sew{
              background-image:url(<?php echo (IMAGE_PATH); ?>tiao.jpg);
              width:100%;
              height:15%;
      }
      #me{
              position:absolute;
              right:200px;

      }
      .Huifold .item{ position:relative}
      .Huifold .item h4{margin:0;font-weight:bold;position:relative;border-top: 1px solid #fff;font-size:15px;line-height:22px;padding:7px 10px;background-color:#eee;cursor:pointer;padding-right:30px}
      .Huifold .item h4 b{position:absolute;display: block; cursor:pointer;right:10px;top:7px;width:16px;height:16px; text-align:center; color:#666}
      .Huifold .item .info{display:none;padding:10px}
     #asd{
         width:20%;
         height:100%;
         float:left;
     }
    #bd{
        position: absolute;
        left:20%;
        width:80%;
        height:100%;
        overflow-x: hidden;
     }
    body{
         height:100%;
         margin:0px;


    }
    html{
        height:100%;
    }
    #first{
        height:100%;
        width:100%;
        margin:0px;
        padding:0px;
    }
    .ts{
        width:80px;
    }
</style>
<body >

 
  <div id="sew">
        <div class="group cl" id="me">
            </span> <span class="dropDown dropDown_hover"><a class="dropDown_A" href="#" style="font-size: 16px;">管理员功能</a>
					<ul class="dropDown-menu menu radius box-shadow">
                        <li><a href="#" style="font-size: 16px;" id="logout">退出</a></li>
						<li><a href="#" style="font-size: 16px;">退出</a></li>
					</ul>
					</span>
        </div>
  </div>


 <div id="first">
     <div id="asd">
  <ul id="Huifold1" class="Huifold">
      <li class="item">
          <h4>字典管理<b>+</b></h4>
          <div class="info" style="width:100%;padding:0px;">
              <button style="width:100%;margin:0px;" type="button" onclick="showDictionaryList()">字典列表</button>
              <br/><button style="width:100%;margin:0px;" type="button" >添加字典</button><br/>
              <button style="width:100%;margin:0px;" type="button" onclick="fenji()">字典分级</button>
          </div>
      </li>
      <li class="item">
          <h4>博客管理<b>+</b></h4>
          <div class="info" style="width:100%;padding:0px;">
              <button style="width:100%;margin:0px;" type="button" onclick="showList()">博客列表</button>
              <br><button style="width:100%;margin:0px;" type="button" onclick="upBlog()">上传博客</button>

          </div>
      </li>
      <li class="item">
          <h4>分类管理<b>+</b></h4>
          <div class="info">显示分类<br />隐藏分类选择</div>
      </li>
      <li class="item">
          <h4>暂时为空<b>+</b></h4>
          <div class="info"></div>
      </li>
  </ul>
     </div>

<div id="bd">
    <iframe style="width:100%;height:100%;overflow-x:hidden;"  id="ifm" >

    </iframe>
</div>
</div>
</body>

<script type="text/javascript" src="<?php echo (H_UI_STATIC_PATH); ?>h-ui/js/H-ui.js"></script>
</html>
<script>
    jQuery.Huifold = function(obj,obj_c,speed,obj_type,Event){
        if(obj_type == 2){
            $(obj+":first").find("b").html("-");
            $(obj_c+":first").show()}
        $(obj).bind(Event,function(){
            if($(this).next().is(":visible")){
                if(obj_type == 2){
                    return false}
                else{
                    $(this).next().slideUp(speed).end().removeClass("selected");
                    $(this).find("b").html("+")}
            }
            else{
                if(obj_type == 3){
                    $(this).next().slideDown(speed).end().addClass("selected");
                    $(this).find("b").html("-")}else{
                    $(obj_c).slideUp(speed);
                    $(obj).removeClass("selected");
                    $(obj).find("b").html("+");
                    $(this).next().slideDown(speed).end().addClass("selected");
                    $(this).find("b").html("-")}
            }
        })}
    $(function(){
        $.Huifold("#Huifold1 .item h4","#Huifold1 .item .info","fast",1,"click"); /*5个参数顺序不可打乱，分别是：相应区,隐藏显示的内容,速度,类型,事件*/
    });

    function showList(){
       var url= '<?php echo U('Admin/PutBlog/showList');?>';
       $('#ifm').attr('src',url);

    }
    //展示字典列表

    function showDictionaryList(){
        var url= '<?php echo U('Admin/Dictionary/index');?>';
        $('#ifm').attr('src',url);
    }


    function upBlog() {
        var url= "<?php echo U('Admin/PutBlog/showUploadBlog');?>";
        $('#ifm').attr('src',url);
        // $('#ifm').src=url;
    }

    function fenji(){
        var url= '<?php echo U('Admin/Dictionary/fenji');?>';
        $('#ifm').attr('src',url);

    }
    $('#logout').click(function(){
        url = '<?php echo U('Admin/Index/loginOut');?>';
        deleteCookie('tmp');
        location.href = url;

    })

    function setCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }else{
            var expires = "";
        }
        document.cookie = name+"="+value+expires+"; path=/";
    }
    // 删除cookie
    function deleteCookie(name) {
        setCookie(name,"",-1);
    }



</script>