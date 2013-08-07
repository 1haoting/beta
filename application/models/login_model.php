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
    var $email, $pwd, $c_time;
     
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
    public function _checkEmail($email) {
        $query = "SELECT COUNT(*) AS total FROM " . self::__TABLE . " WHERE email='" . $email . "'";
        $ret = $this->db->query($query);
        return $ret->result();
    }
}
