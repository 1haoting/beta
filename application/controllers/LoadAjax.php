<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LoadAjax extends CI_Controller {

    //void
	public function __construct()
	{
		parent::__construct();
        session_start();
        $this->load->model("city_list");
	}

    /**
     * get city list
     * */
    public function citylist() {
        $begin = trim($_POST['begin']);
        $end = trim($_POST['end']);
        $city_data = $this->city_list->selectCityInfo($begin, $end);
        die(
            json_encode($city_data)
        );
    }

   /**
     * get city name
     * */
    public function  getname() {
        $cid = $_SESSION['d_c_id'];
        $this->city_list->d_c_id = $cid;
        $ret = $this->city_list->selectInfoByDid();
        die( $ret[0]->name );
    }

    /**
     * set session and return session
     * */
    public function setsession() {
        $dcid = $_SESSION['d_c_id']; 
        $number = $_GET['number'];
        $_SESSION['d_c_id'] = $number;
        die( $dcid );
    }
}
