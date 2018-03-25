<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/14
 * Time: 14:29
 */

namespace Common\Controller;
use \Think\Controller;
use \Firebase\JWT\JWT;
use \Firebase\JWT\BeforeValidException;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\SignatureInvalidException;
class AdminBaseController extends Controller
{
       /*
        * 封装ajax返回函数，有利于统一返回数据的格式
        */
       public function __construct()
       {
           parent::__construct();
           $this->checkTk();
       }

    public function ajaxSuccess($data='',$status='',$information = ''){
           $rn=array(
               'data' => $data,
               'status' => $status,
               'information'  => $information
           );
           $this->ajaxReturn($rn);

       }

       public function ajaxError($data='',$status='',$information = ''){
           $rn=array(
               'data' => $data,
               'status' => $status,
               'information'  => $information
           );
           $this->ajaxReturn($rn);
       }

    public function checkTk()
    {
        if (empty($_SESSION['token'])) {
            $this->redirect('Admin/Index/index');
        }
        else {
            $v=new JWT();
            try{
                $jwt=$v::decode($_SESSION['token'],C('JWT_KEY'),array(C('JWT_ALG')));
                if ($jwt) {
                    return true;
                }
                else {
                    $this->redirect('Admin/Index/index');
                }
            }
            catch(BeforeValidException $e){
                unset($_SESSION['token']);
                $this->redirect('Admin/Index/index');
            }
            catch(ExpiredException $e){
                unset($_SESSION['token']);
                $this->redirect('Admin/Index/index');
            }
            catch(SignatureInvalidException $e){
                unset($_SESSION['token']);
                $this->redirect('Admin/Index/index');
            }
            catch(\UnexpectedValueException $e){
                unset($_SESSION['token']);
                $this->redirect('Admin/Index/index');
            }


        }

    }

    public function _empty(){
          $this->display('Admin@Index/index');
    }

}