<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/25
 * Time: 18:08
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class PictureModel extends BaseModel
{
    /*
     *  特殊的增加图片的接口，针对的是上传博客的时候使用的。
    */
/*
 * array(2) { [0]=> array(2) { ["bid"]=> string(2) "30" ["avatar"]=> string(45) "./article/image/20180325/1521974109601412.jpg" } [1]=> array(2)
 * { ["bid"]=> string(2) "30" ["avatar"]=> string(45) "./article/image/20180325/1521974108583898.jpg" } }
 */


      public function addDa($data){
          $da=array();
          foreach ($data['avas'] as $key => $value){

              $da[] = array(
                             'bid'=>$data['bid'],
                             'avatar' => $value,
                           );

          }
          $rn =$this->addAll($da);
          return $rn;

      }

      public function selectById($data){
          $rn = $this->selectData($data);
          return $rn;

      }



}