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
    const __TBCITY = 'fc_city_list';
    const __TBASSOC = 'assoc_movie_cinema';
    const __TBSCHEDULE = 'fc_assoc_schedule';
    const __TBCINEMA = 'fc_cinema_list';

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

    /**
     * get movie list by city id
     */
    public function getMovieDetailByCityId()
    {
        $where_data = array(
            'city_id' => $this->city_id,
        );
        $query = $this->db->get_where(self::__TABLE, $where_data);
        $result = $query->result();
        return $result;
    }

    /**
     * get movie list by city id order by rating
     */
    public function getTopMovieByCityId()
    {
        $where_data = array(
            'city_id' => $this->city_id,
        );
        $this->db->select('d_id, rating, title, alt_title, director, cast');
        $this->db->order_by("rating", "desc");
        $query = $this->db->get_where(self::__TABLE, $where_data, 10);
        $result = $query->result();
        return $result;
    }

    /**
     * get distinct d_id 
     */
    public function getOnlyMovieDid()
    {
        $sql = "SELECT distinct d_id FROM " . self::__TABLE;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * get area for city id 
     */
    public function getAreaForCityId($cityid)
    {
        $sql = "SELECT id, name FROM " . self::__TBCITY . " WHERE 
                    parent_id=( SELECT id FROM " . self::__TBCITY . "
                        WHERE d_c_id=" . $cityid . ")";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * get cinema movie paiqi
     */
    public function getMoviePq($obj, $type = false)
    {
        $typeWhere = " tbsc.day=1 AND assoc.movie_id=" . $obj->movieId;
        !$type && !$obj->areaId && $typeWhere .= " AND assoc.cinema_id in (
                SELECT d_m_number FROM " . self::__TBCINEMA . " WHERE city_id=" . $obj->cityId . ")";
        !$type && $obj->areaId && $typeWhere .= " AND cinema.area_id=" . $obj->areaId;
        ($obj->dayId == 2) && $typeWhere .= " AND tbsc.day=" . $obj->dayId;
        $obj->languageId && $typeWhere .= " AND tbsc.language_id=" . $obj->languageId;
        $obj->typeId && $typeWhere .= " AND tbsc.type_id=" . $obj->typeId;
        $join = " LEFT JOIN " . self::__TBCINEMA. " cinema ON assoc.cinema_id = cinema.d_m_number ";
        $field = ", cinema.c_name, cinema.c_address, cinema.c_phone, cinema.c_http, cinema.c_imgurl ";
        $type && $typeWhere = "cinema_id=" . $obj->id;
        $type && $join = " LEFT JOIN " . self::__TABLE. " movie ON assoc.movie_id = movie.d_id ";
        $type && $field = ", cinema.c_name, cinema.c_address, cinema.c_phone, cinema.c_http ";
        $sql = "SELECT assoc.movie_id, assoc.cinema_id, tbsc.type_id, tbsc.language_id, 
                        tbsc.price, tbsc.s_time, tbsc.day, tbsc.week_day" . $field . " FROM " . self::__TBSCHEDULE . " tbsc 
                            LEFT JOIN " . self::__TBASSOC . " assoc ON tbsc.assoc_id = assoc.id " . $join . " 
                                WHERE " . $typeWhere . " ORDER BY assoc.cinema_id DESC";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
}
