<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MovieDetail extends CI_Controller {

    private $movieInfo;
    public $movieId;
    public $cityId;
    public $typeconfig;
    public $language;
    public $areaId;
    public $dayId;
    public $languageId;
    public $typeId;
    private $cinemaid;
	private $type_idd;
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
		$this->config->load("assoc");
		$this->typeconfig = $this->config->item("typeConfig");
		$this->language = $this->config->item("language");
	}

	public function dispose($movieId, $cityId, $areaId = 0,$dayId = 1, $languageId = 0, $typeId = 0)
	{
		$this->movieId = $movieId;
		$this->cityId = $cityId;
		$this->areaId = $areaId;
		$this->dayId = $dayId;
		$this->languageId = $languageId;
		$this->typeId = $typeId;
		$this->getMovieDetail();
		$this->getTOPMovieList();
		$this->getAreaInfo();
		$this->dealWithMovies();
        $this->showView();
	}

	/**
	 * Deal with movies
	*/
	private function dealWithMovies($type = false) {
		
		$ret = $this->now_playing_movie->getMoviePq($this);
		if ($ret) {
			$val = $ret[0];
			$cinemaid = $val->cinema_id;
			$this->type_id = $val->type_id;
			$this->language_id = $val->language_id;
			$this->day = $val->day;
			
			foreach ($ret as $key => $value) {
				if($value->cinema_id == $cinemaid) {
					$this->joinDealInfoOne($value, $type);
				} else {
					$cinemaid = $value->cinema_id;
					$this->index++;
					$this->number = 0;
					$this->joinDealInfoOne($value, $type);
				}
				
			}
		}
	}

	/**
	 * join dealinfo one
	*/
	private function joinDealInfoOne($value, $type) {
		
		if ($value->type_id == $this->type_id
				&& $value->language_id == $this->language_id
					&& $value->day == $this->day) {
			
			$this->joinDealInfoTwo($value, $type);
		} else {
			$this->type_id = $value->type_id;
			$this->language_id = $value->language_id;
			$this->day = $value->day;
			$this->number++;
			$this->joinDealInfoTwo($value, $type);
		}
	}

	/**
	 * join dealinfo two
	*/
	private function joinDealInfoTwo($value, $type) {
		$this->dealInfo[$this->index]['m_time'][$this->number]['type'] = @$this->typeconfig[$value->type_id];
		$this->dealInfo[$this->index]['m_time'][$this->number]['language'] = @$this->language[$value->language_id];
		$this->dealInfo[$this->index]['m_time'][$this->number]['day'] = ($value->day == 1) ? "今天" : "明天";
		
		$this->dealInfo[$this->index]['m_time'][$this->number]['s_time'][] = $value->s_time;
		if(!$type) {
			$this->dealInfo[$this->index]['name'] = $value->c_name;
			$this->dealInfo[$this->index]['price'] = $value->price;
			$this->dealInfo[$this->index]['address'] = $value->c_address;
			$this->dealInfo[$this->index]['phone'] = $value->c_phone;
			$this->dealInfo[$this->index]['chttp'] = $value->c_http;
			//$this->dealInfo[$this->index]['imgurl'] = $value->c_imgurl;
			$this->dealInfo[$this->index]['imgurl'] = "";
	
		}
	}

	/**
	 * get area info
	*/
	private function getAreaInfo() {
		$this->areaInfo = $this->now_playing_movie->getAreaForCityId($this->cityId);
	}

	public function getMovieDetail()
	{
		$this->now_playing_movie->d_id = $this->movieId;
		$this->now_playing_movie->city_id = $this->cityId;

		$this->movieInfo = $this->now_playing_movie->getMovieDetailByMovieId();

		$this->movieInfo[0]->summary = $this->_filterString($this->movieInfo[0]->summary, 900);	
		$this->movieInfo[0]->cast = $this->_filterString($this->movieInfo[0]->cast, 100);
        $this->movieInfo[0]->title = $this->tools->filterMovieName($this->movieInfo[0]);
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

	public function showView()
	{
		$this->config->load("assoc");
		$this->smarty->assign("type", $this->config->item("typeConfig"));
		$this->smarty->assign("language", $this->config->item("language"));
		$this->smarty->assign('base_url', base_url());
		$this->smarty->assign('areaInfo',$this->areaInfo);
		$this->smarty->assign('dealInfo',$this->dealInfo);
        $this->smarty->assign('movieInfo',$this->movieInfo[0]);
        $this->smarty->assign('obj',$this);
		$this->smarty->assign('topMovie', $this->topMovie);
        $this->smarty->view('movie_detail.html');
	}

	private function _filterString($data, $num)
	{
		if (strlen($data) > $num) {
			$data = mb_substr($data, 0, $num, 'utf-8') . "...";
		}
		return $data;
	}
}
