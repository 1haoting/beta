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
	public function dispose($areaId = null)
	{
        $this->getCityId();
		$this->getCinemaList($areaId);
		//$this->getLaterMovieList();
        $this->showView();
	}

    /**
     * get city Id
     *
     * @return void
     */
    public function getCityId()
    {
        $this->localCityName = $this->tools->getLocalCity();
        $this->City_List->zh_name = $this->localCityName;
        $this->city_data = $this->City_List->selectCityInfoByZhName();
        $this->City_List->parent_id = $this->city_data[0]->id;
        $this->area_data = $this->City_List->selectAreaInfoByParentId();
    }

    /**
     * get cinema list 
     *
     * @return void
     */
	public function getCinemaList($areaId)
	{
        $this->cinema_model->city_id = $this->city_data[0]->d_c_id;
        if (isset($areaId)) {
            $this->cinema_model->area_id = $areaId;
        }
        $this->areaCinema = $this->cinema_model->getCityInfoByCityAreaId();
		$this->smarty->assign('areaId', $areaId);
	}

    /**
     * get later movie list
     * 
     * @return void
     */
	public function getLaterMovieList()
	{
		$this->load->model('Later_movie','later_movie',TRUE);
		$this->later_movie->city_id = $this->localCityId;
		$this->laterMovieList = $this->later_movie->getMovieDetailByCityId();
		foreach ($this->laterMovieList as &$movieDetail) {
			$movieDetail->summary = $this->tools->filterString($movieDetail->summary, 900);	
			$movieDetail->cast = $this->tools->filterString($movieDetail->cast, 100);
            $movieDetail->movie_type = $this->tools->filterMovieType($movieDetail->movie_type, ',');
            $movieDetail->title = $this->tools->filterMovieName($movieDetail);
		}
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
