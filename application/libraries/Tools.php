<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('IPLocation.class.php');
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
        if (!isset($_COOKIE['mycity'])) {
            if (getenv("HTTP_CLIENT_IP"))
                $ip = getenv("HTTP_CLIENT_IP");
            else if(getenv("HTTP_X_FORWARDED_FOR"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            else if(getenv("REMOTE_ADDR"))
                $ip = getenv("REMOTE_ADDR");
            else 
                $ip = '121.199.31.65';
        }
        $ip = '121.199.31.65';
        return $ip;
    }

    public function getLocalCity()
    {
        $ip = $this->getClientIP();
        $wry = new TQQwry();
        $wry->qqwry($ip);
        $cityName = iconv('gb2312', 'utf-8', $wry->Country);
        $cityName = $this->cn_substr_utf8($cityName, 2);
        $zhName = $this->filterPinyin($cityName, 1);
        return $zhName;
    }
    public function cn_substr_utf8($str, $length, $start=0)
    {
        $lgocl_str=$str;

        if(strlen($str) < $start+1)
        {
            return '';
        }
        preg_match_all("/./su", $str, $ar);
        $str = '';
        $tstr = '';
        for($i=0; isset($ar[0][$i]); $i++)
        {
            if(strlen($tstr) < $start)
            {
                $tstr .= $ar[0][$i];
            }
            else
            {
                if(strlen($str) < $length + strlen($ar[0][$i]) )
                {
                    $str .= $ar[0][$i];
                }
                else
                {
                    break;
                }
            }
        }
        if(strlen($lgocl_str)<=$length){
        }else{
            $str.="...";
        }
        return $str;
    }

    public function filterPinyin($str, $code='gb2312')
    {
        $dataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha"."|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|"."cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er"."|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui"."|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang"."|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang"."|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue"."|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne"."|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen"."|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang"."|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|"."she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|"."tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu"."|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you"."|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|"."zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
        $dataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990"."|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725"."|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263"."|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003"."|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697"."|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211"."|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922"."|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468"."|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664"."|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407"."|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959"."|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652"."|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369"."|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128"."|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914"."|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645"."|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149"."|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087"."|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658"."|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340"."|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888"."|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585"."|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847"."|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055"."|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780"."|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274"."|-10270|-10262|-10260|-10256|-10254";
        $tDataKey = explode('|', $dataKey);
        $tDataValue = explode('|', $dataValue);
        $dataInfo = (PHP_VERSION>='5.0') ? array_combine($tDataKey, $tDataValue) : $this->filterArrayCombine($tDataKey, $tDataValue);
        arsort($dataInfo);
        reset($dataInfo);
        if($code != 'gb2312') $str = $this->filterCodeType($str);
        $_Res = '';
        for($i=0; $i<strlen($str); $i++)
        {
            $_P = ord(substr($str, $i, 1));
            if($_P>160) { $_Q = ord(substr($str, ++$i, 1)); $_P = $_P*256 + $_Q - 65536; }
            $_Res .= $this->pinYin($_P, $dataInfo);
        }
        return preg_replace("/[^a-z0-9]*/", '', $_Res);
    }
    public function pinYin($_Num, $dataInfo)
    {
        if ($_Num>0 && $_Num<160 ) return chr($_Num);
        elseif($_Num<-20319 && $_num="">-10247) return '';
        else {
            foreach($dataInfo as $k=>$v){ if($v<=$_Num) break; }
                return $k;
        }
    }
    public function filterCodeType($_C)
    {
        $str = '';
        if($_C < 0x80) $str .= $_C;
        elseif($_C < 0x800)
        {
            $str .= chr(0xC0 | $_C>>6);
            $str .= chr(0x80 | $_C & 0x3F);
        }elseif($_C < 0x10000){
            $str .= chr(0xE0 | $_C>>12);
            $str .= chr(0x80 | $_C>>6 & 0x3F);
            $str .= chr(0x80 | $_C & 0x3F);
        } elseif($_C < 0x200000) {
            $str .= chr(0xF0 | $_C>>18);
            $str .= chr(0x80 | $_C>>12 & 0x3F);
            $str .= chr(0x80 | $_C>>6 & 0x3F);
            $str .= chr(0x80 | $_C & 0x3F);
        }
        return iconv('UTF-8', 'GB2312', $str);
    }

    function filterArrayCombine($_Arr1, $_Arr2)
    {
        for($i=0; $i<count($_Arr1); $i++) $_Res[$_Arr1[$i]] = $_Arr2[$i];
        return $_Res;
    }

}
