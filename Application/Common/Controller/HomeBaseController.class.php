<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/3/13
 * Time: 18:02
 */

namespace Common\Controller;
use \Think\Controller;
class HomeBaseController extends Controller
{
   public function __construct(){
       parent::__construct();
   }

    public function checkTk()
    {
        if (empty($_SESSION['token'])) {
           // $this->redirect('Admin/Index/index');
        }
        else {
            $v=new JWT();
            try{
                $jwt=$v::decode($_SESSION['token'],C('JWT_KEY'),array(C('JWT_ALG')));
                if ($jwt) {
                    return true;
                }
                else {
                 //    $this->redirect('Admin/Index/index');
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


}

//缺少一个权限检验 这里。
