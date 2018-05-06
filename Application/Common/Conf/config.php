<?php
return array(
	//'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => 'db',
    //设置全局过滤
    'DEFAULT_FILTER'        =>  'strip_tags',
    //开启字段映射
    'READ_DATA_MAP'  => true,
    //*********************************************

    'JWT_KEY'              => 'SH8>KL!,HJSKLNMaah45',
    'JWT_ALG'             =>  'HS256',
   //************************************************

    //************************************************
    //开启页面调试模式
   // 'SHOW_PAGE_TRACE' =>false,
    //路由在Linux下面不分大小写
    //'URL_CASE_INSENSITIVE' => true,

    //预加载标签
    /*
    'TAG_BUILD_IN' => 'Cx,Common\Tag\My',
   */

    //定义常用路径


    'TMPL_PARSE_STRING' => array(
        '__ADMIN_PATH__' => __ROOT__.'/Public/H-ui',
       '__ADMIN_STATIC_PATH__' => __ROOT__.'/Public/H-ui/static',
       '__BLOG_PICTURE_PATH__' => __ROOT__.'/article',


    ),

    //
    'IMAGE_TITLE_ALT_WORD' => '月歌博客',

    //博客图片路径

    'BLOG_IMAGE_PATH' => CITE_ROOT.'blog/article/',

    'SHOW_PAGE_TRACE' =>true,
//*************************************************************************
    //验证码配置
    'VERIFY_PEIZHI' => array(

        'length' => 4,
    ),

//****************************
//定义注册的配置
    //用户名长度
    'USER_LENGTH' => 20,
    //昵称长度
    'NICKNAME_LENGTH' => 20,
   //个性签名的长度
    'TIP_LENGTH' => 30,




);
