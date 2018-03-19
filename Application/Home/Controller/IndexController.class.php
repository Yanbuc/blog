<?php
namespace Home\Controller;
use \Common\Controller\HomeBaseController;
use \Common\Model\CategoryModel;
class IndexController extends HomeBaseController {
    protected $categoryModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->categoryModel =  new CategoryModel();
    }

    public function index(){
        $rn = $this->showlist();
        $rn = $this->showType($rn);
        $this->assign('type',$rn);
        $this->display();

    }

    public function showlist($data = array()){

        $res=$this->categoryModel->selectData($data);
        return $res;
    }

    /*
     *   对展示的分类进行处理
     */

    public function showType($rn){


          $displayType = C('DISPLAY_TYPE');
          if (empty($displayType)) {
              return $rn;
          }
          $dt = explode(',',$displayType);
          if (empty($dt)) {
              $dt = array();
              if (is_numeric($displayType)) {
                  $dt[] = (int)$displayType;
              }
              else{
                  return $rn;
              }
          }
          $i=0;
          for (;$i<count($dt);$i++){
               $dt[$i] = trim($dt[$i]);
               unset($rn[$dt[$i]-1]);
          }
          $rw = array();
          foreach ($rn as $key => $value) {
              $rw[] = $value;
          }
          return   $rw;
    }


}