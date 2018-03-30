<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
          .tiao{
                background-image: url(<?php echo (IMAGE_PATH); ?>bkc.jpg);
                background-size: 100%;
                margin: 15px;
                height:40px;
                width:40%;
          }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body >

         <?php if(is_array($da)): $i = 0; $__LIST__ = $da;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="tiao"><a href="<?php echo U('Home/ShowBlog/showBlog',array('bid'=> $data['id']));?>"><!--href="<?php echo (CITE_ROOT); ?>blog/<?php echo ($data['avatar']); ?>" --> <?php echo ($data["title"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($data["create_time"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>

         <a href="<?php echo U('Home/Index/index');?>">回到首页</a>

</body>
</html>