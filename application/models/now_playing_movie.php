<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_now_playing_movie
 **/

class Now_playing_movie extends CI_Model
{
    
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_now_playing_movie';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $d_id 豆瓣ID
     */
    public function isExistMovie($movie_id)
    {
        $sql = "SELECT id FROM " . self::__TABLE . " WHERE d_id = " . $movie_id;
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if(count($row))
        {
            return true;
        }
        return false;
    }


}
