<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_city_list
 **/

class Subscibe_model extends CI_Model
{
    /**
     * 基本字段
     */
    var $phone;
    var $c_time;
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_subscibe';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert cinema_imgurl data
     */
    public function insertData() {
        return $this->db->insert(self::__TABLE, $this);
    }

}
