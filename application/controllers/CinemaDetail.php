<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CinemaDetail extends CI_Controller {

    private $cinemaInfo;
    private $cinemaImgUrl;
    public $cinemaId;
    public $cityId;
    public $typeconfig;
    public $language;
    public $areaId;
    public $dayId;
    public $languageId;
    public $typeId;
    private $cinemaid;
	private $type_id;
	private $language_id;
	private $day;
	private $index = 0;
	private $number = 0;
    private $areaInfo = array();
    private $dealInfo = array();


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Now_playing_movie','now_playing_movie',TRUE);
		$this->load->model('cinema_model');
		$this->load->model('cinema_imgurl');
		$this->config->load("assoc");
		$this->typeconfig = $this->config->item("typeConfig");
		$this->language = $this->config->item("language");
	}

	public function dispose($cinemaId, $dayId = 1, $languageId = 0, $typeId = 0)
	{
		$this->cinemaId = $cinemaId;
		$this->dayId = $dayId;
		$this->languageId = $languageId;
		$this->typeId = $typeId;
		$this->getCinemaDetail();
		$this->getTOPMovieList();
		$this->getAreaInfo();
		$this->dealWithMovies();
        $this->showView();
	}

	/**
	 * Deal with movies
	*/
	private function dealWithMovies($type = false) {
        $filterMovieInfo = array();
        $this->params = new stdClass();
        $this->params->cinemaId = $this->cinemaId;
        $this->params->dayId = $this->dayId;
        $this->params->languageId = $this->languageId;
        $this->params->typeId = $this->typeId;
        $this->params->cityId = $this->cityId;
		$ret = $this->now_playing_movie->getCinemaPq($this->params);
        foreach ($ret as $movieInfo) {
            $nowType = @$this->typeconfig[$movieInfo->type_id];
            $nowLanguage =  @$this->language[$movieInfo->language_id];
            $key = $nowType . '_' . $nowLanguage;
            $filterMovieInfo[$movieInfo->movie_id]['cinema_id'] = $movieInfo->cinema_id; 
 //           $filterMovieInfo[$movieInfo->movie_id]['type_id'] = @$this->typeconfig[$movieInfo->type_id]; 
 //           $filterMovieInfo[$movieInfo->movie_id]['language_id'] = @$this->language[$movieInfo->language_id]; 
            $filterMovieInfo[$movieInfo->movie_id]['price'] = $movieInfo->price; 
            $filterMovieInfo[$movieInfo->movie_id]['day'] = $movieInfo->day; 
            $filterMovieInfo[$movieInfo->movie_id]['alt_title'] = $movieInfo->alt_title; 
            $filterMovieInfo[$movieInfo->movie_id]['country'] = $movieInfo->country; 
            $filterMovieInfo[$movieInfo->movie_id]['director'] = $movieInfo->director; 
            $filterMovieInfo[$movieInfo->movie_id]['cast'] = $movieInfo->cast; 
            $filterMovieInfo[$movieInfo->movie_id]['movie_type'] = $movieInfo->movie_type; 
            $filterMovieInfo[$movieInfo->movie_id]['s_time'][$key]['type'] = $nowType;
            $filterMovieInfo[$movieInfo->movie_id]['s_time'][$key]['language'] = $nowLanguage;
            $filterMovieInfo[$movieInfo->movie_id]['s_time'][$key]['time'][] = $movieInfo->s_time; 
            $filterMovieInfo[$movieInfo->movie_id]['s_time'][$key]['time'] = array_unique($filterMovieInfo[$movieInfo->movie_id]['s_time'][$key]['time']);
        }
		$this->smarty->assign('dealInfo',$filterMovieInfo);
		$this->smarty->assign('obj',$this->params);
	}

	/**
	 * get area info
	*/
	private function getAreaInfo() {
		$this->areaInfo = $this->now_playing_movie->getAreaForCityId($this->cityId);
	}

	public function getCinemaDetail()
	{
		$this->cinemaInfo = $this->cinema_model->getCinemaList($this->cinemaId);
        $this->cinemaInfo[0]->c_imgurl = preg_replace("/img\d.douban.com/", "img2.douban.com", $this->cinemaInfo[0]->c_imgurl);
        $this->cityId = $this->cinemaInfo[0]->city_id;
		$this->cinemaImgUrl = $this->cinema_imgurl->getInfoByCinemaId($this->cinemaId);
        foreach ($this->cinemaImgUrl as $imgInfo) {
            $imgInfo->c_imgurl = preg_replace("/img\d.douban.com/", "img2.douban.com", $imgInfo->c_imgurl);
        }
	}

    /**
     * get now top movie list
     *
     * @return void
     */
	public function getTOPMovieList()
	{
		$this->now_playing_movie->city_id = $this->cityId;
		$this->topMovie = $this->now_playing_movie->getTopMovieByCityId();
		foreach ($this->topMovie as &$movieDetail) {
			$movieDetail->cast = $this->tools->filterCast($movieDetail->cast, 2);
			$movieDetail->director = $this->tools->filterCast($movieDetail->director);
            $movieDetail->title = $this->tools->filterMovieName($movieDetail);
		}
	}

	public function showView()
	{
		$this->config->load("assoc");
		$this->smarty->assign("type", $this->config->item("typeConfig"));
		$this->smarty->assign("language", $this->config->item("language"));
		$this->smarty->assign('base_url', base_url());
		$this->smarty->assign('areaInfo',$this->areaInfo);
        $this->smarty->assign('cinemaInfo',$this->cinemaInfo[0]);
		$this->smarty->assign('topMovie', $this->topMovie);
		$this->smarty->assign('cinemaImgUrl', $this->cinemaImgUrl);
        $this->smarty->view('cinema_detail.html');
	}

	private function _filterString($data, $num)
	{
		if (strlen($data) > $num) {
			$data = mb_substr($data, 0, $num, 'utf-8') . "...";
		}
		return $data;
	}
}
