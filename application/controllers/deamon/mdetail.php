<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Maps to the following URL
     *      http://example.com/dmovie
     *
     * @author Leo (haojianping) $
     *
     */
class Mdetail extends CI_Controller {

    const MOVIE_DETAIL_URL = 'https://api.douban.com/v2/movie/';

    public function index()
    {
        $this->__process();   
    }

    private function __process()
    {
        $this->__getMovieIds();
        $this->__capture();
    }

    private function __getMovieIds()
    {
        $this->movie_ids = array(
            '3231742',
            '6973376',
            '1907966',
            '19973815',
            '10617168',
            '4301181',
            '5959696',
            '20280082',
            '10467779',
            '6514136',
            '3775167',
            '3041269',
            '6011806',
            '4078562',
            '10574468',
            '2124750',
            '10537853',
            '10756728',
            '4707225',
            '10759790',
            '5919324'
        );
    }

    private function __capture()
    {
        foreach($this->movie_ids as $m_id)
        {
            $this->request_results = file_get_contents(Mdetail::MOVIE_DETAIL_URL . $m_id);
            var_dump(json_decode($this->request_results));die;
        }
    }
}
