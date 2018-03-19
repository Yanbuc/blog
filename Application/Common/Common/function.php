<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/18
 * Time: 14:29
 */

 function getPage($count,$pageSize){
     $p =new \Think\Page($count,$pageSize);
     $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>'.$p->listRows.'</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
     $p->setConfig('prev','上一页');
     $p->setConfig('next','下一页');
     $p->setConfig('last','末页');
     $p->setConfig('first','首页');
     $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
     return $p;
 }