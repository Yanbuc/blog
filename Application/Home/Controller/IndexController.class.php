<?php
namespace Home\Controller;
use \Common\Controller\HomeBaseController;
use \Common\Model\CategoryModel;
use \Common\Model\WordsModel ;
class IndexController extends HomeBaseController {

    protected $categoryModel = null;
    protected $blogTitle = '';
    protected $wordsModel = null;
    protected $count = 0;//后台存储的话的记录数量
    protected $words = '';//记录传递到前台的话
    public function __construct()
    {
        parent::__construct();
        $this->categoryModel =  new CategoryModel();
        $this->blogTitle = C('BLOG_TITLE');
        $this->wordsModel =  new WordsModel();
    }

    public function index(){
        $this->showWords();
        $this->assign('words',$this->words);
        if ( session('?username') && session('?uid') ) {
            $rn = $this->showlist();
            $rn = $this->showType($rn);
            $this->assign('type',$rn);
            $this->assign('user',session('username'));
            $this->assign('blogTitle',$this->blogTitle);
            $this->display('index');

        }
        else {
            $rn = $this->showlist();
            $rn = $this->showType($rn);
            $this->assign('type',$rn);
            $this->assign('blogTitle',$this->blogTitle);
            $this->display('index');
        }
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

    //获得想要的想要表现在前台的话，
    protected function showWords(){
        $data = S('data');
        if (! $data ){
            $data = $this->wordsModel->selectWords();
            $expire = 60*60*24*30;
            S('data',$data,$expire);
        }
        $count = count($data);
        $nu = mt_rand(0,$count-1);
        $this->words = $data[$nu]['words'];
    }

}
