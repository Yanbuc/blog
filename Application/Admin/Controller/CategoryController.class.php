<?php
/**
 * Created by PhpStorm.
 * User: shenlei
 * Date: 2018/6/19
 * Time: 10:14
 */

namespace Admin\Controller;
use \Common\Controller\AdminBaseController;
use \Common\Model\CategoryModel;
class CategoryController extends AdminBaseController
{
    protected $categoryModel = null;
     public function __construct(){
         parent::__construct();
         $this->categoryModel =  new CategoryModel();
     }
     //显示分页列表
     public function showList(){
         $pageSize = 10;
         $count = $this->categoryModel->getCount();
         $p = getPage($count, $pageSize);
         $list = $this->categoryModel->order('id')->limit($p->firstRow, $p->listRows)->select();
         $this->assign('xu', $p->firstRow);
         $this->assign('data', $list);
         $this->assign('page', $p->show());
         $this->assign('size', $pageSize);
         $this->display();
     }
     //编辑标签
     public function editCal(){
         $id = $_GET['id'];
         $id = intval($id);
         $map['id'] = $id;
         $data = $this->categoryModel->getCategoryDetail($map);
         $this->assign('cname',$data['data']['cname']);
         $this->assign('pname',$data['data']['pname']);
         $this->display();
         return ;
     }

     //删除分类
    //这里使用了触发器 删除了分类之后 就是会删除分类的所有的文章。
    public function deleteCal(){
         $id = I('post.id');
         if (empty($id)) {
             $this->ajaxError('', 404, '失败');
             return;
         }
         $id = is_array($id) ? $id :array($id);
         $map['id'] = array('in',$id);
         $this->categoryModel->where($map)->delete();
         $this->ajaxSuccess('',200,'');
    }
     //更新标签  这里还没有完成。
    public function updatedCal(){


    }

}