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

   public function checkIsTrue($data){

       $rn = $this->usersModel->create($data);
       return $rn;
   }


}