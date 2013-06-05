<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);
/**
 * Maps to the following URL
 *      http://example.com/dmovie
 *
 * @author Leo (haojianping) $
 *
 */
class City extends CI_Controller {

    //get city url
    const CITY_URL = 'http://movie.douban.com/nowplaying/beijing/';
    //get area url
    const AREA_URL = "http://movie.douban.com/subject/3231742/cinema/";

    public function index()
    {
        $this->load->model('City_List');
        $this->__getAllCity();
        $this->__disposeCityData();
        $this->__getCityNames();
        $this->__getAreaInfo();
    }

    /**
     * __getAllCity
     *
     * get all city info
     */  
    private function __getAllCity()
    {
        $this->allCityArray = array();
        $content = file_get_contents(self::CITY_URL);
        $reg = "/<dl class=\"city-mod\">(.+?)<\/dl>/is";
        $regid = "/<span><a[^>].+? id=\"(.+?)\".+?>.+?<\/a><\/span>/is";
        $reguid = "/<span><a[^>].+? uid=\"(.+?)\">.+?<\/a><\/span>/si";
        $regname = "/<span><a[^>].+?>(.+?)<\/a><\/span>/si";
        $regchar = "/<dt>(.+?)<\/dt>/si";

        preg_match_all($reg,$content,$match);
        $cityStrArray = $match[1];
        foreach($cityStrArray as $v)
        {
            //获取A,B,C,D
            preg_match($regchar,$v,$match);
            $charkey = $match[1];
            //获取豆瓣城市ID
            preg_match_all($regid,$v,$match);
            $this->allCityArray[$charkey]['id'] = $match[1];
            //获取豆瓣城市拼音
            preg_match_all($reguid,$v,$match);
            $this->allCityArray[$charkey]['zh_name'] = $match[1];
            //获取豆瓣城市名称
            preg_match_all($regname,$v,$match);
            $this->allCityArray[$charkey]['name'] = $match[1];
        }
    }

    /**
     *  __getAreaInfo
     *
     *  get all area info
     */
    private function __getAreaInfo()
    {
        foreach($this->names_data as $name_detail)
        {
            $this->allAreaArray = array();
            $content = file_get_contents(self::AREA_URL . $name_detail->zh_name . '/');
            $reg = "/<ul[^>]id=\"zone-id\" data-zone-id=\"None\">(.+?)<\/ul>/si";
            $regid = "/<li><a[^>].*?data-zone=\"(.+?)\".*?>.*?<\/a><\/li>/is";
            $regname = "/<a[^>].*?data.+?>(.+?)<\/a>/si";

            preg_match($reg,$content,$match);
            $content = $match[0];

            //获取豆瓣区域ID
            preg_match_all($regname,$content,$match);
            $this->allAreaArray['name'] = $match[1];

            //获取豆瓣区域ID
            preg_match_all($regid,$content,$match);
            $this->allAreaArray['id'] = $match[1];
            $this->__disposeAreaData($name_detail->id);
            sleep(20);
        }


    }

    /**
     * __disposeCityData
     *
     * dispose city data and insert Database
     */
    private function __disposeCityData()
    {
        foreach($this->allCityArray as $city_detail)
        {
            foreach($city_detail['id'] as $subscript => $value) 
            {
                $this->City_List->d_c_id = $value;
                $this->City_List->name = $city_detail['name'][$subscript];
                $this->City_List->zh_name = $city_detail['zh_name'][$subscript];
//                $this->City_List->insertCityData();
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
        $this->City_List->field_str = 'zh_name, id';
        $this->names_data = $this->City_List->selectCityInfoByField();
    }

    /**
     * __disposeAreaData
     *
     * @param integer $parent_id area parent id
     *
     * dispose area data and insert Database
     */
    private function __disposeAreaData($parent_id)
    {
        foreach($this->allAreaArray['id'] as $subscript => $value) 
        {
            $this->City_List->d_c_id = $value;
            $this->City_List->name = $this->allAreaArray['name'][$subscript];
            $this->City_List->parent_id = $parent_id;
  //          $this->City_List->insertCityData();
        }
    }
}
