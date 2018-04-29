<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/14
 * Time: 14:06
 */

namespace Common\Service;
use \Common\Model\UsersModel;

class UsersService
{
   protected $usersModel = null;
   public function __construct()
   {
       $this->usersModel = new UsersModel();
   }

   //检查用户登录的数据是否完整
   public function checkIsTrue($data){

       $rn = $this->usersModel->create($data);
       return $rn;
   }


}