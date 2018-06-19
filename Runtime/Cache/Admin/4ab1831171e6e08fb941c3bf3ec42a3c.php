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
<table class="table table-border table-bordered radius">
    <thead>
    <tr>
        <th>编号</th>
        <th>类别</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($i % 2 );++$i;?><tr>
            <th><?php echo ++$xu;?></th>
            <td><?php echo ($da["category"]); ?></td>
            <td>编辑&nbsp;&nbsp;&nbsp;&nbsp;<span onclick="editConfirm('<?php echo ($da['id']); ?>')" >删除</span></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<span>
      <?php echo ($page); ?>
</span>

</body>
<script type="text/javascript">
    //编辑验证
    function editConfirm( id){
        layer.confirm('是否删除?', {icon: 3, title:'提示'}, function(index){
              $.ajax({
                  url:"<?php echo U('Admin/Dictionary/deleteCategory');?>" ,
                  type:"post",
                  data:{"id":id},
                  dataType:'JSON',
                  success:function(data){
                      layer.msg('删除成功', {icon: 1,time:2000},function(){
                          window.location.reload();
                      });
                  },
                  error:function(imfor){
                      layer.msg('删除失败', {icon: 2,time:2000},function(){
                          window.location.reload();
                      });
                  }
              });

            layer.close(index);
        });

    }

   // layer.msg("只想弱弱提示");
</script>

<script type="text/javascript" src="<?php echo (H_UI_STATIC_PATH); ?>h-ui/js/H-ui.js"></script>
</html>