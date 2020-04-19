<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Explore extends ADMIN_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Explore_model');

        $this->load->helper('common');
    }

    public function index($page = 0)
    {
        $this->login_check();
        if (isset($_GET['delete'])) {
            $this->Explore_model->deletePost($_GET['delete']);
            redirect('admin/blogposts');
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Explore';
        $head['description'] = '!';
        $head['keywords'] = '';


        $data = array();
        $data['explore'] = $this->Explore_model->getPosts();

        $this->load->view('_parts/header', $head);
        $this->load->view('explore/explore', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Review');
    }



    public function edit($id)   
    {
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Review Edit';
        $head['description'] = '!';
        $head['keywords'] = '';


        if(count($_POST) > 0 && isset($_POST))
        {
            //echo "<pre>"; print_r($_POST); die;
            $update = array(
            'title' => $this->input->post('title'),
            'message' => $this->input->post('message'),
            'credit_url' => $this->input->post('credit_url')
            );
            $this->db->set($update);
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('explore');

            if(isset($_FILES['explore']))
            {
                $_POST['image'] = $this->uploadImage();

                //Insert Images
                foreach ($_POST['image'] as $key => $img) {

                    if($img['file_name'] != null){
                        $this->db->insert('explore_image',array(
                            'explore_id' => $this->input->post('id'),
                            'image' => $img['file_name']
                        ));
                    }
                }
            }

            if(isset($_FILES['credit']))
            {
                //die($this->input->post('id'));
                $_POST['credit_img'] = $this->uploadCreditImage();
                //Insert Images
                foreach ($_POST['credit_img'] as $key => $img) {
                    if($img['file_name'] != null){
                        $this->db->where('id', $this->input->post('id'));
                        $this->db->update('explore', array('credit_image' => $img['file_name']));
                    }
                }
            }

            redirect('admin/explore/explore/');
        }

        $data['explore'] = $this->Explore_model->getSingleExplore($id);

        $this->load->view('_parts/header', $head);
        $this->load->view('explore/editexplore', $data);
        $this->load->view('_parts/footer');
    }

    public function delete($id)
    {
        $this->Explore_model->deleteExplore($id);
        $this->Explore_model->deleteExploreImage($id);
        redirect('admin/explore/explore');
    }

    public function deleteImages()
    {
        $u_path = 'attachments/explore_images/';
        unlink($u_path.$this->input->post('image'));
        echo $this->Explore_model->deleteExploreImageById($this->input->post('img_id'));
        die;
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
                $dataInfo[] = $this->upload->data();
            }

            return $dataInfo;
    }

    private function uploadCreditImage()
    {
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['credit']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['credit']['name']= $files['credit']['name'][$i];
                $_FILES['credit']['type']= $files['credit']['type'][$i];
                $_FILES['credit']['tmp_name']= $files['credit']['tmp_name'][$i];
                $_FILES['credit']['error']= $files['credit']['error'][$i];
                $_FILES['credit']['size']= $files['credit']['size'][$i];    

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('credit');
                $dataInfo[] = $this->upload->data();
            }

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

    public function deleteCreditImages(){

        $u_path = 'attachments/explore_images/';
        unlink($u_path.$this->input->post('image'));
        echo $this->Explore_model->deleteCreditImageById($this->input->post('img_id'));
        die;
    }

}
