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
</head>
<body style="overflow-x: hidden">


          <h1><?php echo ($data['title']); ?></h1>
          <div>
             <?php echo ($data['content']); ?>
           </div>
         <div style="position:relative;left:250px;" >
          <a href="<?php echo U('Home/Index/index');?>">回到首页</a>
          <a href="#" id="ac" onclick="backen()">上一页</a>
         </div>  
       <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
</head>
<body>
<div>
    <textarea placeholder="留言板" style="width:600px;height:200px;font-size:22px;position:relative;left:70px;"></textarea>
    <br/> <button type="button"  id="comment" style="width:120px;height:40px;position:relative;left:180px;"  >发表评论</button>
</div>


</body>
</html>

</body>
</html>