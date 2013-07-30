<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tools {

	public function __construct()
	{
		//TODO
	}

	/**
	 * filter gt string set ...
	 */
    public function _filterString($data, $num)
	{
		if (strlen($data) > $num) {
			$data = substr($data, 0, $num) . "...";
		}
		return $data;
	}

	/**
	 * filter cast chinese name
	 */
    public function _filterCast($data, $num = null)
	{
		$castArr = explode(",", $data);
		foreach ($castArr as $key => $name) {
			$tmpArr = explode(" ", $name);
			$castArr[$key] = $tmpArr[0];
		}

		if (!empty($num)) {
			$castArr = array_slice($castArr, 0, $num);
		}
		$castArr = implode(",", $castArr);
		return $castArr;
	}

    public function getClientIP()
    {
        global $ip;
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "Unknow";
        return $ip;
    }
    
}
