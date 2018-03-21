<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
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

</head>
<body>
    <form  action="<?php echo U('PutBlog/uploadBlog');?>" enctype="multipart/form-data" method="post" id="fm" name="myform" style="position: absolute;left:200px;">
    <table class="table table-border table-bordered radius">
        <thead>
        <tr>
            <th>分类</th>
            <th> <select>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($i % 2 );++$i;?><option value="<?php echo ($da["id"]); ?>">
                        <?php echo ($da["category"]); ?>
                    </option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>博客题目</th>
            <td><input type="text" class="input-text" autocomplete="off" placeholder="博客题目" name="title" id="acc" style="width:200px;">
            </td>
        </tr>
        <tr>
            <th>博文选择</th>
            <td><input type="file" multiple name="file"></td>
        </tr>
        <tr>
            <th><input class="btn btn-primary radius" type="button" value="上传" id="sub" ></th>
        </tr>
        </tbody>
    </table>
    </form>
<!--
<form  action="<?php echo U('PutBlog/uploadBlog');?>" enctype="multipart/form-data" method="post" id="fm" name="myform" style="position: absolute;left:200px;">
   <div class="row cl">
       <label class="form-label col-xs-4 col-sm-3" >分类</label>
        <select>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($i % 2 );++$i;?><option value="<?php echo ($da["id"]); ?>">
                    <?php echo ($da["category"]); ?>
                </option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3" >博客题目</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" autocomplete="off" placeholder="博客题目" name="title" id="acc" style="width:200px;">
        </div>
    </div>
    <div class="formControls col-xs-8 col-sm-9">
    <span >
         <label >博文选择</label>  <input type="file" multiple name="file">
    </span>
    </div>

    <div class="formControls col-xs-8 col-sm-9">
         <span class="btn-upload form-group" >
              <input class="btn btn-primary radius" type="button" value="上传" id="sub" >
         </span>
    </div>
</form>
-->
</body>
<script>
    $('#sub').click(function(){
        var cid =$('option:selected').val();
        var file = document.myform.file.files[0];
        var title =document.myform.title.value;
        var fm =new FormData();
        fm.append('cid',cid);
        fm.append('file',file);
        fm.append('title',title);
        $.ajax({
            url: "<?php echo U('PutBlog/uploadBlog');?>",
            type: 'POST',
            cache: false,
            data: fm,
            // dataType:'json',
            processData: false,
            contentType: false,//一开始问题是出现在这里
            success:function(data){
                if (data.status == 200) {
                    alert(data.information);
                }
                else {
                    console.log(data.information);
                }
            },
            error:function(e,x){
                console.log(x);
            }

        });

    });
    </script>
</html>