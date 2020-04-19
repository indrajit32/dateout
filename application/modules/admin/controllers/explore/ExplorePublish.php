<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ExplorePublish extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Explore_model', 'Languages_model'));
        $this->load->helper('common');
    }

    public function index($abbr = 'en')
    {
        $this->login_check();
        $trans_load = null;
        if (isset($_POST['submit'])) {
            $_POST['image'] = $this->uploadImage();
            $this->Explore_model->setPost($_POST);
            $this->session->set_flashdata('result_publish', 'Successful published!');
            //redirect('admin/reviewpublish');
        }
        $data = array();
        $head = array();
        //$data['id'] = $id;
        $head['title'] = 'Administration - Publish Explore';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['trans_load'] = $trans_load;
        $data['lang'] = $abbr;
        $this->load->view('_parts/header', $head);
        $this->load->view('explore/explorepublish', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Explore Publish');
    }

    private function uploadImage()
    {
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            $cpt = count($_FILES['explore']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['explore']['name']= $files['explore']['name'][$i];
                $_FILES['explore']['type']= $files['explore']['type'][$i];
                $_FILES['explore']['tmp_name']= $files['explore']['tmp_name'][$i];
                $_FILES['explore']['error']= $files['explore']['error'][$i];
                $_FILES['explore']['size']= $files['explore']['size'][$i];  

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('explore');
                $dataInfo['explore'][] = $this->upload->data();
            } 

                $_FILES['credit']['name']= $files['credit']['name'];
                $_FILES['credit']['type']= $files['credit']['type'];
                $_FILES['credit']['tmp_name']= $files['credit']['tmp_name'];
                $_FILES['credit']['error']= $files['credit']['error'];
                $_FILES['credit']['size']= $files['credit']['size'];  

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('credit');
                $dataInfo['credit'][] = $this->upload->data();

            return $dataInfo;
    }

    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'explore_images' . DIRECTORY_SEPARATOR;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }


}
