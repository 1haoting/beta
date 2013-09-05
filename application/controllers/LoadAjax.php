<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LoadAjax extends CI_Controller {

    //void
	public function __construct()
	{
		parent::__construct();
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
}
