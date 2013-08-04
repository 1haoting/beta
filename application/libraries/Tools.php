<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tools {

	public function __construct()
	{
		//TODO
	}

	/**
	 * filter gt string set ...
     *
     * @param string $data
     * @param int    $num
     *
     * return string
	 */
    public function filterString($data, $num)
	{
		if (strlen($data) > $num) {
			$data = substr($data, 0, $num) . "...";
		}
		return $data;
	}

	/**
	 * filter cast chinese name
     *
     * @param string $data
     * @param int    $num
     * 
     * return string
	 */
    public function filterCast($data, $num = null)
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

    /**
     * filter movie type
     *
     * @param string $data 
     * @param string $needStr
     *
     * return string
     */
    public function filterMovieType($data, $needStr, $returnNum = 1)
    {
        if (strstr($data, $needStr)) {
            $typeArr = explode($needStr, $data);
            return $typeArr[$returnNum];
        }
        return $data;
    }

    /**
     * filter movie name
     *
     * @param array $data
     *
     * return string
     */
    public function filterMovieName($data)
    {
        if ($this->checkStrChinese($data->alt_title)) {
            return $this->filterMovieType($data->alt_title, '/', 0);
        } else {
            return $this->filterMovieType($data->title, '/', 0);
        }
    }

    /**
     * check is chinese
     *
     * @param string $str
     *
     * return bool
     */
    public function checkStrChinese($str)
    {
        if (preg_match("/[\x7f-\xff]/", $str)) { 
            return true;
        } else { 
            return false;
        } 
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
