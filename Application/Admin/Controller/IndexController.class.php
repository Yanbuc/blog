<?php
namespace Admin\Controller;
use Firebase\JWT\JWT;
use \Think\Controller;
use \Think\Verify;
use \Common\Model\UsersModel;
use \Common\Service\UsersService;
use \SplObserver;
use \SplObjectStorage ;
use \Admin\Controller\SecurityController;

class IndexController extends Controller implements \SplSubject {
    //应该有的观察者的话，应该就是安全方面的观察者
    //但是的话，就是登录次数是如何记录的。


    protected $verify = null;
    protected $usersModel = null;
    protected $usersService = null;
    protected $status = '';
    protected $data = "";
    protected $information = "";
    protected $token = '';
    protected $splObjectStorage = null;//存储着所有的观察者。
    protected $tdyLoginTimes = 0;
    protected $secureContorller = null;

    public function __construct()
    {
        parent::__construct();
        $this->usersModel = new UsersModel();
        $this->usersService = D('Users','Service');
        $config=C('VERIFY_PEIZHI');
        $this->verify = new Verify($config);
        $this->splObjectStorage = new SplObjectStorage();
        $this->secureContorller = new SecurityController();
        $this->splObjectStorage->attach($this->secureContorller);
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
        //判断验证码
        if (!$fg) {
            $bn=array('information' => '验证码出错了',
                       'data'       => '',
                        'status'    => 404
                     );

            $this->ajaxReturn($bn);
        }

        //检查用户输入的数据是否完整
        $rn = $this->usersService->checkIsTrue($data);
        if ( !$rn) {

            $bn=array( 'information' => '输入的数据少了',
                       'data'       => '',
                       'status'    => 404
            );
            $this->ajaxReturn($bn);
        }
        else {
            //用户输入数据完整，
            $da['name'] =$data['acc'];
            $rs = $this->usersModel->selectData($da);
            if ( !$rs ) {
                $bn=array( 'information' => '用户名不正确',
                    'data'       => '',
                    'status'    => 404
                );
                $this->ajaxReturn($bn);
                return ;
            }

            $rn = password_verify($data['pwd'],$rs[0]['pwd']);

            if ($rn) {

                //验证登录的次数
                $fDay = $rs[0]['last_login_time'];
                $nDay = time();

                //$fg 为比较是否在同一天的标志
                $fg = $this->compareTime($fDay,$nDay);
                $map['id'] = $rs[0]['id'];
                $rg['tdy_login_times'] = $this->getLoginTimes($fg,$rs[0]['tdy_login_times']);
                $rg['last_login_time'] = time();
                $this->usersModel->where($map)->save($rg);

                //观察者模式来进行替换,
                $das =$this->notify();



                //产生token
                $this->produceToken();
                $_SESSION['token'] = $this->token;
                $bn=array(
                    'information' => '今天你已经登录' .$das['secure']['times'] . '次'.' '.$das['secure']['info'],
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

     //比较时间是否一致
    protected function compareTime($fDay,$nDay){
          $fDay =  getDay($fDay);
          $nDay =  getDay($nDay);
          if ($fDay != $nDay  ) {
              return false;
          }
          else {
              return true;
          }

    }

    //得出登录的次数
    //@param boolean 是否是同一天的标志
    //@param int $data 今天到底登录了几次
    protected function  getLoginTimes($fg,$data){
        if ($fg) {
            $data++;
            $this->tdyLoginTimes = $data;
            return $data;
        }
        else {
            $data = 1 ;
            $this->tdyLoginTimes = $data;
            return $data;
        }
    }




     //为登录控制器设置观察者模式


    public function attach(SplObserver $observer)
    {
        // TODO: Implement attach() method.
          $this->splObjectStorage->attach($observer);

    }
    public function detach(SplObserver $observer)
    {

        $this->splObjectStorage->detach($observer);
        // TODO: Implement detach() method.
    }
    public function notify()
    {
        $data = array();
        //触发观察者模式
        //首先触发的是安全方面的，关于一天之中登录次数的验证。
        $this->splObjectStorage->rewind();
        $data['secure'] = $this->secureContorller->update($this);
        //后面的话，还是可以继续触发观察者模式的
        //下面的话，可以继续增加，返回的信息的话，可以跟在$data后面


        return $data;

    }

    public function getTdyLoginTime(){
        return $this->tdyLoginTimes;
    }

}