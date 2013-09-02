<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

    //void
	public function __construct()
	{
		parent::__construct();
        $this->load->model("login_model");
        $this->load->library("Captcha");
        $this->load->library("session");
	}

    /**
     * show login page
     * */
    public function index() {
        if (isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
            show_msg("已登录，正在跳转首页", base_url() . "nowplay");
        } else {
            $this->smarty->assign('base_url', base_url());
            $this->smarty->view('login.html');
        }
    }

    /**
     * user register
     * */
    public function register() {
        $this->login_model->email = trim($_POST['regemail']);
        $pwd = trim($_POST['regpwd']);
        $pwd = md5($pwd);
        $pwd = substr($pwd, 5, 20);
        $this->login_model->pwd = $pwd;
        $this->login_model->c_time = time();
        $id = $this->login_model->insertUserData();
        if($id) {
            show_msg("注册成功", base_url() . "login");
        } else {
            show_msg("注册失败", base_url() . "login");
        }
    }

     /**
     * user login
     */
     public function enter() {
        $info = array();
        $email = trim($_POST['user_email']);
        $pwd = trim($_POST['pwd']);
        $pwd = md5($pwd);
        $pwd = substr($pwd, 5, 20);
        $rets = $this->login_model->_checkEmail($email, $pwd);
        if ($rets && isset($rets[0]) && $rets[0]->id) {
            setcookie("user_id", $rets[0]->id, time()+3600*24, "/");
            setcookie("useremail", $email, time()+3600*24, "/");
            show_msg("登录成功", base_url() . "nowplay");
        } else {
            show_msg("邮箱或密码错误", base_url() . "login");
        }
     }

    /**
     * get Captcha
     * */
    public function getcaptcha() {
        $this->captcha->showImg();
        $this->session->set_userdata("captcha", $this->captcha->getCaptcha());
    }

    /**
     * check input Captcha
     * */
    public function ckCaptcha() {
        $ret = 0;
        $code = trim($_POST['code']);
        $sesscode = $this->session->userdata("captcha");
        (strtolower($code) == strtolower($sesscode)) && $ret = 1;
        die( $ret );
    }

    /**
     * check useremail exsitsed 
     * */
    public function ckUser() {
        $ret = array('status'=>0, 'msg'=>'');
        $email = trim($_POST['email']);
        $rets = $this->login_model->_checkEmail($email);
        if($rets && isset($rets[0]) && $rets[0]->total) {
            $ret['status'] = 1;
            $ret['msg']    = '该邮箱用户名已存在！';
        }

        die(
            json_encode($ret)
        );
    }

}
