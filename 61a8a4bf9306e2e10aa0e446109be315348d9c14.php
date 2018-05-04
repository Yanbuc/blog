<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

define('BIND_MODULE','Admin');

define('CITE_ROOT','http://192.168.182.129/');

//define('CITE_ROOT','yuegeable.cn/');
// 定义应用目录
define('APP_PATH','./Application/');

define('TMPL_PATH','./Tpl/');

define('RUNTIME_PATH','./Runtime/');

define('IMAGE_PATH',CITE_ROOT.'blog/Public/static/images/');
define('H_UI_PATH',CITE_ROOT.'blog/Public/H-ui/');
define('H_UI_STATIC_PATH',CITE_ROOT.'blog/Public/H-ui/static/');
// 引入ThinkPHP入口文件

require './ThinkPHP/Library/Vendor/vendor/autoload.php';
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
