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
<body style="overflow-x: hidden">


          <h1><?php echo ($data['title']); ?></h1>
          <input type="hidden" value="<?php echo ($bid); ?>" id="bid"/>
          <div>
             <?php echo ($data['content']); ?>
           </div>
          <div style="position:relative;left:150px;">
              <label><h3>评论：</h3></label>
              <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$com): $mod = ($i % 2 );++$i;?><div>
                        <span><?php echo ($com['prefix']); ?></span>
                        <span style="color: red;"><b><?php echo ($com['name']); ?></b></span><br/>
                        <span><?php echo ($com['prefix']); ?></span><span><?php echo ($com['comment']); ?></span>&nbsp;&nbsp;<span class="response">回复</span>
                        <div style="display: none;" class="resText">
                            <form >
                                <span><?php echo ($com['prefix']); ?></span>
                                <input type="text"  class=".su"/>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" value="发表"  class="fa"/>
                                <input type="hidden" value="<?php echo ($com['cid']); ?>">
                            </form>
                            <span><?php echo ($com['prefix']); ?></span> <span class="shadow"><b>隐藏</b></span>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
         
<div>
    <form >
    <textarea placeholder="留言板"  name="comment"  style="width:600px;height:200px;font-size:22px;position:relative;left:70px;" id="words"></textarea>
    <br/> <input type="button"  id="comment" style="width:120px;height:40px;position:relative;left:180px;"  value="发表评论" onclick="subWords()">
    </form>
</div>




          <div style="position:relative;left:250px;" >
              <a href="<?php echo U('Home/Index/index');?>">回到首页</a>
              <a href="#" id="ac" onclick="backen()">上一页</a>
          </div>

</body>
<script src="<?php echo (H_UI_PATH); ?>lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
<script>
    var flag;
    //为回复按钮 设置动作
      $('.response').click(
             function (){
                 //这里还缺乏的就是 对于用户是否已经登录的检验。
                 $('.resText').hide();
                 $(this).next().show();
             }

      );
      $('.shadow').click(
            function (){
                $(this).parent().hide();

            }

      );
    function subWords(){
        var text = $('#words').val();
        var bid = $('#bid').val();
        var pid = 0;
        $.ajax({
            type:'post',
            url:'<?php echo U('Home/Comment/checkUserLogin');?>',
            dataType:'JSON',
            success:function(data) {
                if (data.status == 200) {
                    if (text == '') {
                        layer.msg("请输入评论");
                        return ;
                    }
                    $.ajax({
                        type:'post',
                        url:'<?php echo U('Home/Comment/addWords');?>',
                        data:{
                            "text":JSON.stringify(text),
                            "bid":bid,
                            "pid":pid,
                        },
                        dataType:"JSON",
                        success:function(data) {
                            if (data.status  ==200) {
                                window.location.reload();
                                return ;
                            }
                            else {
                                layer.msg(data.information);
                                window.location.reload();
                                return
                            }
                        },
                        error:function(e,x) {
                            layer.msg("sorry error");
                            console.log(x);
                        }
                    })
                    return ;
                }
                layer.msg('用户没有登录');
                window.flag =false;
            },
            error:function(e,x) {
                console.log(x);
            }
        })





    }

  //发表评论
    $('.fa').click(function(){
         var  prev = $(this).prev();
         var next = $(this).next();
         var text = prev.val();
         var pid = next.val();
         var bid = $('#bid').val();
         if (text == '' ) {
             layer.msg("请输入评论");
             return ;
         }
         if (pid == ''){
             layer.msg("莫名错误");
             return ;
         }
          $.ajax({
              type:'post',
              url:'<?php echo U('Home/Comment/checkUserLogin');?>',
              dataType:'JSON',
              success:function(data){
                  if (data.status == 200) {
                      $.ajax({
                          type:'post',
                          url:'<?php echo U('Home/Comment/addWords');?>',
                          data:{
                              "text":JSON.stringify(text),
                              "bid" :bid,
                              "pid":pid,
                          },
                          dataType:'JSON',
                          success:function(data){
                              if (data.status == 200) {
                                  window.location.reload();
                                  return ;
                              }
                              else {
                                  layer.msg(data.information);
                                  //window.location.reload();
                                  return
                              }
                          },
                          error:function(e,x){
                              layer.msg("error");
                              return ;
                          }
                      })
                  }
                  else {
                      layer("尚未登录,w无法发表评论");
                      return ;
                  }
              },
              error:function(e,x){
                  layer.msg("error");
                  console.log(x);
              }
          })
    });



</script>
</html>