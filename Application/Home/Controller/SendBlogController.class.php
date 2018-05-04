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

    //这里的查找数据需要修改。
    public function showList(){
        $data['cid']=I('get.id');
        $rn=$this->blogsModel->selectData($data);
        $rn = $this->transTime($rn);
        $this->assign('da',$rn);
        $this->display();
    }

    //转化时间格式
    protected function  transTime($data){
        foreach($data as $key => &$value){
            $value['create_time'] = date('Y-m-d h:i:s',$value['create_time']);
        }
        return $data;

    }



}