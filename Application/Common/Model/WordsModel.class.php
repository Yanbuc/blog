<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/23
 * Time: 22:07
 */

namespace Common\Model;
use \Common\Model\BaseModel;

class WordsModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectWords(){
        $data = $this->field('words')->select();
        return $data;
    }

}