<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @database        first_cinema
 * @table           user
 **/

class Login_model extends CI_Model
{
    /**
     * 基本字段
     */
    var $email;
    var $pwd;
    var $c_time;
     
    //database  user 
    const __DATABASE= 'first_cinema';
    const __TABLE= 'fc_user';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * insert movie data
     */
    public function insertUserData()
    {
        return $this->db->insert(self::__TABLE, $this);
    }

    /**
     *
     * check email
     *
     */
    public function _checkEmail($email, $pwd = '') {
        $field = " COUNT(*) AS total ";
        $pwd && $field = " id ";
        $query = "SELECT $field FROM " . self::__TABLE . " WHERE email='" . $email . "'";
        $pwd && $query .= " AND pwd='" . $pwd . "'";
        $ret = $this->db->query($query);
        return $ret->result();
    }
}
