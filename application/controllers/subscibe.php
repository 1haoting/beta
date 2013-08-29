<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscibe extends CI_Controller {

    //void
	public function __construct()
	{
		parent::__construct();
        $this->load->model("subscibe_model");
	}


    /**
     * insert subscibe
     * */
    public function insertsubscibe() {
        $this->subscibe_model->phone = trim($_POST['phone']);
        $this->subscibe_model->c_time = time();
        $id = $this->subscibe_model->insertData();
        if($id) {
            die( '订阅成功' );
        } else {
            die('订阅失败');
        }
    }
}
