<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
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
<body >
<form  action="<?php echo U('PutBlog/uploadBlog');?>" enctype="multipart/form-data" method="post" id="fm" name="myform" style="width:90%">
    <table class="table table-border table-bordered radius">
        <thead>
        <tr>
            <th>分类</th>
            <th>
                <select name="cid">
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
            <th>关键字</th>
            <td><input type="text" class="input-text" autocomplete="off" placeholder="关键字" name="keywords" id="key" style="width:200px;">
            </td>
        </tr>
        <tr>
            <th>描述</th>
            <td><input type="text" class="input-text" autocomplete="off" placeholder="描述，不多于50字" name="description" id="desc" style="width:200px;">
            </td>
        </tr>
        <tr>
            <th colspan="2">
                
                <script id="container" name="content" type="text/plain">
       
  </script>
<!-- 配置文件 -->
<script type="text/javascript" src="/blog/Public/ueditor/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/blog/Public/ueditor/utf8-php/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>

            </th>
        </tr>
        <tr>
            <th colspan="2"><input class="btn btn-primary radius" type="submit" value="上传" id="sub" ></th>
        </tr>
        </tbody>
    </table>
</form>


</body>




<script>
    /*
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
    */
</script>
</html>