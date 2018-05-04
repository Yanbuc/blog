<?php
return array(
	//'配置项'=>'配置值'

    //验证码配置
    'VERIFY_PEIZHI' => array(

                     'length' => 4,
    ),
    //上传文件的配置
    'UPLOAD_CONFIG' => array(
        'maxsize' =>3145728 ,
        'rootPath'   =>    './article/',
        'exts'       =>   'html',
        'autoSub' => false,

    )

);