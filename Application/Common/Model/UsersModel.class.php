<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/14
 * Time: 15:03
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class UsersModel extends BaseModel
{

    protected  $_map = array(
        'acc' => 'name',
        'pwd' => 'password'
    );


    public function getPassword($data){
       $rn = $this->where($data)->getField('password');
       return $rn;
    }



}