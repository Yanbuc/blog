<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/13
 * Time: 11:02
 */

namespace Home\Controller;
use \Common\Controller\HomeBaseController;
use \Common\Model\CommentViewModel;
class HomeCommentController extends HomeBaseController
{
    protected $commentViewModel = null;


    public function __construct()
    {
        parent::__construct();
        $this->commentViewModel = new CommentViewModel();
    }

    //展示前端的评论页面
    public function showCommentList($data){
        $map = array('is_checked' => 1,'bid'=> $data);
        $data  = $this->commentViewModel->selectData($map);
        if (! $data ){
          //表示没有评论
            return false;
        }
        $tree =  $this->tree($data);
        return $tree;
    }


    //树形图

    protected function tree($data,$pid = 0,$prefix=""){
        $tree = array();
        foreach($data as $key => $value) {
            if ($value['pid'] == $pid){
                $value['prefix'] = $prefix;
                $tree[] = $value;
                unset($data[$key]);
                $pend = $prefix ."&nbsp;&nbsp;&nbsp;";
                $rn = $this->tree($data,$value['cid'],$pend);
                $tree =  array_merge($tree,$rn);
            }

        }
        return  $tree;

    }


}