<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/26
 * Time: 13:27
 */

namespace Org\sl;


final class Data
{
     /*
      *  返回树形数据
      * 数据
      * 字段名
      * 主键
      * 父id
      *
     */

     static $c =array();

   static public function tree($data,$title='',$id='id',$parent="parent_id"){
          $data = self::channellist($data);
          foreach ($data as $n => &$v){
              if ($v['_level'] == 0){
                  $v['fg']="│";
              }
              else {
                   $v['fg']="└─";
              }
          }
          return $data;
   }


   static function channellist($data,$pid=0,$html='&nbsp;&nbsp;&nbsp;&nbsp;',$fieldpri ='id',$fieldpid='parent_id',$level=1){

       if (empty($data)) {
           return array();
       }
       $arr =array();
       //首先的话，就是判断他的父id 是不是等于
       foreach ($data as $v){
           $id = $v[$fieldpri];
           //如果父id == 0 的话
           if ($v[$fieldpid] == $pid) {
               //设置等级
               $v['_html'] =str_repeat($html,$level-1);
               $v['_level'] = $level-1;
               $arr[] =$v;
               $temp =  self::channellist($data,$id,$html,$fieldpri,$fieldpid,$level+1);
               $arr= array_merge($arr,$temp);
           }
       }
        return $arr;
   }


}
