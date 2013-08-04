<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MovieDetail extends CI_Controller {

    private $movieInfo;
    private $movieId;
    private $cityId;


	public function __construct()
	{
		parent::__construct();

	}

	public function dispose($movieId, $cityId)
	{
		$this->movieId = $movieId;
		$this->cityId = $cityId;
		$this->getMovieDetail();
        $this->showView();
	}

	public function getMovieDetail()
	{
		$this->load->model('Now_playing_movie','now_playing_movie',TRUE);
		$this->now_playing_movie->d_id = $this->movieId;
		$this->now_playing_movie->city_id = $this->cityId;
		$this->movieInfo = $this->now_playing_movie->getMovieDetailByMovieId();
		$this->movieInfo[0]->summary = $this->_filterString($this->movieInfo[0]->summary, 900);	
		$this->movieInfo[0]->cast = $this->_filterString($this->movieInfo[0]->cast, 100);
        $this->movieInfo[0]->title = $this->tools->filterMovieName($this->movieInfo[0]);
	}

	public function showView()
	{
		$this->smarty->assign('base_url', base_url());
        $this->smarty->assign('movieInfo',$this->movieInfo[0]);
        $this->smarty->view('movie_detail.html');
	}

	private function _filterString($data, $num)
	{
		if (strlen($data) > $num) {
			$data = substr($data, 0, $num) . "...";
		}
		return $data;
	}
}
