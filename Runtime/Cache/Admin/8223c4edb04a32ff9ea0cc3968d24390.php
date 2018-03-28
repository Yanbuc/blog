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

<table class="table table-border table-bordered">
    <thead>
    <tr>
        <th>序号</th>
        <th>博客分类</th>
        <th>博客标题</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($k % 2 );++$k;?><tr>
            <td><?php echo ++$xu;?></td>
            <td><?php echo ($da["cat"]); ?></td>
            <td><?php echo ($da["title"]); ?></td>
            <td><span value="<?php echo ($da['id']); ?>" onclick="edit()">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;<span value="<?php echo ($da['id']); ?>" class="del" >删除</span></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
<script>
   function edit(){
       alert('hello');
   }




   $('.del').click(function(){
       var id =$(this).attr('value');
       layer.confirm('是否删除', {icon: 3, title:'提示'}, function(index){
           $.ajax({
               url:"<?php echo U('Admin/PutBlog/deleteBlog');?>",
               type:'post',
               data:{'id':JSON.stringify(id)},
               dataType:'json',
               success:function(data){
                  if (data.status == 200){
                       layer.msg('删除成功', {icon: 1,time:2000},function(){
                           window.location.reload();
                       });
                   }
                   else {
                       layer.msg('删除失败', {icon: 2,time:2000},function(){
                           window.location.reload();
                       });
                   }
               },
               error:function(e,x){
                   console.log(x);
               }
           });

           layer.close(index);
       });



   });
   $('select#opn').change(function(){
       var url = "<?php echo U('Admin/PutBlog/showList');?>";
       url = url.replace('.html','');
       var a = $('option:selected').text();
       url = url + '/'+'size'+'/'+a;
       window.location= url;
   });
   $(document).ready(
             function(){
                 var c = $('option');

                 var i=0;
                 for(;i<c.length;i++){
                     if (c[i].text == '<?php echo ($size); ?>'){
                        c[i].selected=true;
                         break;
                     }
                 }
             }

   );

</script>