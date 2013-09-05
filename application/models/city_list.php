<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           fc_city_list
 **/

class City_List extends CI_Model
{
    /**
     * 基本字段
     */
    var  $id = ''; 
    var  $zh_name = ''; 
    var  $name = ''; 
    var  $d_c_id = ''; 
    var  $parent_id = ''; 
     
    //database  first_cinema 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_city_list';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert movie data
     */
    public function insertCityData()
    {
        $this->db->insert(self::__TABLE, $this);
    }

    /**
     * get city info 
     */
    public function selectCityInfoByField()
    {
        $this->db->select($this->field_str);
        $query = $this->db->get(self::__TABLE);
        $data = $query->result();

        if(empty($data))
        {
            return false;
        }
        return $data;
    }

    /**
     * get city info by zh name
     */
    public function selectCityInfoByZhName()
    {
        $this->db->where('zh_name', $this->zh_name); 
        $query = $this->db->get(self::__TABLE);
        $data = $query->result();

        if(empty($data))
        {
            return false;
        }
        return $data;
    }

    /**
     * get city info by zh name
     */
    public function selectCityInfo($begin = '', $end = '')
    {
        $where = '';
        $begin && $end && $where = " WHERE LEFT(zh_name, 1) BETWEEN '" . $begin . "' AND '" . $end . "'";
        $sql = "SELECT name, d_c_id FROM " . self::__TABLE . $where;
        $ret = $this->db->query($sql);
        return $ret->result();
    }

    /**
     * get city and area info by zh name
     */
    public function selectAreaInfoByParentId()
    {
        $this->db->where('parent_id', $this->parent_id); 
        $this->db->order_by('id', 'asc'); 
        $query = $this->db->get(self::__TABLE);
        $data = $query->result();

        if(empty($data))
        {
            return false;
        }
        return $data;
    }

    /**
     * get city and area info by zh name
     */
    public function selectInfoByDid()
    {
        $this->db->where('d_c_id', $this->d_c_id); 
        $this->db->order_by('id', 'asc'); 
        $query = $this->db->get(self::__TABLE);
        $data = $query->result();

        if(empty($data))
        {
            return false;
        }
        return $data;
    }
}
