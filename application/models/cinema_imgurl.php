<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_city_list
 **/

class cinema_imgurl extends CI_Model
{
    /**
     * 基本字段
     */
    var  $id = ''; 
    var  $d_m_number = ''; 
    var  $c_imgurl = ''; 
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_cinema_imgurl';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * get city info by zh name
     */
    public function getInfoByCinemaId($cinemaId)
    {
        $sql = "select * from " . self::__TABLE . " where d_m_number = " . $cinemaId;
        $ret = $this->db->query($sql);
        return $ret->result();
    }
}
