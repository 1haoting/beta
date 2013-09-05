<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * show now playing movie & later movie list
 * @author Haojianping
 * @version $Id: MovieList.php  2013-08-02 22:36:38Z $
 */
class MovieList extends CI_Controller {

    //movie detail
    private $movieInfo;
    //simple movie id
    private $movieId;
    //simple city id
    private $cityId;
    //example local city name
    private $localCityName;

    
	public function __construct()
	{
		parent::__construct();
		$this->load->library('tools');
	}
    
    /**
     * dispose all function
     *
     * @return void
     */
	public function dispose($cityId = null)
	{
        $this->getCityId($cityId);
		$this->getNowPlayMovieList();
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
        $this->localCityName = $this->tools->getLocalCity();
        $this->load->model('City_List');
        $this->City_List->zh_name = $this->localCityName;
        $this->city_data = $this->City_List->selectCityInfoByZhName();
        
        $this->localCityId = $cityId ? $cityId : $this->city_data[0]->d_c_id; 
    }

    /**
     * get now playing movie list
     *
     * @return void
     */
	public function getNowPlayMovieList()
	{
		$this->load->model('Now_playing_movie','now_playing_movie',TRUE);
		$this->now_playing_movie->city_id = $this->localCityId;
		$this->movieList = $this->now_playing_movie->getMovieDetailByCityId();
		foreach ($this->movieList as &$movieDetail) {
			$movieDetail->summary = $this->tools->filterString($movieDetail->summary, 900);	
			$movieDetail->cast = $this->tools->filterString($movieDetail->cast, 100);
            $movieDetail->movie_type = $this->tools->filterMovieType($movieDetail->movie_type, ',');
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
		$this->smarty->assign('movieList', $this->movieList);
		$this->smarty->assign('laterMovieList', $this->laterMovieList);
        $this->smarty->view('movie_list.html');
	}
}
