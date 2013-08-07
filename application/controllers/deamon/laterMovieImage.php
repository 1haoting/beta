<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * Maps to the following URL
 * http://example.com/dmovie
 *
 * @author Leo (haojianping) $
 *
 */
class LaterMovieImage extends CI_Controller {

    const SMALL_IMAGE_FILE = 'http://img3.douban.com/view/photo/icon/public/';
    const LARGE_IMAGE_FILE = 'http://img3.douban.com/view/movie_poster_cover/lpst/public/';

    private $idArr;

    public function index()
    {        
        $this->_getOnlyMovieDid();
        $this->_getDetailContents();
    }

    private function _getOnlyMovieDid()
    {
        $this->load->model('Later_movie','later_movie',TRUE);
        $this->idArr = $this->later_movie->getOnlyMovieDid();
    }


    /**
     * get nowplaying movie id  on city
     * @https://api.douban.com/v2/movie/movie_id
     **/
    private function _getDetailContents()
    {
        foreach ($this->idArr as $movieInfo) {
            $postfixName = $this->filterImageUrl($movieInfo->image_url);
            $largeImageUrl = self::LARGE_IMAGE_FILE . $postfixName;
            $largeFileName = $movieInfo->d_id . '_later_large.jpg';
            $this->getMovieImage($largeImageUrl, $largeFileName);
            $smallImageUrl = self::SMALL_IMAGE_FILE . $postfixName;
            $smallFileName = $movieInfo->d_id . '_later_small.jpg';
            $this->getMovieImage($smallImageUrl, $smallFileName);
        }
    }

    /**
     * get movie image pull local path
     * 
     * @param string $imageUrl 
     * @param string $fileName
     *
     * @return void
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

    /**
     * filter image url 
     *
     * @param string $imageUrl movie image url
     *
     * @return string
     */
    public function filterImageUrl($imageUrl)
    {
        $filterUrl = explode("/", $imageUrl);
        $arraySum = count($filterUrl);
        return $filterUrl[$arraySum-1];
    }



}
