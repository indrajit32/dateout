<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ReviewPublish extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Review_model', 'Languages_model'));
    }

    public function index($id = 0)
    {
        $this->login_check();
        $trans_load = null;
        if ($id > 0 && $_POST == null) {
            $_POST = $this->Blog_model->getOnePost($id);
            $trans_load = $this->Blog_model->getTranslations($id);
        }
        if (isset($_POST['submit'])) {
            $_POST['image'] = $this->uploadImage();
            $this->Review_model->setPost($_POST, $id);
            $this->session->set_flashdata('result_publish', 'Successful published!');
            redirect('admin/reviewpublish');
        }
        $data = array();
        $head = array();
        $data['id'] = $id;
        $head['title'] = 'Administration - Publish Review';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['trans_load'] = $trans_load;
        $this->load->view('_parts/header', $head);
        $this->load->view('review/blogpublish', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Review Publish');
    }

    private function uploadImage()
    {
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
                $dataInfo[] = $this->upload->data();
            }

            return $dataInfo;
    }

    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'review_images' . DIRECTORY_SEPARATOR;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }

}
