<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/22
 * Time: 22:05
 */

namespace Think\Template\TagLib;
use Think\Template\TagLib;

class My extends TagLib
{

    protected $tags=array(
        'fg' => array(
                      'attr' => '',
                      'close' => 0
                      ),
        'ueditor'=> array('attr'=>'name,content','close'=>0),
    );

    //标签

    public function _ueditor($tag){
        $name ='content';
            //isset($tag['name']) ? $tag['name'] :'content';
        $content = isset($tag['content']) ? $tag['content'] : '';
        //这里的话，就是有疑惑。
        $link = <<< php
<script id="container" name="$name" type="text/plain">
       $content
  </script>
<!-- 配置文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/utf8-php/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>

php;

         return $link;

    }







    public function _fg(){
        $link = <<<php
 <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <title>月歌的后台页面</title>
    <link rel="Bookmark" href="__ADMIN_PATH__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ADMIN_PATH__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__ADMIN_PATH__/lib/html5.js"></script>
    <script type="text/javascript" src="__ADMIN_PATH__/lib/respond.min.js"></script>
    <![endif]-->
    <link href="__ADMIN_STATIC_PATH__/h-ui/css/H-ui.css" rel="stylesheet" type="text/css" />
    <link href="__ADMIN_PATH__/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--<link href="__ADMIN_PATH__/h-ui/css/style.css" rel="stylesheet" type="text/css" />--><!--自己的样式-->
    <!--[if IE 6]>
    <script type="text/javascript" src="__ADMIN_PATH__lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('.pngfix,.icon');</script>
    <![endif]-->
    <script type="text/javascript" src="__ADMIN_PATH__/lib/jquery/1.9.1/jquery.min.js"></script>
php;

        return $link;
    }


}
