<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * Maps to the following URL
 * http://example.com/dmovie
 *
 * @author Leo (haojianping) $
 *
 */
class MovieImage extends CI_Controller {

    const MOVIE_DETAIL_URL = 'https://api.douban.com/v2/movie/subject/';

    private $idarr;

    public function index()
    {        
        $this->nums = 10;
        $this->_getOnlyMovieDid();
        $this->_getDetailContents();
    }

    private function _getOnlyMovieDid()
    {
        $this->load->model('Now_playing_movie','now_playing_movie',TRUE);
        $this->idArr = $this->now_playing_movie->getOnlyMovieDid();
    }


    /**
     * get nowplaying movie id  on city
     * @https://api.douban.com/v2/movie/movie_id
     **/
    private function _getDetailContents()
    {
        foreach ($this->idArr as $movieInfo) {
            if($this->nums > 0) {
                $detailContents = file_get_contents(self::MOVIE_DETAIL_URL . $movieInfo->d_id);
                $detailContents = substr($detailContents, 0, -1);
                $detailContents = json_decode($detailContents);
                $largeImageUrl = $detailContents->images->large;
                $largeFileName = $movieInfo->d_id . '_large.jpg';
                $this->getMovieImage($largeImageUrl, $largeFileName);
                $smallImageUrl = $detailContents->images->small;
                $smallFileName = $movieInfo->d_id . '_small.jpg';
                $this->getMovieImage($smallImageUrl, $smallFileName);
                $this->nums = $this->nums - 1;
            } else {
                sleep(61);
                $this->nums = 10;
            }
        }
    }

    /**
     * get movie image pull local path
     * 
     * @param string $imageUrl 
     * @param string $fileName
     */
    public function getMovieImage($imageUrl, $fileName)
    {
        $curl = curl_init($imageUrl);
        $fileName = BASEPATH . '../images/' . $fileName;
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $imageData = curl_exec($curl);
        curl_close($curl);
        $tp = @fopen($fileName, 'a');
        fwrite($tp, $imageData);
        fclose($tp);
    }



}
