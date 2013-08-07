<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MovieIndex extends CI_Controller {

    private $movieInfo;
    private $movieId;
    private $cityId;
    private $nowCityId;


	public function __construct()
	{
		parent::__construct();
		$this->load->library('tools');
	}

	public function dispose($cityId = null)
	{
        $this->getCityId($cityId);
        $this->getAllCity();
		$this->getMovieList();
		$this->getTOPMovieList();
        $this->getLaterMovieList();
        $this->showView();
	}

    /**
     * get city Id
     *
     * @return void
     */
    public function getCityId($cityId)
    {
        if (!isset($cityId)) {
        $this->_localCityName = $this->tools->getLocalCity();
        $this->load->model('City_List');
        $this->City_List->zh_name = $this->_localCityName;
        $this->city_data = $this->City_List->selectCityInfoByZhName();
        $this->nowCityId = $this->city_data[0]->d_c_id; 
        } else {
            $this->nowCityId = $cityId;
        }
    }

    /**
     * get all city 
     *
     * @beijing shanghai
     */
    public function getAllCity()
    {
        $this->all_city = array();
        $this->load->model('City_List');
        $this->City_List->field_str = 'id, d_c_id, zh_name, name';
        $this->city_data = $this->City_List->selectCityInfoByField();
    }

    /**
     * get now playing movie list
     *
     * @return void
     */
	public function getMovieList()
	{
		$this->load->model('Now_playing_movie','now_playing_movie',TRUE);
		$this->now_playing_movie->city_id = $this->nowCityId;
		$this->movieList = $this->now_playing_movie->getMovieDetailByCityId();
		foreach ($this->movieList as &$movieDetail) {
			$movieDetail->summary = $this->tools->filterString($movieDetail->summary, 900);	
			$movieDetail->cast = $this->tools->filterString($movieDetail->cast, 100);
            $movieDetail->movie_type = $this->tools->filterMovieType($movieDetail->movie_type, ',');
            $movieDetail->title = $this->tools->filterMovieName($movieDetail);
		}
	}

    /**
     * get now top movie list
     *
     * @return void
     */
	public function getTOPMovieList()
	{
		$this->topMovie = $this->now_playing_movie->getTopMovieByCityId();
		foreach ($this->topMovie as &$movieDetail) {
			$movieDetail->cast = $this->tools->filterCast($movieDetail->cast, 2);
			$movieDetail->director = $this->tools->filterCast($movieDetail->director);
            $movieDetail->title = $this->tools->filterMovieName($movieDetail);
		}
	}

    /**
     * get later movie list
     * 
     * @return void
     */
	public function getLaterMovieList()
	{
		$this->load->model('Later_movie','later_movie',TRUE);
		$this->later_movie->city_id = $this->nowCityId;
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
		$this->smarty->assign('localIp', $this->nowCityId);
		$this->smarty->assign('base_url', base_url());
		$this->smarty->assign('movieList', $this->movieList);
		$this->smarty->assign('topMovie', $this->topMovie);
		$this->smarty->assign('laterMovie', $this->laterMovieList);
		$this->smarty->assign('cityList', $this->city_data);
        $this->smarty->view('movie_index.html');
	}
}
