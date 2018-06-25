<?php
/**
 * Created by PhpStorm.
 * User: shenlei
 * Date: 2018/6/25
 * Time: 11:41
 */

namespace Home\Controller;

use \Common\Controller\HomeBaseController;
use \Common\Model\CommentModel;
class CommentController extends HomeBaseController
{
   public function __construct()
   {
       parent::__construct();
   }
   public function addWords(){
        $fg = $this->checkIsLogin();
        if (!$fg) {
            $this->ajaxError('',404,'没有登录无法发表评论');
            return ;
        }
        $data['comment'] = I('post.text');
        $data['comment'] = json_decode($data['comment']);
        $data['uid'] =session('uid');
        $data['bid'] = I('post.bid');
        $data['pid'] = I('post.pid');
        if (empty($data['uid']) || empty($data['bid']) || !isset($data['pid']) ) {
            $this->ajaxError('',404,'信息不全');
            return ;
        }
        $data['is_checked'] =  0;
        $data['create_time'] = time();
        $data['del'] = 0;
        $com = new CommentModel();
        $com->add($data);
        $this->ajaxSuccess('',200,'');

   }
   //检查是否已经登录
   protected function checkIsLogin(){
       $uid = session('uid');
       $username = session('username');
       if(!$uid || !$username) {
           return false;
       }
       return true;

   }
   public function checkUserLogin(){
       $uid = session('uid');
       $username = session('username');
       if (!$uid || ! $username ) {
           $this->ajaxError('',404,'');
           return ;
       }
       $this->ajaxSuccess('',200,'');

   }
}