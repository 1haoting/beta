<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_now_playing_movie
 **/

class Now_playing_movie extends CI_Model
{
    /**
     * 基本字段
     */
    var  $id = ''; 
    var  $d_id = ''; 
    var  $author = ''; 
    var  $alt_title = ''; 
    var  $rating = ''; 
    var  $title = ''; 
    var  $summary = ''; 
    var  $pubdate = ''; 
    var  $language = ''; 
    var  $website = ''; 
    var  $country = ''; 
    var  $writer = ''; 
    var  $director = ''; 
    var  $cast = ''; 
    var  $movie_duration = ''; 
    var  $year = ''; 
    var  $movie_type = ''; 
    var  $tags = ''; 
    var  $city_id = ''; 
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_now_playing_movie';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * check d_id is exist
     */
    public function isExistMovie()
    {
        $where_data = array(
            'd_id' => $this->d_id,
            'city_id' => $this->city_id,
        );
        $query = $this->db->get_where(self::__TABLE, $where_data, 1);
        $result = $query->result();
        if(count($result))
        {
            return true;
        }
        return false;
    }

    /**
     * update create time
     */
    public function updateCreateTime()
    {
        $data = array(
            'create_time' => 'CURRENT_TIMESTAMP',
        );
        $where_data = array(
            'd_id' => $this->d_id,
        );
        $this->db->update(self::__TABLE, $data, $where_data);
        
    }

    /**
     * insert movie data
     */
    public function insertMovieData()
    {
        $this->db->insert(self::__TABLE, $this);
        
    }

    /**
     * get movie detail by movie id 
     */
    public function getMovieDetailByMovieId()
    {
        $where_data = array(
            'd_id' => $this->d_id,
            'city_id' => $this->city_id,
        );
        $query = $this->db->get_where(self::__TABLE, $where_data, 1);
        $result = $query->result();
        return $result;
    }
}
