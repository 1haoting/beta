<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * Maps to the following URL
 * http://example.com/schedule
 *
 * @author Leo (Cheow Tong) $
 *
 */
class Schedule extends CI_Controller {

    private $assocArray;
    private $scheduleurl = 'http://movie.douban.com/j/schedules?';
    private $param = array('date'=>'', 's_id'=>0, 'site_id'=>0);
    private $paramArray = array();
    private $paramString;
    private $type;
    private $language;

    /*
     * 构造器
     */
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('PRC');
        $this->load->model('schedule_model');
        $this->config->load("assoc");
        $this->type = $this->config->item("typeConfig");
        $this->language = $this->config->item("language");
    }

    public function index()
    {        
        $this->index = 0;
        $this->_getAssoInfo();
        $this->_getScheduleData();
    }

    /**
     * 获取排期数据
     */
    private function _getScheduleData() {
        if($this->assocArray) {
            foreach($this->assocArray as $v) {
                if($this->index < 90) {
                    $nowtime = strtotime("now");
                    $nexttime = strtotime("+1days");
                    $param['date'] = date("Y-m-d",$nowtime);
                    $param['s_id'] = $v->movie_id;
                    $param['site_id'] = $v->cinema_id;
                    $schedulepath = $this->_joinPath($param);
                    $scheduleJsonString = file_get_contents($schedulepath);
                    $scheduleJson = json_decode($scheduleJsonString);
                    !empty($scheduleJson) && $this->_insertSchedule($scheduleJson, $v->id);
                    $param['date'] = date("Y-m-d", $nexttime);
                    $schedulepath = $this->_joinPath($param);
                    $scheduleJsonString = file_get_contents($schedulepath);
                    $nextscheduleJson = json_decode($scheduleJsonString);
                    !empty($scheduleJson) && $this->_insertSchedule($scheduleJson, $v->id, 2);
                } else {
                    sleep(60);
                    $this->index = 0;
                }
            }
        }
    }

    /**
     * 入库排期表
     */
    private function _insertSchedule($object, $id, $day = 1) {
        foreach($object as $v) {
            $scheduleArray = array();
            $scheduleArray['assoc_id'] = $id;
            $version = array_search($v->version, $this->type);
            $scheduleArray['type_id'] = $version;
            $language = array_search($v->language, $this->language);
            $scheduleArray['language_id'] = $language;
            $scheduleArray['price'] = $v->price;
            $scheduleArray['s_time'] = $v->time;
            $scheduleArray['day'] = $day;
            $scheduleArray['week_day'] = $v->week_day;
            $scheduleArray['c_time'] = time();
            $this->schedule_model->insertSchedule($scheduleArray);
        }
    }

    /**
     * 拼接访问路径
     */
    private function _joinPath($param) {
        $this->paramArray = array();
        foreach($param as $key=>$val) {
            array_push($this->paramArray, $key . "=" . $val);
        }
        $this->paramString = implode("&", $this->paramArray);
        $schedulepath = $this->scheduleurl . $this->paramString;
        return $schedulepath;
    }

    /**
     * 获取关系表数据
     */
    private function _getAssoInfo()
    {
        $this->assocArray = $this->schedule_model->_getAssocList();
    }
}
