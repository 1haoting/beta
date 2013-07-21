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
	}

	public function showView()
	{
        $this->smarty->assign('test',$this->movieInfo[0]->author);
        $this->smarty->view('movie_detail.html');
	}
}
