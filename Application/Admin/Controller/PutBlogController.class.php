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
use \Common\Model\PictureModel;
class PutBlogController extends AdminBaseController
{
    protected $blogsModel = null;
    protected $categoryModel = null;
    protected $pictureModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->blogsModel = new BlogsModel();
        $this->categoryModel = new CategoryModel();
        $this->pictureModel = new PictureModel();
    }
    //展示后台的登录之后的页面。
    public function index(){
        $this->display('index');
    }

    /*
     * 仅仅是上传博客
     */

    public function uploadBlog(){

        if (IS_POST) {
            $rn = $this->blogsModel->addData();
            if ($rn['flag']) {
               $this->success("文章添加成功");
            } else {
                $this->error($rn['information']);
            }
        }
        else {
            $this->error('出错了');
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
         $ud = U('Admin/PutBlog/showEditContent');

         $this->assign('xu',$p->firstRow);
         $this->assign('data',$list);
         $this->assign('page', $p->show());
         $this->assign('url',$ud);
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


/*
 * 删除博客的接口
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
               $this->ajaxSuccess('',200,'删除文章成功');
           }
           else {
               $this->ajaxError('',404,'删除文章失败');
           }

    }
    /*
     * 删除文件
     */
    protected function deletefile($data){
        $cn['bid'] = $data['id'];
        $rn = $this->pictureModel->selectById($cn);
        if (! $rn){
            return true;
        }
        $this->pictureModel->deleteData($cn);
        foreach( $rn as $key => $value){
            if (file_exists($value['avatar'])) {
                unlink($value['avatar']);
                $dir = $this->getDirPath($value['avatar']);
               if (count(scandir($dir)) === 2){
                   rmdir($dir);
               }
            }

        }
        return $rn;

    }

    protected function getDirPath($data){
      $temp = explode("/",$data);
      $i=0;
      $path='';
      for(;$i<count($temp)-2;$i++){
          $path = $path.$temp[$i].'/';
      }
      $path = $path.$temp[$i];
       return $path;
    }

    //编辑文章的方法
    public function  editBlog(){
        if (IS_GET) {
            $data['id'] =I('get.id',1,'intval');

        }
        else {
            $this->display('Index:index');
        }

    }

    public function showEditContent(){
        if (IS_GET) {
            $data['id'] =I('get.id',1,'intval');
            $da = $this->blogsModel->getBlogInformation($data);
            $da['content'] = htmlspecialchars_decode($da['content']);
            $cag = $this->categoryModel->selectData();
            foreach($cag as $key => $value){
                 if ($cag[$key]['id'] == $da['cid']) {
                     $temp = $cag[$key];
                     $cag[$key] = $cag[0];
                     $cag[0] = $temp;
                 }
            }
            $this->assign('cag',$cag);
            $this->assign('data',$da);
            $this->display();

        }
        elseif (IS_POST) {
            //那么就是进行提了。是
           $rn = $this->blogsModel->editData();
            if ($rn['flag'] ) {
                $this->success($rn['information']);
            }
            else {
                $this->error($rn['information']);
            }


        }
        else {
            //显示初试页面
           // $this->display('Index:index');
        }

        // $this->display();
    }



}