<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 18:19
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class CategoryModel extends BaseModel
{
    protected $ids = array();
    //返回数据库之中的记录的数目
   public function getCount(){
       $number = $this->count();
       return $number;
   }

   //获得标签的具体信息
    /*
     *  @param 条件
     *  @return array  flag 标志变量。
     */
   public function getCategoryDetail($map){
       $fg =array('flag'=>true);
       $data = $this->where($map)->find();
       if (empty($data)) {
           $fg['flag'] = false;
           return $fg;
       }else {
           $fg['data'] = array();
           $fg['data']['cname'] = $data['category'];
           if ($data['parent_id'] == 0 ){
               $temp = $this->getData("","");
               $fg['data']['pname'] = $temp;
           }
           else {
               $map2['id'] = $data['parent_id'];
               $data = $this->where($map2)->find();
               $temp = $this->getData($data["category"],$data['id']);
               $fg['data']['pname'] = $temp;
           }
           return $fg;
       }
   }
   //将一个步骤抽离出来 获得所有的标签
   protected function getData($ca,$id){
       $data = $this->select();
       $temp = array();
       $temp[] = array("category"=>$ca,"id"=>$id);
       foreach($data as $key=>$value ){
           if ($value['id'] == $id ){
               continue;
           }
           else {
               $temp[] = array("category"=>$value['category'],"id"=>$value['id']);
           }
       }
       return $temp;
   }


}