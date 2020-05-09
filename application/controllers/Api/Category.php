<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Category extends REST_Controller
{

    private $allowed_img_types;

    function __construct()
    {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

        parent::__construct();
        $this->methods['all_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->load->model(array('Api_model','admin/Categories_model'));
        $this->allowed_img_types = $this->config->item('allowed_img_types');
    }

    public function all_get($lang = 'en')
    {
        $data = $this->Categories_model->getAllCategory($lang);
        foreach($data as $key=>$row)
        {
            $data[$key]['total_experiences'] = $this->Categories_model->getProductCountByCategory($row['category_id']);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
