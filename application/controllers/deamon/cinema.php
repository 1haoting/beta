<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);
/**
 * Maps to the following URL
 *      http://example.com/dmovie
 *
 * @author Leo (changzhaodong) $
 *
 */
class Cinema extends CI_Controller {

    //get city url
    const CINEMA_URL   = 'http://movie.douban.com/j/cinemas/?city_id=';
    const CINEMA_PARAM = '&district_id=';
    var $index = 0;

    public function index()
    {
        $this->load->model('cinema_model');
        $this->__getCityNames();
        if($this->__forSetCityName() === FALSE) {
            printf("%s", "not found");
        }
    }


    /**
     * __forSetCityName
     *
     * get cinema for foreach cityname
     */
    function __forSetCityName() {
        if(isset($this->names_data) && !empty($this->names_data)) {
            foreach($this->names_data as $val) {
                if($this->index < 15){
                    $this->__getCinemaPageInfo($val);
                    $this->index++;
                } else {
                    sleep(20);
                    $this->index = 0;
                }
            }
        } else {
            return false;
        }
    }


    /**
     * __getCinemaPageInfo
     *
     * get cinema page info
     */
    function __getCinemaPageInfo($result) {
        $url = self::CINEMA_URL . $result->cityid . self::CINEMA_PARAM . $result->areaid;
        $this->__getCinemaInfo($url, $result);
    }

    /**
     * __getCinemaInfo
     *
     * get cinema info
     */
    function __getCinemaInfo($url, $result) {
        $cinemainfo = file_get_contents($url);
        $cinemaif = json_decode($cinemainfo);
        if(!empty($cinemaif)) {
            foreach($cinemaif as $val) {
                $this->cinema_model->city_id    = $result->cityid;
                $this->cinema_model->area_id    = $result->areaid;
                $this->cinema_model->d_m_number = $val->site_id;
                $this->cinema_model->d_m_id     = $val->id;
                $this->cinema_model->c_name     = $val->name;
                $this->cinema_model->c_address  = $val->address;
                $this->cinema_model->c_http     = $val->url;
                $this->cinema_model->c_phone    = $val->telephone;
                $this->cinema_model->c_time     = time();
                $this->cinema_model->insertCinemaData();
            }
        }
    }

    
    /**
     * __getCityNames
     * 
     * select city list for database
     */
    private function __getCityNames()
    {
        $this->names_data = $this->cinema_model->_getCityInfo();
    }
}
