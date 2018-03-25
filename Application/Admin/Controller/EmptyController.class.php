<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/22
 * Time: 19:32
 */

namespace Admin\Controller;
use \Think\Controller;

class EmptyController extends Controller
{
    public function index(){
        $this->display('Admin/Index/index');
    }

}