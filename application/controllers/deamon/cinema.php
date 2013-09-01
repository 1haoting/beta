<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);
/**
 * Maps to the following URL
 *      http://example.com/cinema
 *
 * @author Leo (Cheow Tong) $
 *
 */
class Cinema extends CI_Controller {

    //get city url
    const CINEMA_URL   = 'http://movie.douban.com/j/cinemas/?city_id=';
    const CINEMA_PARAM = '&district_id=';
    var $index = 0;
    var $introurl = array();

    /*
     * 构造器
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('cinema_model');
    }

    /*
     * 获取影院基本信息并入库
     */
    public function index()
    {
        $this->__getCityNames();
        if($this->__forSetCityName() === FALSE) {
            printf("%s", "not found");
        }
    }

    /*
     * 获取影院简介信息并入库
     */
    public function cinemainfo() {
        $this->__getCinemaIntroPreg();
        $this->__getCinemaDetailPreg();
        $this->__getCinemaUrl();
        $this->__getCinemaIntroInfo();
        $this->__getCinemaDetailInfo();
    }

    /*
     * 获取影院首页图片
     */
    public function cinemaimage() {
        $this->__getCinemaImgPreg();
        $this->__getCinemaUrl();
        $this->__getcinemaImg();
    }

    /*
     * 获取影院首页图片
     */
    private function __getcinemaImg() {
        $this->index = 0;
        if($this->url_list) {
            foreach ($this->url_list as $key => $value) {
                if($this->index < 45) {
                    $intro = file_get_contents($value->c_http);
                    preg_match($this->cinema_imginfo_preg, $intro, $match);
                    isset($match[1]) && preg_match($this->cinema_img_preg, $match[1], $img);
                    isset($img[1]) && $this->cinema_model->_updCinemaData(array("d_m_number", $value->d_m_number), array("c_imgurl"=>$img[1]));
                } else {
                    sleep(60);
                    $this->index = 0;
                }
            }
        }
    }


    /*
     * 获取影院页面信息
     *
     */
    private function __getCinemaIntroInfo() {
        $this->index = 0;
        if($this->url_list) {
            foreach($this->url_list as $v) {
                if($this->index < 45) {
                    $intro = file_get_contents($v->c_http);
                    preg_match($this->cinema_introall_preg, $intro, $match);
                    $intro = $match[1];
                    preg_match($this->cinema_intro_pref, $intro, $match);
                    if(isset($match[1])) {
                        $detailArray = array('id'=>$v->d_m_number, 'url'=>$match[1]);
                        array_push($this->introurl, $detailArray);
                    }
                    $this->index++;
                } else {
                    sleep(60);
                    $this->index = 0;
                }
            }
        }
    }

    /**
     * 获取影院详细信息
     */
    private function __getCinemaDetailInfo() {
        $this->index = 0;
        if($this->introurl) {
            foreach($this->introurl as $v) {
                if($this->index < 15) {
                    $detailInfo = array();
                    $detail = file_get_contents($v['url']);
                    preg_match($this->cinema_web_preg, $detail, $weburl);
                    $detailInfo['c_weburl'] = !empty($weburl) ? $weburl[1] : '';
                    preg_match($this->cinema_riding_preg, $detail, $riding);
                    $detailInfo['c_riding'] = !empty($riding) ? $riding[1] : '';
                    preg_match($this->cinema_detail_preg, $detail, $details);
                    $detailInfo['c_content'] = !empty($details) ? $details[1] : '';
                    preg_match($this->cinema_imgurlall_preg, $detail, $imgurlall);
                    if($imgurlall) {
                        $imgurlall = $imgurlall[1];
                        preg_match_all($this->cinema_imgurl_preg, $imgurlall, $imgurl);
                        if($imgurl) {
                            $imgurl = $imgurl[1];
                            !empty($imgurl) && $detailInfo['c_imgnumber'] = count($imgurl);
                            !empty($imgurl) && $this->_insertImgUrl($imgurl, $v['id']);
                        }
                    }
                    $detailInfo['c_updtime'] = time();
                    $this->cinema_model->_updCinemaData($detailInfo, array('d_m_number'=>$v['id']));
                    $this->index++;
                } else {
                    sleep(20);
                    $this->index = 0;
                }
            }
        }
    }

    /**
     * 入库影院需要下载的图片路径
     */
    private function _insertImgUrl($imgurl, $id) {
        $idx = 1;
        foreach($imgurl as $v) {
            $insertArray = array('d_m_number'=>$id, 'c_imgurl'=>$v, 'c_index'=>$idx);
            $this->cinema_model->insertCinemaImgUrlData($insertArray);
            $idx++;
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
                if($this->index < 45){
                    $this->__getCinemaPageInfo($val);
                    $this->index++;
                } else {
                    sleep(60);
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


    /**
     * __getCinemaUrl
     * 
     * select cinema url list for database
     */
    public function __getCinemaUrl() {
        $this->url_list = $this->cinema_model->_getCinemaUrl();
    }


    /**
     * __getCinemaIntroPreg 
     */
    private function __getCinemaIntroPreg() {
        $this->cinema_introall_preg = "/<div class=\"nav-items\">(.+?)<\/div>/is";
        $this->cinema_intro_pref = "/优惠.+?<a href=\"(.+?)\" hidefocus=\"true\">.+?影院介绍.+?<\/a>/is";

    }

    /**
     * __getCinemaimgpreg
     */
    private function __getCinemaImgPreg() {
        $this->cinema_imginfo_preg = "/<div class=\"user-pic\">(.+?)<\/div>/is";
        $this->cinema_img_preg = "/src=\"(.+?)\"/is";

    }


    /**
     * __getCinemaDetailPreg 
     */
    private function __getCinemaDetailPreg() {
        $this->cinema_web_preg = "/<p>网站：<a[^>].*?>(.+?)<\/a><\/p>/is";
        $this->cinema_riding_preg = "/<p>乘车：(.+?)<\/p>/is";
        $this->cinema_detail_preg = "/<h2>详细介绍<\/h2>[^<].*?<p>(.+?)<\/p>/is";
        $this->cinema_imgurlall_preg = "/<ul class=\"list-s\">(.+?)<\/ul>/is";
        $this->cinema_imgurl_preg = "/<img src=\"(.+?)\".+?>/is";
    }
}
