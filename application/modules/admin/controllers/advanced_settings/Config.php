<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Config extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Config_model','Languages_model'));
    }

    public function index($abbr = 'en')
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Site Config';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['data'] = $this->Config_model->getSiteConfigData($abbr);
        $data['lang'] = $abbr;

        $data['languages'] = $this->Languages_model->getLanguages();

        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/config', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
    }

    public function edit()
    {
        if($this->Config_model->editSiteConfigData($_POST)){
             redirect('admin/advanced_settings/config/index');
        }
    }

}
