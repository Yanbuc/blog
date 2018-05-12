<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 18:02
 */

namespace Common\Controller;
use \Think\Controller;
class HomeBaseController extends Controller
{
   public function __construct(){
       parent::__construct();
   }


}

//缺少一个权限检验 这里。
