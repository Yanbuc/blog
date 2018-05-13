<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/7
 * Time: 12:02
 */

namespace Common\Model;
use \Think\Model\ViewModel;
class CommentViewModel extends  ViewModel
{
    public $viewFields = array(
          'comment' => array('cid','uid','comment','pid','is_checked','bid' ),
          'users'  => array('name','_on'=>'comment.uid = users.id')
    );
    //获得经过审核 同时评论的是这篇博客的评论
    public function selectData($data){

        $data = $this->where($data)->select();
        return $data;
    }
}