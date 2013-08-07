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
    var  $city_id, $area_id, $d_m_number, $d_m_id, $c_name, $c_address, $c_http, $c_phone, $c_time;
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_city_list';
    const __TBCINEMA = 'fc_cinema_list';

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
}