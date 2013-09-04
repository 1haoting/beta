<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_city_list
 **/

class Cinema_model extends CI_Model
{
    /**
     * 基本字段
     */
    var $city_id;
    var $area_id;
    var $d_m_number;
    var $d_m_id;
    var $c_name;
    var $c_address;
    var $c_http;
    var $c_phone;
    var $c_time;
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_city_list';
    const __TBCINEMA = 'fc_cinema_list';
    const __TBCINEMAIMG = 'fc_cinema_imgurl';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert movie data
     */
    public function insertCinemaData()
    {
        $this->db->insert(self::__TBCINEMA, $this);
    }

    /**
     * insert cinema_imgurl data
     */
    public function insertCinemaImgUrlData($data) {
        $this->db->insert(self::__TBCINEMAIMG, $data);
    }

    /**
     * update cinema_list data
     */
    public function _updCinemaData($data, $where) {
        $this->db->update(self::__TBCINEMA, $data, $where);
    }

    /**
     *
     * get city info
     *
     */
    public function _getCityInfo() {
        $query = "SELECT city.d_c_id as cityid, area.d_c_id as areaid FROM " . self::__TABLE 
                    . " area LEFT JOIN " . self::__TABLE . " city"
                    . " ON area.parent_id=city.id"
                    . " WHERE area.parent_id!=0 ORDER BY city.id";
        $ret = $this->db->query($query);
        return $ret->result();
    }


    /**
     * get cinema url list
     */
    public function _getCinemaUrl() {
        //$query = "SELECT d_m_number, c_http FROM " . self::__TBCINEMA;
        $query = "SELECT d_m_number, c_http FROM " . self::__TBCINEMA;//. " WHERE c_content=''"
        $qy = $this->db->query($query);
        return $qy->result();
    }

    /**
     * get cinema image url list
     */
    public function _getCinemaImgUrl() {
        $query = "SELECT d_m_number, c_imgurl, c_index FROM " . self::__TBCINEMAIMG;
        $qy = $this->db->query($query);
        return $qy->result();
    }
    /**
     *
     * get city info
     *
     */
    public function getCityInfoByCityAreaId() {
        $sql = 'SELECT * FROM ' . self::__TBCINEMA;
        $where = ' WHERE city_id = ' . $this->city_id;
        if (isset($this->area_id)) {
            $where .= ' AND area_id = ' . $this->area_id;
        }
        $query = $sql . $where;
        $ret = $this->db->query($query);
        return $ret->result();
    }

    /**
     *
     * get cinema list
     *
     */
    public function getCinemaList( $cinemaId = 0 ) {
        $query = 'SELECT * FROM ' . self::__TBCINEMA . ($cinemaId ? ' WHERE d_m_number=' . $cinemaId : '');
        $ret = $this->db->query($query);
        return $ret->result();
    }

    /**
     *
     * get top five cinema info
     *
     */
    public function getTopCinemaList() {
        $sql = 'SELECT * FROM ' . self::__TBCINEMA;
        $where = ' WHERE city_id = ' . $this->city_id;
        $where .= ' ORDER BY RAND() LIMIT 5';
        $query = $sql . $where;
        $ret = $this->db->query($query);
        return $ret->result();
    }
}
