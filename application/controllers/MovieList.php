<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MovieList extends CI_Controller {

    private $movieInfo;
    private $movieId;
    private $cityId;
    private $nowCityId = '108288';


	public function __construct()
	{
		parent::__construct();
		$this->load->library('tools');
	}

	public function dispose($cityId)
	{
		$this->getMovieList();
		$this->getTOPMovieList();
        $this->showView();
	}

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
		$this->smarty->assign('base_url', base_url());
		$this->smarty->assign('movieList', $this->movieList);
		$this->smarty->assign('topMovie', $this->topMovie);
        $this->smarty->view('movie_list.html');
	}
}
