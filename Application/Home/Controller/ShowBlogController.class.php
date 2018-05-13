<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/30
 * Time: 17:58
 */

namespace Home\Controller;
use \Common\Controller\HomeBaseController;
use \Common\Model\BlogsModel;
 use  \Home\Controller\HomeCommentController;
class ShowBlogController extends  HomeBaseController
{
    protected $blogsModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->blogsModel = new BlogsModel();
    }

    //展示博客
    public function showBlog(){

        if (IS_GET){
          //这里不仅仅要展示博客，还要展示评论
              $data['id'] = I('get.bid');
              $da = $this->blogsModel->findData($data);
              $da = $this->transhtml($da);
              $this->assign('data',$da);

              //获得评论 并且展示
              $commentController =   new HomeCommentController();
              $tree = $commentController->showCommentList($data['id']);
              $this->assign('tree',$tree);



              $this->display();
        }
        else {
            $this->redirect('Index/index');
        }
    }

    protected function transhtml($data){

      $data['content'] = htmlspecialchars_decode($data['content']);
      return $data;
    }


}