<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * assoc movie cinema 
 *
 * @author Leo (haojianping) $
 *
 */
class AssocMovieCinema extends CI_Controller {

    const ASSOC_URL = 'http://movie.douban.com/j/cinema/';
    var $index = 0;

	public function __construct()
	{
		parent::__construct();
        $this->load->model('cinema_model');
        $this->load->model('assoc_movie_cinema');
	}

    public function index()
    {
        $this->getCinemaList();
        $this->getAssocMovie();
    }

    /**
     * get cinema list
     *
     * @return void
     */
    public function getCinemaList()
    {
        $this->cinemaList = $this->cinema_model->getCinemaList();
    }

    /**
     * get assoc movie
     *
     * @return void
     */
    public function getAssocMovie()
    {
        foreach ($this->cinemaList as $cinemaInfo) {
            if($this->index < 45){
                $cinemaId = $cinemaInfo->d_m_number;
                $url = self::ASSOC_URL . $cinemaId . '/playing_movies';
                $this->assocDetail = file_get_contents($url);
                $this->assocDetail = json_decode($this->assocDetail, true); 
                $this->addAssocMovieCinema($cinemaId);
                $this->index++;
            } else {
                sleep(60);
                $this->index = 0;
            }
        }
    }

    /**
     * add assoc movie cinema 
     *
     * @param int $cinemaId cinema id
     *
     * @return void
     */
    public function addAssocMovieCinema($cinemaId)
    {
        $this->assoc_movie_cinema->cinema_id = $cinemaId; 
        foreach ($this->assocDetail as $movieInfo) {
            $this->assoc_movie_cinema->movie_id = $movieInfo['id'];
            if(!($this->assoc_movie_cinema->isExistInfo())) {
                $this->assoc_movie_cinema->insertAssocInfo();
            }
        }
    }
}
