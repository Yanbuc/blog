<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/6
 * Time: 19:59
 */

namespace Home\Controller;
use \Think\Controller;
use \Common\Model\CommentModel;
use \Common\Model\CommentViewModel;
use \Common\Model\BlogViewModel;
class TestController extends  Controller
{
    public function test(){
        $d = D('BlogView');

        $data = $d->select();
        var_dump($data);
        //$rn = $this->tree($data);
        //      var_dump($rn);

    }

    public function tree($data,$pid = 0){
           $tree = array();
            foreach($data as $key => $value) {
                if ($value['pid'] == $pid){
                    $tree[] = $value;
                    $rn = $this->tree($data,$value['cid']);
                    $tree =  array_merge($tree,$rn);
                }

            }
        return  $tree;

    }

    public function  say(){
        $d = new TestEvent();
        echo $d->say();

    }


}