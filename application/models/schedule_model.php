<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_city_list
 **/

class Schedule_model extends CI_Model
{
    /**
     * 基本字段
     */
    var $phone;
    var $c_time;
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'assoc_movie_cinema';
    const __TBSCHEDULE = 'fc_assoc_schedule';

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

    /**
     * insert cinema_imgurl data
     */
    public function insertSchedule($data) {
        return $this->db->insert(self::__TBSCHEDULE, $data);
    }


    /**
     * get assoc movie&cinema list
     */
    public function _getAssocList() {
        $query = "SELECT id, movie_id, cinema_id FROM " . self::__TABLE;
        $qy = $this->db->query($query);
        return $qy->result();
    }

}
