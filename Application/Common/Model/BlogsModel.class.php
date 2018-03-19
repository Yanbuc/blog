<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 18:17
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class BlogsModel extends BaseModel
{

    public function getId(){
        $rn = $this->max('id');
        $rn = $rn + 1;
        return $rn;
    }
  //模糊查询根据博客的标题。

   public function selectByTitle($data = array()){
      if (empty ($data)) {
          $rn = $this->selectData();
          return $rn;
      }
      else {
          $val='%'.$data['title'].'%';
          $data['title']=array('like',$val);
          $rn = $this->where($data)->select();
          return $rn;
      }

   }
   /*
    * 返回表格之中的数据的数目
    *
    */
   public function getCount(){
       $rn = $this->count();
       return $rn;
   }
   /*
    * 根据id 获得路径。
    */

   public function selectById($data = array()){

       if (empty($data)) {
           $rn = $this->selectData();
           return $rn;
       }
       else {
           $rn = $this->where($data)->getField('avatar');
           return $rn;
       }
   }


}