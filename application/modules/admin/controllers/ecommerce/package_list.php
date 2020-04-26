<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Package_list extends ADMIN_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Products_model', 'Languages_model', 'Package_model'));
    }

    public function index($page = 0)
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - View Packages';
        $head['description'] = '!';
        $head['keywords'] = '';

        if (isset($_GET['delete'])) {
            $this->Package_model->deletePackage($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'product is deleted!');
            $this->saveHistory('Delete package id - ' . $_GET['delete']);
            redirect('admin/package_list');
        }

        unset($_SESSION['filter']);
        $search_title = null;
        if ($this->input->get('search_title') !== NULL) {
            $search_title = $this->input->get('search_title');
            $_SESSION['filter']['search_title'] = $search_title;
            $this->saveHistory('Search for product title - ' . $search_title);
        }
        $orderby = null;
        if ($this->input->get('order_by') !== NULL) {
            $orderby = $this->input->get('order_by');
            $_SESSION['filter']['order_by '] = $orderby;
        }
        $package_type = null;
        if ($this->input->get('package_type') !== NULL) {
            $package_type = $this->input->get('package_type');
            $_SESSION['filter']['package_type '] = $package_type;
            $this->saveHistory('Search for package code - ' . $package_type);
        }
        $vendor = null;
        if ($this->input->get('show_vendor') !== NULL) {
            $vendor = $this->input->get('show_vendor');
        }
        $data['products_lang'] = $products_lang = $this->session->userdata('admin_lang_products');
        $rowscount = $this->Package_model->packagesCount($search_title, $package_type);
        $data['packages'] = $this->Package_model->getPackages($this->num_rows, $page, $search_title, $orderby, $package_type, $vendor);
        $data['links_pagination'] = pagination('admin/package_list', $rowscount, $this->num_rows, 3);
        $data['num_pack_art'] = $this->Package_model->numShopPackages();
        $data['languages'] = $this->Languages_model->getLanguages();
        $this->saveHistory('Go to products');
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/package_list', $data);
        $this->load->view('_parts/footer');
    }

    public function getProductInfo($id, $noLoginCheck = false)
    {
        /*
         * if method is called from public(template) page
         */
        if ($noLoginCheck == false) {
            $this->login_check();
        }
        return $this->Products_model->getOneProduct($id);
    }

    /*
     * called from ajax
     */

    public function productStatusChange()
    {
        $this->login_check();
        $result = $this->Products_model->productStatusChange($_POST['id'], $_POST['to_status']);
        if ($result == true) {
            echo 1;
        } else {
            echo 0;
        }
        $this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
    }

}
