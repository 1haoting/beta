<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * show cinema list
 * @author Haojianping
 * @version $Id: MovieList.php  2013-08-02 22:36:38Z $
 */
class CinemaList extends CI_Controller {

    private $areaId;

    
	public function __construct()
	{
		parent::__construct();
        $this->load->model('cinema_model');
        $this->load->model('City_List');
		$this->load->library('tools');
	}
    
    /**
     * dispose all function
     *
     * @param int $areaId area id
     *
     * @return void
     */
	public function dispose($cityId = null ,$areaId = null)
	{
        $this->getCityId($cityId);
		$this->getCinemaList($cityId, $areaId);
        $this->showView();
	}

    /**
     * get city Id
     *
     * @return void
     */
    public function getCityId($cityId)
    {
        if (isset($cityId)) {
            $this->City_List->d_c_id = $cityId;
            $this->city_data = $this->City_List->selectInfoByDid();
        } else {
            $this->localCityName = $this->tools->getLocalCity();
            $this->City_List->zh_name = $this->localCityName;
            $this->city_data = $this->City_List->selectCityInfoByZhName();
        }
        $this->City_List->parent_id = $this->city_data[0]->id;
        $this->area_data = $this->City_List->selectAreaInfoByParentId();
    }

    /**
     * get cinema list 
     *
     * @return void
     */
	public function getCinemaList($cityId, $areaId)
	{
        if(isset($cityId))
        {
            $this->cinema_model->city_id = $cityId;
            $this->smarty->assign('cityId', $cityId);
        } else {
            $this->cinema_model->city_id = $this->city_data[0]->d_c_id;
            $this->smarty->assign('cityId', $this->city_data[0]->d_c_id);
        }
        if (isset($areaId)) {
            $this->cinema_model->area_id = $areaId;
        }
        $this->areaCinema = $this->cinema_model->getCityInfoByCityAreaId();
        foreach ($this->areaCinema as $key => &$value) {
            $value->c_imgurl = preg_replace("/img\d.douban.com/", "img2.douban.com", $value->c_imgurl);
        }
		$this->smarty->assign('areaId', $areaId);
	}

	public function showView()
	{
		$this->smarty->assign('base_url', base_url());
		$this->smarty->assign('cityData', $this->city_data);
		$this->smarty->assign('areaData', $this->area_data);
		$this->smarty->assign('areaCinema', $this->areaCinema);
        $this->smarty->view('cinema_list.html');
	}
}
