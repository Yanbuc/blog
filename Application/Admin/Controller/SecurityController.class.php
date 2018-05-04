<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/4/25
 * Time: 21:04
 */

namespace Admin\Controller;
use \Think\Controller;
use \SplSubject;

class SecurityController extends Controller implements \SplObserver
{

    public function update(SplSubject $subject){
        $rn = array();
        $rn['times'] = $subject->getTdyLoginTime();
       if ($rn['times'] > 10) {
           $rn['info'] = "登录次数过多，可能是账号泄密";
       }
       else {
           $rn['info'] = '';
       }
       return $rn;
    }
}