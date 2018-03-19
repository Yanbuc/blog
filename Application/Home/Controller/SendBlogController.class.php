<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 20:38
 */

namespace Home\Controller;
use \Common\Controller\HomeBaseController;
use \Common\Model\BlogsModel;
class SendBlogController extends HomeBaseController
{
    /*
     * 默认函数的话，应该是展示PHP页面
     * 将SendBlog页面当成将要展示的PHP页面
     */
    protected  $blogsModel=null;
    public function __construct()
    {
        parent::__construct();
        $this->blogsModel=new BlogsModel();
    }

    public function index(){

    }

    public function showList(){
        $data['cid']=I('get.id');
        $rn=$this->blogsModel->selectData($data);
        $this->assign('da',$rn);
        $this->display();

    }



}