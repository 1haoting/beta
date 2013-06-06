<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * Maps to the following URL
 * http://example.com/dmovie
 *
 * @author Leo (haojianping) $
 *
 */
class Movie extends CI_Controller {

    const NOWPLAY_URL = 'http://movie.douban.com/nowplaying/';
    const MOVIE_DETAIL_URL = 'https://api.douban.com/v2/movie/';

    public $movie_arr   = array();

    public $allow_field = array('author','alt_title','rating','title','summary', 'attrs', 'tags');
    public $allow_attrs_field = array('website','country','writer','director','cast','pubdate','language','movie_duration','year','movie_type');

    public function index()
    {
        $this->nums = 20;
        $this->__pregStr();
        $this->__getAllCity();
    }

    private function __capture()
    {
        if(!empty($this->all_city))
        {
            foreach ($this->all_city[0] as $local_city_id => $simple_city_info)
            {
                foreach ($simple_city_info as $d_city_id => $cn_name)
                {
                    $this->city_id = $d_city_id;
                    $this->__getContents(self::NOWPLAY_URL, $cn_name); 
                    $this->__pregMatchAll();
                    $this->__disposePregData();
                }
            }
        }
    }

    /**
     * preg match str
     *
     * @return obj $this->preg_str
     */
    private function __pregStr()
    {
        $this->preg_str = '/<div[^>].*?class=\"lists\">(.*?)<\/div>/is';
        $this->preg_hrefstr = '/<a.*?href="http:\/\/movie.douban.com\/subject\/(.+?)\/.*?"><img [^>].+?\/><\/a>/is';
    }

    /**
     * get all city 
     *
     * @beijing shanghai
     */
    private function __getAllCity()
    {
        $this->all_city = array();
        $this->load->model('City_List');
        $this->City_List->field_str = 'id, d_c_id, zh_name';
        $this->city_data = $this->City_List->selectCityInfoByField();
        if(!empty($this->city_data))
        {
            foreach($this->city_data as $data_info)
            {
                $temp_arr[$data_info->id] = array($data_info->d_c_id => $data_info->zh_name);
                array_push($this->all_city, $temp_arr);
                $this->__capture();
            }
        }
    }

    /**
     * get nowplaying movie id  on city
     *
     * @http://movie.douban.com/nowplaying/beijing
     */
    private function __getContents($url, $cn_name)
    {
        $this->get_contents = file_get_contents($url . $cn_name);
    }

    private function __pregMatchAll()
    {
        preg_match($this->preg_str,$this->get_contents,$this->preg_datas);
        preg_match_all($this->preg_hrefstr,$this->preg_datas[1],$this->preg_data);
    }

    private function __disposePregData()
    {
        $this->load->model('Now_playing_movie','now_playing_movie',TRUE);

        foreach($this->preg_data[1] as $movie_id)
        {
            if(is_numeric($movie_id))
            {
                if($this->nums > 0)
                {
                    $this->movie_id = $movie_id;
                    $this->__getDetailContents();
                    $this->__disposeDetailData();
                    $this->now_playing_movie->d_id = $this->movie_id;
                    $this->now_playing_movie->city_id = $this->city_id;
                    $this->now_playing_movie->insertMovieData();
                /*
                    if(!$this->now_playing_movie->isExistMovie())
                    {
                        //update create time
                        $this->now_playing_movie->updateCreateTime();die;
                    }
                    else
                    {
                        $this->now_playing_movie->insertMovieData();
                    }
                 */
                    $this->nums = $this->nums - 1;
                }
                else
                {
                    sleep(60);
                    $this->nums = 20;
                }
            }    
        }
    }

    /**
     * get nowplaying movie id  on city
     * @https://api.douban.com/v2/movie/movie_id
     **/
    private function __getDetailContents()
    {
        $this->get_detail_contents = file_get_contents(self::MOVIE_DETAIL_URL . $this->movie_id);
    }

    /**
     * dispose get detail contents
     * json_decode
     **/
    private function __disposeDetailData()
    {
        $this->get_detail_contents = json_decode($this->get_detail_contents);
        foreach($this->get_detail_contents as $key_name => $value)
        {
            if(in_array($key_name, $this->allow_field))
            {
                $author_arr = array(); 
                $tags_arr    = array();
                if($key_name == 'rating')
                {
                    $this->now_playing_movie->$key_name = $value->average;
                    continue;
                }
                if($key_name == 'author')
                {
                    foreach($value as $authors)
                    {
                        array_push($author_arr, $authors->name);
                    }
                    $this->now_playing_movie->$key_name = implode(",", $author_arr); 
                    continue;
                }
                if($key_name == 'tags')
                {
                    foreach($value as $tags)
                    {
                        array_push($tags_arr, $tags->name);
                    }
                    $this->now_playing_movie->$key_name = implode(",", $tags_arr); 
                    continue;
                }
                if($key_name == 'attrs')
                {
                    foreach($value as $attr_key => $attrs_value)
                    {
                        $attr_arr = array();
                        if(in_array($attr_key, $this->allow_attrs_field))
                        {
                            foreach($attrs_value as $field_detail)
                            {
                                array_push($attr_arr, $field_detail);
                            }
                            $this->now_playing_movie->$attr_key = implode(",", $attr_arr); 
                        }
                    }
                    continue;
                }
                $this->now_playing_movie->$key_name = $value;
            }

        }
    }

}
