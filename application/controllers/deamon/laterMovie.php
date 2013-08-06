<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * Maps to the following URL
 * http://example.com/dmovie
 *
 * @author Leo (haojianping) $
 *
 */
class LaterMovie extends CI_Controller {

    const NOWPLAY_URL = 'http://movie.douban.com/nowplaying/';
    const MOVIE_DETAIL_URL = 'https://api.douban.com/v2/movie/';

    public $movie_arr   = array();

    public $allow_field = array('author','alt_title','rating','title','summary', 'attrs', 'tags');
    public $allow_attrs_field = array('website','country','writer','director','cast','pubdate','language','movie_duration','year','movie_type');

    public function index()
    {
        $this->nums = 10;
        $this->__pregStr();
        $this->__getAllCity();
    }

    private function __capture()
    {
        if(!empty($this->all_city))
        {
            foreach ($this->all_city as $d_city_id => $cn_name)
            {
                $this->city_id = $d_city_id;
                $this->__getContents(self::NOWPLAY_URL, $cn_name); 
                $this->__pregMatchAll();
                if(empty($this->preg_data))
                {
                    continue;
                }
                else
                {
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
        $this->preg_str = '/<div id=\"upcoming\">(.*?)<\/div>[^<].*?<div id=\"ticket-guide\"/is';
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
                $this->all_city = array($data_info->d_c_id => $data_info->zh_name);
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
        var_dump($this->get_contents);die;
    }

    private function __pregMatchAll()
    {
        $find_str='你所在的城市没有影讯覆盖';
        if(strpos($this->get_contents, $find_str) == false)
        {
            preg_match($this->preg_str,$this->get_contents,$this->preg_datas);
            preg_match_all($this->preg_hrefstr,$this->preg_datas[0],$this->preg_data);
        }
        else
        {
            $this->preg_data = array();
        }
    }

    private function __disposePregData()
    {
        $this->load->model('Later_movie','later_movie',TRUE);

        array_shift($this->preg_data[1]);
        foreach($this->preg_data[1] as $movie_id)
        {
            if(is_numeric($movie_id))
            {
                if($this->nums > 0)
                {
                    $this->movie_id = $movie_id;
                    $this->__getDetailContents();
                    $this->__disposeDetailData();
                    $this->later_movie->d_id = $movie_id;
                    $this->later_movie->city_id = $this->city_id;
                    $this->later_movie->insertMovieData();
                /*
                    if(!$this->later_movie->isExistMovie())
                    {
                        //update create time
                        $this->later_movie->updateCreateTime();die;
                    }
                    else
                    {
                        $this->later_movie->insertMovieData();
                    }
                 */
                    $this->nums = $this->nums - 1;
                }
                else
                {
                    sleep(61);
                    $this->nums = 10;
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
        $this->get_detail_contents = substr($this->get_detail_contents, 0, -1);
        $this->get_detail_contents = json_decode($this->get_detail_contents);
        var_dump($this->get_detail_contents);die;
        foreach($this->get_detail_contents as $key_name => $value)
        {
            if(in_array($key_name, $this->allow_field))
            {
                $author_arr = array(); 
                $tags_arr    = array();
                if($key_name == 'rating')
                {
                    $this->later_movie->$key_name = $value->average;
                    continue;
                }
                if($key_name == 'author')
                {
                    foreach($value as $authors)
                    {
                        array_push($author_arr, $authors->name);
                    }
                    $this->later_movie->$key_name = implode(",", $author_arr); 
                    continue;
                }
                if($key_name == 'tags')
                {
                    foreach($value as $tags)
                    {
                        array_push($tags_arr, $tags->name);
                    }
                    $this->later_movie->$key_name = implode(",", $tags_arr); 
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
                            $this->later_movie->$attr_key = implode(",", $attr_arr); 
                        }
                    }
                    continue;
                }
                $this->later_movie->$key_name = $value;
            }

        }
    }

}
