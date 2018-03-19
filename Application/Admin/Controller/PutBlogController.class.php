<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/15
 * Time: 13:50
 */

namespace Admin\Controller;
use \Common\Controller\AdminBaseController;
use \Think\Upload;
use \Common\Model\BlogsModel;
use \Common\Model\CategoryModel;
class PutBlogController extends AdminBaseController
{
    protected $blogsModel = null;
    protected $categoryModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->blogsModel = new BlogsModel();
        $this->categoryModel = new CategoryModel();
    }
    //展示后台的登录之后的页面。
    public function index(){
        $this->display('index');
    }

    public function uploadBlog(){

         $data= I('post.');
         $data['cid'] =(int) $data['cid'];
         $config =  C('UPLOAD_CONFIG');
         $config['saveName'] = $this->blogsModel->getId().'';
         $upload = new Upload($config);
         $info = $upload->upload();
         if (! $info) {
             $this->ajaxError('',404,$upload->getError());
         }
         else {
             $avatar = './article/'.$info['file']['savename'];
             $data['avatar'] =$avatar;
             $rn = $this->addBlog($data);
             if ($rn) {
                 $this->ajaxSuccess('',200,'成功');
             }
             else {
                 $this->ajaxError('',404,'上传失败');
             }
         }

    }

    protected  function addBlog($data){
        $time = date('Y-m-d h:i:s',NOW_TIME);
        $data['create_time'] = $time;
        $rn =$this->blogsModel->addData($data);
        return $rn;
    }

    public function showList(){
        //查询的话，使用post吧
         $pageSize = empty($_GET['size']) ? 4 :$_GET['size'];
         $count = $this->blogsModel->getCount();
         $p = getPage($count,$pageSize);
         $list = $this->blogsModel->order('id')->limit($p->firstRow, $p->listRows)->select();
         $list = $this->delData($list);
         $this->assign('xu',$p->firstRow);
         $this->assign('data',$list);
         $this->assign('page', $p->show());
         $this->assign('size',$pageSize);
         $this->display();
         //$rn=$this->fetch();
         //$this->ajaxReturn($rn);
         //$this->display();
    }


    public function showUploadBlog(){
        $data = $this->categoryModel->selectData();
        $this->assign('data',$data);
        $this->display();
    }

/*
 * 处理数据，增加博客的类别 文字
 */
    public function delData($data){
        $cat = $this->categoryModel->selectData();
        $i=0;
        for(;$i<count($data);$i++){

            for($j = 0;$j<count($cat);$j++ ){
                if ($data[$i]['cid'] == $cat[$j]['id']) {
                    $data[$i]['cat'] = $cat[$j]['category'];
                    break;
                }
            }
        }
        return $data;
    }
/*
 *  删除Blog的函数
 */
    public function deleteBlog(){
           $data['id']= I('post.id');
           if (empty($data['id'])) {
               $this->ajaxError('',404,'缺少输入的数据');
           }
           $data['id'] = json_decode($data['id']);
           $r = $this->deletefile($data);
           if (!$r) {
               $this->ajaxError('',404,'删除失败');
           }
           $rn = $this->blogsModel->deleteData($data);
           if ($rn) {
               $this->ajaxSuccess('',200,'删除用户成功');
           }
           else {
               $this->ajaxError('',404,'删除用户失败');
           }

    }
    /*
     * 删除文件
     */
    protected function deletefile($data){
       $rn = $this->blogsModel->selectById($data);
        if (file_exists($rn)) {
           $r= unlink($rn);
           return $r;
        }
        else {
            return false;
        }

    }



}