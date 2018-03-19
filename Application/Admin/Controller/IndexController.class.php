<?php
namespace Admin\Controller;
use Firebase\JWT\JWT;
use \Think\Controller;
use \Think\Verify;
use \Common\Model\UsersModel;
use \Common\Service\UsersService;

class IndexController extends Controller{

    protected $verify = null;
    protected $usersModel = null;
    protected $usersService = null;
    protected $status = '';
    protected $data = "";
    protected $information = "";
    protected $token = '';

    public function __construct()
    {
        parent::__construct();
        $this->usersModel = new UsersModel();
        $this->usersService = D('Users','Service');
        $config=C('VERIFY_PEIZHI');
        $this->verify = new Verify($config);

    }

    public function index(){
       $this->display('index');
    }

    public function showCheckCode(){

       if (empty($this->verify)) {
            var_dump('no');
       }
       else {
           $this->verify->entry();
       }

    }

    public function login(){
        $this->display('index');

    }

    public function checkLogin(){
        $data = I('post.data');
        $data = (array)json_decode($data);
        $fg = $this->check($data['ck']);
        if (!$fg) {
            $bn=array('information' => '验证码出错了',
                       'data'       => '',
                        'status'    => 404
                     );

            $this->ajaxReturn($bn);
        }
        $rn = $this->usersService->checkIsTrue($data);
        if ( !$rn) {
            $bn=array( 'information' => '输入的数据少了',
                       'data'       => '',
                       'status'    => 404
            );

            $this->ajaxReturn($bn);
        }
        else {
            $da['acc'] =$data['acc'];
            $rn=$this->usersModel->getPassword($da);
            $rn =password_verify($data['pwd'],$rn);
            if ($rn) {
                $this->produceToken();
                $_SESSION['token'] = $this->token;
                $bn=array( 'information' => '登录成功',
                    'data'       => U('PutBlog/index'),
                    'status'    => 200
                );
                $this->ajaxReturn($bn);
            }
            else {
                $bn=array( 'information' => '密码输入不正确',
                    'data'       => '',
                    'status'    => 404
                );
                $this->ajaxReturn($bn);
            }
        }
    }
    /*
     *  检查验证码是否正确
     *  @param $data 包含验证码的数据
     */
    protected function check($data){
         $rn = $this->verify->check($data,$id='');
         return $rn;
    }


    protected function produceToken()
    {
        $c=time();
        $v=new JWT();
        $key = C('JWT_KEY');
        $tk = array(
            "iss" => "admin",
            "aud" => "user",
            "iat" => $c,
            "exp" =>time()+60*60*2,
            "id"  => $this->uid,
        );
        $this->token=$v::encode($tk,$key,C('JWT_ALG'));
    }


    public function loginOut(){
        if ( empty($_SESSION['token']) ) {
            $this->index();
        }
        else {
            unset($_SESSION['token']);
            $this->index();
        }

    }


}