<?php
/**
 * Created by PhpStorm.
 * User: 沈磊
 * Date: 2018/5/13
 * Time: 17:26
 */

namespace Home\Controller;
use \Think\Controller;
use \Think\Verify;
use \Common\Model\UsersModel;
use Firebase\JWT\JWT;
class LoginController extends Controller
{
    protected $verify = null;
    protected $errInfo = array(
                                 'userError' =>'',
                                 'passwordError' => '',
                                 'checkCodeError' => ''
                               );
    protected $data = array( 'user' => '', //用户名
                              'password' => '', //密码
                              'checkCode' => '', //验证码
                              'pwd' => '', //数据库之中的密码
                              'role' => '', //用户所具有的角色。
                              'uid' => '',
                             );
    protected $usersModel = null;
    protected $token = '';

    public function __construct()
   {
        parent::__construct();
        $config=C('VERIFY_PEIZHI');
        $this->verify = new Verify($config);
        $this->usersModel = new UsersModel();
   }

   //登录按钮
   public function login(){
       $this->assign('error',$this->errInfo);
       $this->display('login');

   }




   //退出按钮
   public function logout(){


   }

   public function checkLogin(){

       //首先检查的是输入的值是否有空缺。

       $fg1 = $this->checkEmpty();
       if (! $fg1 ){
           $this->assign('error',$this->errInfo);
           $this->display('login');
           return ;
       }
      /*
       //检查验证码是否正确
       $fg1 = $this->checkCode();
       if (! $fg1 ) {
           $this->assign('error',$this->errInfo);
           $this->display('login');
           return ;
       }
     */
       //接下来就是检车输入的用户名了
       //如果用户名存在的话，顺便去除用户名的信息。
       $fg1 = $this->checkUser();
       if (! $fg1 ){
           $this->assign('error',$this->errInfo);
           $this->display('login');
           return ;
       }

       //验证密码
       $fg1 = password_verify($this->data['password'],$this->data['pwd']);
       $this->errInfo['passwordError'] = "输入的密码不正确";
       if ( ! $fg1 ) {
           $this->assign('error',$this->errInfo);
           $this->display('login');
           return ;
       }
       echo "yes";

   }

    //检查输入的数据是否为空
   protected function checkEmpty(){
       $data = array();
       $data['user'] = I('post.user');
       $data['password'] = I('post.password');
       $data['ver'] = I('post.ver');
       if ( empty($data['user']) ) {
           $this->errInfo['userError'] = '没有输入用户名';
           return false;
       }
       if ( empty( $data['password'] ) ) {
           $this->errInfo['passwordError'] = '没有输入密码';
           return false;
       }
       if ( empty( $data['ver'] ) ) {
           $this->errInfo['checkCodeError'] = '没有输入验证码';
           return false;
       }


       $this->data['user'] = $data['user'];
       $this->data['password'] = $data['password'];
       $this->data['checkCode'] = $data['ver'];
       return true;
   }


   //检查输入的用户名
   protected function checkUser(){
      $this->data['user'] = strip_tags($this->data['user']);
      $c = '/^[a-zA-Z0-9]+$/';

      //检查用户名是否符合规则
      $fg1 = preg_match($c,$this->data['user']);
      if (! $fg1 ) {
          $this->errInfo['userError'] = "输入的用户名不存在";
          return false;
      }

      //同时检查输入的用户名的长度
      if ( strlen( $this->data['user'] ) > 23 ) {
          $this->errInfo['userError'] = "输入的用户名不存在";
          return false;
      }

      //然后就是检验用户名是否存在了。
      $dt = array();
      $dt['users.name'] =  $this->data['user'];
      $pwd = $this->usersModel->getPwdAndIdAndRole($dt);
      if (! $pwd ) {
          $this->errInfo['userError'] = "输入的用户名不存在";
          return false;
      }
      $this->data['pwd'] = $pwd['pwd'];
      $this->data['role'] = $pwd['role'];
      $this->data['uid']  = $pwd['id'];
      return true;
   }


   //显示验证码
    public function showCheckCode(){
        $this->verify->entry();
    }

    //检验验证码是否正确
    protected function checkCode(){
        $rn =  $this->verify->check($this->data['checkCode']);
        if (! $rn ){
            $this->errInfo['checkCodeError'] = '验证码不正确';
            return false;
        }
        return true;

    }

    //产生token的函数
    protected function produceToken()
    {
        $c=time();
        $v=new JWT();
        $key = C('JWT_KEY');
        $tk = array(
            "iss" => "admin",
            "aud" => "user",
            "iat" => $c,
            "exp" =>time()+60*60*8,
            "id"  => $this->data['uid'],
        );
        $this->token=$v::encode($tk,$key,C('JWT_ALG'));
    }


}