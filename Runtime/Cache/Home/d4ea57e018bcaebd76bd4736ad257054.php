<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>月歌首页</title>
    <link rel="Shortcut Icon" href="<?php echo (H_UI_PATH); ?>favicon.ico" />
    <style>
      a:link {
          color:purple;
          text-decoration: none;
      }
      a:visited {
          color:purple;
          text-decoration: none;
      }
      a:hover {
          color:purple;
          text-decoration: none
      }
    </style>
</head>
<body>
      <h>欢迎来到月歌的博客</h> <div style="float:right;" ><a>登录</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo U('Home/Register/register');?>">注册</a></div>
      <div>
          <h3>文章分类</h3>
          <table>
           <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                   <td><a href="<?php echo U('Home/SendBlog/showList',array( 'id' => $data['id']));?>"><?php echo ($data["category"]); ?></a></td>
               </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </table>
      </div>
       <?php echo ($rn[0]['id']); ?>

</body>
</html>