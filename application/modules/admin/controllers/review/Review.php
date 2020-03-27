<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Review extends ADMIN_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Review_model');
    }

    public function index($page = 0)
    {
        $this->login_check();
        if (isset($_GET['delete'])) {
            $this->Review_model->deletePost($_GET['delete']);
            redirect('admin/blog');
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Review Posts';
        $head['description'] = '!';
        $head['keywords'] = '';


        if ($this->input->get('search') !== NULL) {
            $search = $this->input->get('search');
        } else {
            $search = null;
        }
        $data = array();
        $rowscount = $this->Review_model->postsCount($search);
        $data['posts'] = $this->Review_model->getPosts(null, $this->num_rows, $page, $search);
        $data['links_pagination'] = pagination('review/blog', $rowscount, $this->num_rows, 3);
        $data['page'] = $page;

        $this->load->view('_parts/header', $head);
        $this->load->view('review/blogposts', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Review');
    }

}
