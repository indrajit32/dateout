<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Package extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Products_model',
            'Package_model',
            'Languages_model',
            'Brands_model',
            'Categories_model'
        ));
    }

    public function index($id = 0)
    {
        $this->login_check();
        $is_update = false;
        $trans_load = null;
        if ($id > 0 && $_POST == null) {
            $_POST = $this->Package_model->getOnePackage($id);
            $trans_load = $this->Package_model->getTranslations($id);
        }

        if (isset($_POST['submit'])) {
            if (isset($_GET['to_lang'])) {
                $id = 0;
            }
            $this->Package_model->setPackage($_POST, $id);
            $this->session->set_flashdata('result_publish', 'Package is published!');
            if ($id == 0) {
                $this->saveHistory('Success published Package');
            } else {
                $this->saveHistory('Success updated Package');
            }
            if (isset($_SESSION['filter']) && $id > 0) {
                $get = '';
                foreach ($_SESSION['filter'] as $key => $value) {
                    $get .= trim($key) . '=' . trim($value) . '&';
                }
                redirect(base_url('admin/package?' . $get));
            } else {
                redirect('admin/package');
            }
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Package';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['id'] = $id;
        $data['multislot']= $this->loadMultiSlot($id);
        $_POST['slot_id_count']= $this->Package_model->getMultiSlotCount($id);
        $data['trans_load'] = $trans_load;
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['product_list'] = $this->Products_model->getProducts_vendor();
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/package', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to publish product');
    }

    private function uploadImage()
    {
        $config['upload_path'] = './attachments/shop_images/';
        $config['allowed_types'] = $this->allowed_img_types;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
        }
        $img = $this->upload->data();
        return $img['file_name'];
    }

    /*
     * called from ajax
     */

    public function do_upload_others_images()
    {
        if ($this->input->is_ajax_request()) {
            $upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
            if (!file_exists($upath)) {
                mkdir($upath, 0777);
            }

            $this->load->library('upload');

            $files = $_FILES;
            $cpt = count($_FILES['others']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                unset($_FILES);
                $_FILES['others']['name'] = $files['others']['name'][$i];
                $_FILES['others']['type'] = $files['others']['type'][$i];
                $_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
                $_FILES['others']['error'] = $files['others']['error'][$i];
                $_FILES['others']['size'] = $files['others']['size'][$i];

                $this->upload->initialize(array(
                    'upload_path' => $upath,
                    'allowed_types' => $this->allowed_img_types
                ));
                $this->upload->do_upload('others');
            }
        }
    }

    public function do_upload_expectations_images()
    {
        if ($this->input->is_ajax_request()) {
            $upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['expectation_folder'] . DIRECTORY_SEPARATOR;
            if (!file_exists($upath)) {
                mkdir($upath, 0777);
            }

            $this->load->library('upload');

            $files = $_FILES;
            $cpt = count($_FILES['expectations_image']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                unset($_FILES);
                $_FILES['expectations_image']['name'] = $files['expectations_image']['name'][$i];
                $_FILES['expectations_image']['type'] = $files['expectations_image']['type'][$i];
                $_FILES['expectations_image']['tmp_name'] = $files['expectations_image']['tmp_name'][$i];
                $_FILES['expectations_image']['error'] = $files['expectations_image']['error'][$i];
                $_FILES['expectations_image']['size'] = $files['expectations_image']['size'][$i];

                $this->upload->initialize(array(
                    'upload_path' => $upath,
                    'allowed_types' => $this->allowed_img_types
                ));
                $this->upload->do_upload('expectations_image');
            }
        }
    }

    public function loadOthersImages()
    {
        $output = '';
        if (isset($_POST['folder']) && $_POST['folder'] != null) {
            $dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $i = 0;
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file)) {
                            $output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url('attachments/shop_images/' . $_POST['folder'] . '/' . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
                        }
                        $i++;
                    }
                    closedir($dh);
                }
            }
        }
        if ($this->input->is_ajax_request()) {
            echo $output;
        } else {
            return $output;
        }
    }

    public function loadMultiSlot($id)
    {
        $output = '';
        $multislot = $this->Package_model->getMultiSlot($id);
        if (!empty($multislot)) {
          $count = 0;
        foreach($multislot as $slot){
          $count++;
          $output .= "
              <table id='table_".$count."' class='slot_class bordered-group'><tr><td>Time:</td><td><input type='text' class='form-control' name='slot_time[]' readonly value='".$slot->slot_time."'></td><td>Total Slot:</td><td><input type='text' class='form-control' name='total_slot[]' readonly value='".$slot->total_slot."'></td><td>Person per Slot:</td><td><input type='text' class='form-control' name='person_per_slot[]' readonly value='".$slot->person_per_slot."'></td><td><button onclick='removeslot(".$count.")'>X</button></td></tr></table>";
        }
       }
        if ($this->input->is_ajax_request()) {
            echo $output;
        } else {
            return $output;
        }
    }

    /*
     * called from ajax
     */

    public function removeSecondaryImage()
    {
        if ($this->input->is_ajax_request()) {
            $img = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . '' . $_POST['folder'] . DIRECTORY_SEPARATOR . $_POST['image'];
            unlink($img);
            return 1;
        }
    }

    public function removeSecondaryExpectationsImage()
    {
        if ($this->input->is_ajax_request()) {
            $img = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . '' . $_POST['folder'] . DIRECTORY_SEPARATOR . $_POST['image'];
            unlink($img);
        }
    }
}