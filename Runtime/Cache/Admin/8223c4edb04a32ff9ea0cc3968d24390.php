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

<div style="position: relative;left:350px;">
    <span style="float:left;position: relative;right:280px;"><!-- 修改分页的数量的公共部分-->

 <select style="width:100px;height:30px;font-size:15px;" name="size" id="slc">
     <option value="5">5</option>
     <option value="10">10</option>
     <option value="20">20</option>
     <option value="30">30</option>
 </select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span >    <form action="<?php echo U('Admin/PutBlog/showList');?>" method="post">
    <label style="font-size: 25px;"><b>搜索框</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="搜索内容" style="border-style:solid;width:150px;height:40px;" name="title" id="til" value="<?php echo ($searchData); ?>"/>
        <input type="hidden" name="size" id="hi" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" style="width:80px;height:40px;" value="查找">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" style="width:80px;height:40px;"  id="ref">刷新</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" style="width:80px;height:40px;" id="delall">批量删除</button>
        <br/><br>
    </form>
</span>
</div>
<table class="table table-border table-bordered">
    <thead>
    <tr>
        <th><input type="checkbox"></th>
        <th>序号</th>
        <th>博客分类</th>
        <th>博客标题</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($k % 2 );++$k;?><tr>
            <th><input type="checkbox" value="<?php echo ($da['id']); ?>" class="ck"></th>
            <td><?php echo ++$xu;?></td>
            <td><?php echo ($da["cat"]); ?></td>
            <td><?php echo ($da["title"]); ?></td>
            <td><a href="<?php echo ($url); ?>?id=<?php echo ($da['id']); ?> ">编辑</a>&nbsp;&nbsp;&nbsp;<span value="<?php echo ($da['id']); ?>" class="del" >删除</span></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<span><?php echo ($page); ?></span>
<script src="<?php echo (H_UI_PATH); ?>lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
<script>
    //编辑博客


   function edit(id){

        url = "<?php echo ($url); ?>";
        url = url + '?id=' +id;
         layer.open({
              title:"修改博客的内容",
               type:2,
               maxmin:true,
               content:url,
      });
   }
   //设计的专门为转换分页的条数。
 $('#slc ').change(function(){
        url = '<?php echo U('Admin/PutBlog/showList');?>';
        url = url + '?size=' + $(this).val();
        location.href = url;
 });

//为搜索框设置一个函数
   $('#til').blur(
       function(){
           //如果只是短暂的点击一下的话，就是什么都不进行操作
           val = $(this).val();
           if (val == ''){
               return ;
           }
           else {
               var size = $('#slc option:selected').val();
               $('#hi').val(size);
           }
       }
   );
//设置刷新
    $('#ref').click(
        function(){
            url = '<?php echo U('Admin/PutBlog/showList');?>';
             location.href = url;
        }
    );


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
                 setCheckBox();
             }

   );

   $('.ck').click(function(){
            $fg = $(this).prop('checked');
            if ($fg) {
                dealCookie('tmp',$(this).val());
            }
            else {
                dealCookieD('tmp',$(this).val());
            }
       }
   );

   function dealCookie(name,value){
        val = getCookie(name);
        //如果不存在这个cookie的话
        if (! val){
            //设置这个cookie的值
           setCookie(name,value);
        }
        else {
            //如果之前已经存在了这个值的haul，那么
            val=val+','+value;
            setCookie('tmp',val);
        }

   }
  function dealCookieD(name,value){
       val = getCookie(name);
       hk = '';
       if (! val ) {
           return ;
       }
       else {
           cm = val.split(',');
           for(i=0;i<cm.length-1;i++){
               if (! cm[i] ){
                   continue;
               }
               else {
                   if (cm[i] == value){
                       continue;
                   }
                   else {
                       hk = hk + ''+cm[i]+',';
                   }
               }
           }
           if (cm[i] ==  value){
               deleteCookie('tmp');
               setCookie('tmp',hk);
               return ;
           }
           hk = hk + ''+ cm[i];
           deleteCookie('tmp');
           setCookie('tmp',hk);
       }
  }








    function setCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }else{
            var expires = "";
        }
        document.cookie = name+"="+value+expires+"; path=/";
    }
    // 获取cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    // 删除cookie
    function deleteCookie(name) {
        setCookie(name,"",-1);
    }


//设置checkBox的状态
function setCheckBox(){
      ck =getCookie('tmp');
      if (! ck){
          return ;
      }
      cg = ck.split(',');
      cm = $('.ck');
      for(i=0;i<cg.length;i++){
          if (! cg[i]) {
              continue;
          }
          else {
              for(j=0;j<cm.length;j++){
                  if (cm[j].value == cg[i]) {
                      cm[j].checked ='checked';
                  }
              }

          }
      }
}
$('#delall').click(function(){
      var ckk =getCookie('tmp');
      if (! ckk ) {
          return ;
      }
      else {
          cg = ckk.split(',');
          cm = [];
          j=0;
          for (i=0;i<cg.length;i++) {
              if (!cg[i]) {
                  continue;
              }
              else {
                  cm[j] = cg[i];
                  j++;
              }
          }
          //然后就是进行传值
          $.ajax({
              type:'post',
              url:'<?php echo U('Admin/PutBlog/deleteAll');?>',
              data:{'id':JSON.stringify(cm)},
              dataType:'json',
              success:function (data) {
                  if (data.status == 200){
                      deleteCookie('tmp');
                      location.replace(location.href);

                  }
                  else {
                      deleteCookie('tmp');
                      layer.msg(data.information);
                      location.replace(location.href);
                  }
              },
              error:function(e,x){
                  console.log(x)
              }

          })

      }
});



</script>