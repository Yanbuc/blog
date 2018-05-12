<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/6
 * Time: 20:11
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class CommentModel extends BaseModel
{

      //获得与评论相关的数据
       public function selectAllComment($page){
           $alias = array(
               'comment.cid' => 'cid',
               'comment.comment' => 'comment',
               'users.name' => 'name',
               'comment.is_checked' => 'is_checked',
               'blogs.title' => 'title'
           );
          $sql = $this -> join('blogs on comment.bid = blogs.id')
                      ->join('users on comment.uid = users.id')
                      ->field($alias)
                      ->where('is_checked=0')
                      ->order('comment.create_time desc')
                      ->limit($page->firstRow.','.$page->listRows)
                      ->select();
          return $sql;
       }
       public function getCommentNum(){
           $alias = array(
               'comment.cid' => 'cid',
               'comment.comment' => 'comment',
               'users.name' => 'name',
               'comment.is_checked' => 'is_checked',
               'blogs.title' => 'title'
           );
           $sql = $this -> join('blogs on comment.bid = blogs.id')
               ->join('users on comment.uid = users.id')
               ->field($alias)
               ->where('is_checked=0')
               ->select();
           return count($sql);

       }


       //修改评论
       public function updateComment($map,$data){
            $this->startTrans();
            $rn = $this->where($map)->save($data);
            if (! $rn) {
                $this->rollback();
                return false;
            }
            $this->commit();
            return true;
       }

}