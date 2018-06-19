<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($data['title']); ?></title>
    <style>
        a{
            text-decoration: none;
        }
    </style>
    <script>
        function backen(){
            window.history.back();
        }
    </script>
    
     <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <title>月歌的后台页面</title>
    <link rel="Bookmark" href="/blog/Public/H-ui/favicon.ico" >
    <link rel="Shortcut Icon" href="/blog/Public/H-ui/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/blog/Public/H-ui/lib/html5.js"></script>
    <script type="text/javascript" src="/blog/Public/H-ui/lib/respond.min.js"></script>
    <![endif]-->
    <link href="/blog/Public/H-ui/static/h-ui/css/H-ui.css" rel="stylesheet" type="text/css" />
    <link href="/blog/Public/H-ui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--<link href="/blog/Public/H-ui/h-ui/css/style.css" rel="stylesheet" type="text/css" />--><!--自己的样式-->
    <!--[if IE 6]>
    <script type="text/javascript" src="/blog/Public/H-uilib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('.pngfix,.icon');</script>
    <![endif]-->
    <script type="text/javascript" src="/blog/Public/H-ui/lib/jquery/1.9.1/jquery.min.js"></script>
</head>
<body style="overflow-x: hidden">


          <h1><?php echo ($data['title']); ?></h1>
          <div>
             <?php echo ($data['content']); ?>
           </div>
          <div style="position:relative;left:150px;">
              <label><h3>评论：</h3></label>
              <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$com): $mod = ($i % 2 );++$i;?><div>
                        <span><?php echo ($com['prefix']); ?></span>
                        <span style="color: red;"><b><?php echo ($com['name']); ?></b></span><br/>
                        <span><?php echo ($com['prefix']); ?></span><span><?php echo ($com['comment']); ?></span>&nbsp;&nbsp;<span class="response">回复</span>
                        <div style="display: none;" class="resText">
                            <form>
                                <span><?php echo ($com['prefix']); ?></span><input type="text" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="发表" />
                            </form>
                            <span><?php echo ($com['prefix']); ?></span> <span class="shadow"><b>隐藏</b></span>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>

          </div>
         <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
</head>
<body>
<div>
    <form>
    <textarea placeholder="留言板"  name="comment"  style="width:600px;height:200px;font-size:22px;position:relative;left:70px;"></textarea>
    <br/> <input type="button"  id="comment" style="width:120px;height:40px;position:relative;left:180px;"  value="发表评论">
    </form>
</div>


</body>
</html>

          <div style="position:relative;left:250px;" >
              <a href="<?php echo U('Home/Index/index');?>">回到首页</a>
              <a href="#" id="ac" onclick="backen()">上一页</a>
          </div>

</body>
<script>
    //为回复按钮 设置动作
      $('.response').click(
             function (){
                 //这里还缺乏的就是 对于用户是否已经登录的检验。
                 $('.resText').hide();
                 $(this).next().show();
             }

      );
      $('.shadow').click(
            function (){
                $(this).parent().hide();

            }

      );

      //向前端的后台部分发送请求 查看是否登录
     function checkIsLogin(){


     }



</script>
</html>