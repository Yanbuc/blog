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

<!--显示所有的评论 -->
<body>
<table class="table table-border table-bordered">
    <thead>
    <tr>
        <th><input type="checkbox"></th>
        <th>用户名</th>
        <th>博客标题</th>
        <th>评论内容</th>
        <th>审核</th>
        <th>编辑</th>
    </tr>
    </thead>
    <tbody>
     <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($i % 2 );++$i;?><tr>
        <th><input type="checkbox" value="<?php echo ($da['cid']); ?>"></th>
        <th><?php echo ($da['name']); ?></th>
        <th><?php echo ($da['title']); ?></th>
        <th><?php echo ($da['comment']); ?></th>
        <th> <?php if($da['is_checked'] == 1): ?><i class="Hui-iconfont  ckk"  style="font-size: 25px;"  >&#xe6e1;</i> <i class="Hui-iconfont  cgg"  style="font-size: 25px; color:red;display: none;" >&#xe6dd;</i><span  style="display:none "><?php echo ($da['cid']); ?></span> <?php else: ?>
            <i class="Hui-iconfont  ckk"  style="font-size: 25px;display: none;" >&#xe6e1;</i><i class="Hui-iconfont  cgg"  style="font-size: 25px; color:red;"   >&#xe6dd;</i><span  style="display:none "><?php echo ($da['cid']); ?></span><?php endif; ?>

        </th>
        <th><i class="Hui-iconfont  ckk"  style="font-size: 25px;" >&#xe6e2;</i></th>

        <!--<th>操作</th> -->
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<span style="font-size: 28px;color: red;"> <?php echo ($infor); ?></span>
<span style="position:absolute;right:200px;"><?php echo ($page); ?></span>

<!--<button class="btn btn-success radius" type="button" value="成功" style="position:absolute;right:600px;">保存</button> -->

<script src="<?php echo (H_UI_PATH); ?>lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
</body>
  <script>



            $('.ckk').click(
                function(){
                    var g = $(this).next();
                    var cid = g.next().text();
                    var is_checked = 0;
                    m = $(this);
                    $.ajax({
                              type:'post',
                              url:'<?php echo U('Admin/Comment/checkComment');?>',
                              data:{"cid":cid,
                                     "fg":1,
                                     "is_checked": is_checked
                                   },
                              dataType:'json',
                              success:function(data){
                                    if (data.status == 200 ) {
                                        m.hide();
                                        g.show();
                                      return ;
                                    }
                                    else {
                                          layer.msg('审核不成功',{icon:2,time:2000});
                                    }
                              }


                           });


                }
            );
           $('.cgg').click(
                 function(){
                     var g = $(this).prev();
                     var cid = $(this).next().text();
                     var is_checked = 1;
                     var m = $(this);
                     $.ajax({
                         type:'post',
                         url:'<?php echo U('Admin/Comment/checkComment');?>',
                         data:{"cid":cid,
                             "fg":1,
                             "is_checked": is_checked
                         },
                         dataType:'json',
                         success:function(data){
                             if (data.status == 200 ) {
                                m.hide();
                                 g.show();
                                 return ;
                             }
                             else {
                                 layer.msg('审核不成功',{icon:2,time:2000});
                             }
                         }


                     });




                 }
           );









  </script>
</html>