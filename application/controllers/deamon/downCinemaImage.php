<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

/**
 * Maps to the following URL
 * http://example.com/downCinemaImage
 *
 * @author Leo (Cheow Tong) $
 *
 */
class downCinemaImage extends CI_Controller {

    private $imgArray;

    /*
     * 构造器
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('cinema_model');
    }

    public function index()
    {        
        $this->nums = 10;
        $this->_getCinemaImgInfo();
        $this->_downCinemaImage();
    }

    private function _getCinemaImgInfo()
    {
        $this->imgArray = $this->cinema_model->_getCinemaImgUrl();
    }


    /**
     * download cinema intro image 
     **/
    private function _downCinemaImage()
    {
        foreach ($this->imgArray as $img) {
            if($this->nums > 0) {
                $fileName = $img->d_m_number . '_' . $img->c_index . '.jpg';
                $this->getImage($img->c_imgurl, $fileName);
                $this->nums--;
            } else {
                sleep(61);
                $this->nums = 10;
            }
        }
    }

    /**
     * get movie image pull local path
     * 
     * @param string $imageUrl 
     * @param string $fileName
     */
    private function getImage($imageUrl, $fileName)
    {
        $curl = curl_init($imageUrl);
        $filepath = '../images/cinema/';
        $fileName = BASEPATH . $filepath . $fileName;
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $imageData = curl_exec($curl);
        curl_close($curl);
        $tp = @fopen($fileName, 'a');
        fwrite($tp, $imageData);
        fclose($tp);
    }



}
