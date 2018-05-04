<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 18:42
 */

namespace Common\Model;
use \Think\Model;

class BaseModel extends Model
{

    /*
     * 添加数据，
     * 数据的参数是数组形式的。
     */

    public function addData($data){
        $rn = $this->add($data);
        return $rn;

    }
    /*
     * 删除数据
     */

    public function deleteData($map){
        $rn = $this->where($map)->delete();
        return $rn;

    }
    /*
     * 更新数据
     */
    public function updateDate($map,$data){
        $rn = $this->where($map)->save($data);
        return $rn ;

    }
    /*
     * 查找数据
     */
    public function selectData($map = array()){
           if (empty($map)) {
               $rn = $this->select();
               return $rn;
           }
           else {
               $rn = $this->where($map)->select();
               return $rn;
           }

    }

    public function findData($data = array()){
        if (empty($data)) {
            return array();
        }
        else {
            $data = $this->where($data)->find();
            return $data;
        }

    }


}