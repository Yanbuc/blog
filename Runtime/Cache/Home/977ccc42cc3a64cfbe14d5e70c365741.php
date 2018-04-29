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
<body>


          <h1><?php echo ($data['title']); ?></h1>
          <div>
             <?php echo ($data['content']); ?>
          </div>
          <a href="<?php echo U('Home/Index/index');?>">回到首页</a>
          <a href="#" id="ac" onclick="backen()">上一页</a>
         <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
</head>
<body>
        <h1>留言板</h1>

</body>
</html>
</body>
</html>