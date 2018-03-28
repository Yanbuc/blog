<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/21
 * Time: 19:12
 */

namespace Admin\Controller;
use \Common\Controller\AdminBaseController;
use \Common\Model\CategoryModel;

class DictionaryController extends AdminBaseController
{
    protected $category = null;

    public function __construct(){
        parent::__construct();
        $this->category = new CategoryModel();
    }
    //展示字典的列表
    public function index(){
        $count = $this->category->getCount();
        $p = getPage($count,10);
        $list = $this->category->order('id')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('xu',$p->firstRow);
        $this->assign('data',$list);
        $this->assign('page', $p->show());
        $this->display();
    }

    public function fenji(){

        $data = $this->category->selectData();
        $data = \Org\sl\Data::tree($data);
        $this->assign('data',$data);
        $this->display();
        //print_r($data);
        //$this->display();


    }



}