<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           assoc_movie_cinema
 **/

class Assoc_movie_cinema extends CI_Model
{
    /**
     * 基本字段
     */
    var  $id; 
    var  $movie_id; 
    var  $cinema_id; 
    var  $type_id; 
    var  $language_id; 
    var  $price; 
    var  $today; 
    var  $tomorrow; 
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'assoc_movie_cinema';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert movie data
     */
    public function insertAssocInfo()
    {
        $this->db->insert(self::__TABLE, $this);
    }
}
