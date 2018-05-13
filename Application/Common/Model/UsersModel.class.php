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

    public function getPwdAndIdAndRole($data){
        $arr = array(
                        'users.password' => 'password',
                        'role.r_name' => 'role',
                        'users.id' => 'id'

                    );
        $da = $this->join('role on users.rid = role.rid ')
                   ->where($data)
                   ->field($arr)
                   ->find();
       return $da;
    }


}