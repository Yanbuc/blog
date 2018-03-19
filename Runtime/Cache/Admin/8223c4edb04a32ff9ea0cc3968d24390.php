<?php if (!defined('THINK_PATH')) exit();?><div style="width:100%;" >
    <select id="opn">
        <option selected="selected">4</option>
        <option>5</option>
        <option>6</option>
    </select><br />
    <table width="100%">
        <tr width="80%">
            <td width="25%">序号</td>
            <td width="25%">博客分类</td>
            <td width="25%">博客标题</td>
            <td width="25%">操作</td>
        </tr>
        <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($k % 2 );++$k;?><tr>
                <td><?php echo ++$xu;?></td>
                <td><?php echo ($da["cat"]); ?></td>
                <td><?php echo ($da["title"]); ?></td>
                <td><span value="<?php echo ($da['id']); ?>" onclick="edit()">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;<span value="<?php echo ($da['id']); ?>" class="del">删除</span></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </table>
    <span>
        <?php echo ($page); ?>
    </span>
</div>
<script type="text/javascript" src="<?php echo (H_UI_PATH); ?>lib/jquery/1.9.1/jquery.min.js"></script>
<script>
   function edit(){
       alert('hello');
   }
   $('.del').click(function(){
       var s =$(this).attr('value');
       $.ajax({
           url:"<?php echo U('Admin/PutBlog/deleteBlog');?>",
           type:'post',
           data:{'id':JSON.stringify(s)},
           dataType:'json',
           success:function(data){
               //alert(data);
               alert(data.information);
               window.location.reload();
           },
           error:function(e,x){
               console.log(x);
           }
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