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

        $data['explor_header'] = $this->Explore_model->getExploreDetails($lang);
        $data['explor_header']['images'] = $this->Explore_model->getAllImages($data['explor_header'][0]['id']);

        //============================================================
        
        $config_data = $this->Config_model->getSiteConfigData($lang,'explore');
        foreach($config_data as $key => $c)
        {
            if($c['key_name'] == 'credit')
            {
                $config_data[$key]['group_list_data'] = ['credit_url'=> $data['explor_header'][0]['credit_url'], 'credit_image' => $data['explor_header'][0]['credit_image']];
            }
            else
            {
                $config_data[$key]['group_list_data'] = [];
            }
        }
        
        //================================================================

        $data['explor_list'] = $config_data;

        $data['explor_list']['experience'] = [];
        $data['explor_list']['article'] = [];
        $data['explor_list']['popular_destination'] = [];

        $this->response($data, REST_Controller::HTTP_OK);
    }

}
