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
        $this->load->model(array('Api_model', 'admin/Explore_model', 'admin/Config_model', 'ExperiencePackage_model','admin/Blog_model'));
        $this->allowed_img_types = $this->config->item('allowed_img_types');
    }

    public function all_get($lang = 'en')
    {
        $header_data = $this->Explore_model->getExploreDetails($lang);
        $data['explor_header'] = $header_data[0];
        $data['explor_header']['images'] = $this->Explore_model->getAllImages($data['explor_header']['id']);

        //==============================Article==============================
            $dataA = $this->Blog_model->getAllPosts($lang);

            foreach ($dataA as $key => $value) 
            {
                $dataA[$key]["article_url"] = base_url().'blog/showArticle/'.$value['id'];
            }
        //====================================================================

        //============================================================

        $config_data = $this->Config_model->getSiteConfigData($lang,'explore');
        foreach($config_data as $key => $c)
        {
            if($c['key_name'] == 'credit')
            {
                $dataC[0]['credit_url'] = $data['explor_header']['credit_url'];
                $dataC[0]['credit_image'] = $data['explor_header']['credit_image'];

                $config_data[$key]['group_list_data'] = $dataC;
            }
            elseif($c['key_name']=='top_experience')
            {
                $product = $this->ExperiencePackage_model->getTopProducts($limit = null, $start = null, $big_get= null, $vendor_id = false, $c['key_name']);
                //print_r($product);die;
                $config_data[$key]['group_list_data'] = $product;
                //['credit_url'=> $data['explor_header']['credit_url'], 'credit_image' => $data['explor_header']['credit_image']];
            }
            else if($c['key_name'] == 'article')
            {
                $config_data[$key]['group_list_data'] = $dataA;
            }
            else
            {
                $config_data[$key]['group_list_data'] = [];
            }
        }

        //================================================================

        $data['explor_list'] = $config_data;
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
