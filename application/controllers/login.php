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
		$this->smarty->assign('base_url', base_url());
        $this->smarty->view('login.html');
    }


    /**
     * user register
     * */
    public function register() {
        $this->login_model->email = trim($_POST['regemail']);
        $this->login_model->pwd = trim($_POST['regpwd']);
        $this->login_model->c_time = time();
        $id = $this->login_model->insertUserData();
        if($id) {
            show_msg("login", "注册成功");
        } else {
            show_msg("login", "注册失败");
        }
        die(); 
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
        var_dump($rets);die;
        if($rets && isset($rets[0]) && $rets[0]['total']) {
            $ret['status'] = 1;
            $ret['msg']    = '该邮箱用户名已存在！';
        }

        die(
            json_encode($ret)
        );
    }

}
