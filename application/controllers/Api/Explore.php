<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Explore extends REST_Controller
{

    private $allowed_img_types;

    function __construct()
    {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

        parent::__construct();
        $this->methods['get_details']['limit'] = 500; // 500 requests per hour per user/key
        $this->load->model(array('Api_model', 'admin/Explore_model', 'admin/Config_model'));
        $this->allowed_img_types = $this->config->item('allowed_img_types');
    }

    public function all_get($lang = 'en')
    {
        $data['explore'] = $this->Explore_model->getExploreDetails($lang);
        $data['explore']['images'] = $this->Explore_model->getAllImages($data['explore'][0]['id']);
        $data['explore']['config'] = $this->Config_model->getSiteConfigData($lang,'explore');

        $data['explore']['experience'] = [];

        $this->response($data, REST_Controller::HTTP_OK);
    }

}
