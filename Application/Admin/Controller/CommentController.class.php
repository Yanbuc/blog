<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/12
 * Time: 18:32
 */

namespace Admin\Controller;
use \Common\Controller\AdminBaseController;
use \Common\Model\CommentModel;
use \Think\Page;

class CommentController extends  AdminBaseController
{
    protected $commentModel =  null;
   public function __construct()
   {
       parent::__construct();
       $this->commentModel =  new CommentModel();
   }

   public function showList(){
       $count = $this->commentModel->getCommentNum();
       if (! $count ) {
           //没有审核信息
           $this->assign('infor','所有的信息已经审核完成');
           $this->display();
           return ;
       }

       //有了需要审核的信息
       //创建分页类
       $page =  new Page($count,10);
       $data = $this->commentModel->selectAllComment($page);
       //因为上面已经检验了，所以是一定存在数据的。
       $show = $page->show();
       $this->assign('page',$show);
       $this->assign('data',$data);
       $this->display();
    }

    public function checkComment(){
       //是仅仅修改一项，还是修改很多项的标志
         $fg = I('post.fg');
         $data = array();
         $da = array();
        if ( $fg == 1) {
           $data['cid'] = I('post.cid','',intval);
           $da['is_checked'] = I('post.is_checked','',intval);
           if ( empty( $data ) || empty( $da ) ) {
               $this->ajaxError('',404,'审核未通过');
               return ;
           }

           $rn = $this->commentModel->updateComment($data,$da);
           if ( $rn ) {
               $this->ajaxSuccess('',200,'审核完成');
           }
           else {
               $this->ajaxError('',404,'审核未通过');
           }
        }
        else {

        }

    }

}