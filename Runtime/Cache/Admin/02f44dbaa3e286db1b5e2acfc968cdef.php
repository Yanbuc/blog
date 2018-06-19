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
        <form>
            <label>父级标签：&nbsp;&nbsp;&nbsp; </label>
            <select>
                <?php if(is_array($pname)): $i = 0; $__LIST__ = $pname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($i % 2 );++$i;?><option value="<?php echo ($da['id']); ?>"><?php echo ($da['category']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
           <!-- <input type="text" value="<?php echo ($pname); ?>" style="border:solid"/>--><br/>
            <label>标签名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input type="text" value="<?php echo ($cname); ?>" style="border:solid" id="cname"/><br/>
            <button type="button" style="width:100px;position:absolute;left:40px;heigth:30px;" onclick="getId()">修改</button>
        </form>
</body>
<script src="<?php echo (H_UI_PATH); ?>lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
<script>
              function getId(){
                  layer.confirm('是否更新?', {icon: 3, title:'提示'}, function(index){
                      var cname = $("#cname").val();
                      var id = $("select option:checked").val();
                      fname = checkName(cname);
                      fid = checkId(id);
                      if (!fname || ! fid ) {
                          layer.msg("信息不完整",{icon: 2,time:2000},function(index){
                              window.location.reload();
                          });
                          return ;
                      }

                  })



              }
              //检查id
              function checkId(id){
                  if (id == "") {
                      return false;
                  }
                  return true;
              }
              function checkName(name){
                  if (name == ""){
                      return false;
                  }
                  return true;
              }


</script>
</html>