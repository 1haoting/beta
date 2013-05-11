<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Maps to the following URL
     *      http://example.com/dmovie
     *
     * @author Leo (haojianping) $
     *
     */
class Movie extends CI_Controller {

    const NOWPLAY_URL = 'http://movie.douban.com/nowplaying/beijing/';

    public function index()
    {
        $this->__process();   
    }

    private function __process()
    {
        $this->__pregStr();
        $this->__capture();
        $this->__pregMatchAll();
        $this->__disposePregData();
    }

    private function __capture()
    {
        $this->request_results = file_get_contents(Movie::NOWPLAY_URL);
    }

    private function __pregStr()
    {
        $this->preg_str = '/<a class="thumb" href="http:\/\/movie.douban.com\/subject\/(.+?)\/"><img [^>].+?\/><\/a>/is';
        
    }

    private function __pregMatchAll()
    {
        preg_match_all($this->preg_str,$this->request_results,$this->preg_data);
    }

    private function __disposePregData()
    {
        foreach($this->preg_data[1] as $movie_id)
        {
            if(is_numeric($movie_id))
            {
                echo $movie_id;echo '<br>';
            }    
        }
    }

}
