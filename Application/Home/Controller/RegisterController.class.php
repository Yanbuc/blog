<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/5
 * Time: 20:07
 */

namespace Home\Controller;
use \Think\Controller;
use \Think\Verify;
class RegisterController extends Controller
{
   protected $verify = null;
   protected $verifyInformation =array(
                                          'ver' =>'',//验证码
                                          'user' => '',//用户名
                                          'password' => '', //密码
                                          'checkPwd' => '',//验证密码
                                          'nickname' => '', //昵称
                                          'tip' => '', //个性签名
                                          'result' => ''
                                       );
   //传入的数据的标签，以后如果进行注册标签的扩展的话，就是这里加入数据
   protected $params = array(
                               'ver','user','password','nickname','checkPwd'
                             );
   protected $receiveData =array();

   public function __construct()
   {
       parent::__construct();
       $config=C('VERIFY_PEIZHI');
       $this->verify = new Verify($config);
   }

    //显示注册页面
    public function register(){
          if (IS_GET){
              $this->display('register');
          }
          elseif (IS_POST){

              // 检测传入的数据是否有空缺
              $fg = $this->checkIsEmpty();
              if (! $fg ){
                  $this->assign('data',$this->verifyInformation);
                  $this->display('register');
                  return ;
              }

              //检验验证码是否是正确的。
              $flag = $this->checkCode($_POST['ver']);
              if (! $flag ) {
                  $this->verifyInformation['ver'] = '验证码不正确';
                  $this->assign('data',$this->verifyInformation);
                  $this->display('register');
                  return ;
              }

              //判断输入的用户名和昵称是否是符合标准
              //标准有用户名和昵称的长度不会超过20 以及只能有数字 字母 下划线组成。
              $fg1 = $this->checkUserAndNickName();
              if ( !$fg1 ) {
                  $this->assign('data',$this->verifyInformation);
                  $this->display('register');
                  return ;
              }
              //检测用户名是否已经存在
              $fg4 = $this->checkUserExists();
              if ( !$fg4 ) {
                  $this->assign('data',$this->verifyInformation);
                  $this->display('register');
                  return ;
              }


            //判断注册输入的值是否符合标准
             $fg2 = $this->checkTip();
             if ( !$fg2 ) {
                 $this->assign('data',$this->verifyInformation);
                 $this->display('register');
                 return ;
             }


             $fg3 =  $this->checkPwdAndComPwd();
             if ( !$fg3 ) {
                 $this->assign('data',$this->verifyInformation);
                 $this->display('register');
                 return ;
             }


             //然后就是密码进行加密
              $this->dealPwd();
             //然后就是对用户进行注册了
              $this->receiveData['last_login_time'] = time();
              $users = D('Users');
              $rn =  $users->addData($this->receiveData);
              if (! $rn ) {
                   $this->verifyInformation['result'] = '用户注册失败';
                   $this->assign('data',$this->verifyInformation);
                   $this->display('register');
                   return ;
              }
              $this->success('注册成功',U('Home/Index/index'));

          }
          else {
              var_dump("llll");
          }

    }





    //显示验证码
    public function showCheckCode(){
        $this->verify->entry();
    }


   //检查用户名和昵称是否符合标准。
    protected function checkUserAndNickName(){
       $data =  array();
       $data['user'] = I('post.user',' ','htmlspecialchars');
      // $data['password'] = I('post.password',' ');
       $data['nickname'] = I('post.nickname');

      // $b ='/[*()\s<>%#@!\-\$&\^\?\+\[\]\{\} \\\\  \' \" ;\. ]/';
       $c = '/^[a-zA-Z0-9]+$/';
       $fg1 = preg_match($c,$data['user']);
       $fg2  = preg_match($c,$data['nickname']);
       if ( ! $fg1 ) {
           $this->verifyInformation['user'] = "输入的用户名不符合格式";
       }
       if ( ! $fg2 ) {
           $this->verifyInformation['nickname'] = "输入的用户昵称不符合格式";
       }
       if ( !$fg1 || !$fg2 ){
           return false;
       }
       else {
           $userLegnth = C('USER_LENGTH');
           $nicknameLength = C('NICKNAME_LENGTH');
           //然后这里就是检查输入的长度是否符合标准
           if (strlen($data['user']) > $userLegnth ) {
               $this->verifyInformation['user'] = "用户名过长";
               return false;
           }
           if ( strlen($data['nickname']) > $nicknameLength ) {
               $this->verifyInformation['nickname'] = '昵称过长';
               return false;
           }
           $this->receiveData['name'] = $data['user'];
           $this->receiveData['nickname']= $data['nickname'];
           return true;
       }
    }

   //检验验证码是否正确
    protected function checkCode($data){
        $rn =  $this->verify->check($data);
        return $rn;

    }

    //检查传入的数据是否有缺损。
    protected  function checkIsEmpty(){
           $data = I('post.');
           $i=0;
           $n =  count($this->params);
           $fg = true;
           for( ; $i < $n ; $i++ ) {
               if (empty($data[$this->params[$i]])) {
                   $this->verifyInformation[$this->params[$i]] = '输入值为空' ;
                   $fg = false;
               }
           }
         return $fg;
    }
   //检查个性签名是否符合标准

    protected function checkTip(){
          $data = array();
          $data['tip'] =  I('post.tip','','htmlspecialchars');
          if ( empty($data['tip']) ) {
              $this->receiveData['tip'] = '';
              return true;
          }
          $tipLength = C('TIP_LENGTH');
          if ( mb_strlen($data['tip'],'utf8') > $tipLength ) {
              $this->verifyInformation['tip'] = '个性签名的长度过长';
              return false;
          }
          $this->receiveData['tip'] = $data['tip'];
          return true;

    }

    //检测输入的密码和进行验证的密码是否符合

    protected function checkPwdAndComPwd(){
        $data = array();
        $data['password'] = I('post.password');
        $data['chkPwd'] = I('post.checkPwd');
        if (strlen($data['password']) < 6  ) {
            $this->verifyInformation['password'] = '用户输入的密码长度不够';
            return false;
        }
        if ($data['password'] !== $data['chkPwd'] ) {
            $this->verifyInformation['chkPwd'] = '两次输入的密码不符合';
            return false;
        }
        $this->receiveData['password'] = $data['password'];
        return true;

    }
    protected  function checkUserExists(){
        $users = D('Users');
        $data =array();
        $data['name'] =$this->receiveData['name'];
        $rn = $users->selectData($data);
        if ( $rn ) {
            $this->verifyInformation['user'] = '用户名已经存在';
            return false;
        }
        unset($data['name']);
        $data['nickname'] = $this->receiveData['nickname'];
        $rn = $users->selectData($data);
        if ( $rn ) {
            $this->verifyInformation['nickname'] = '昵称已经存在';
            return false;
        }
        return true;
    }

    protected function dealPwd(){
        $this->receiveData['password'] = password_hash($this->receiveData['password'],  PASSWORD_DEFAULT);

    }




}