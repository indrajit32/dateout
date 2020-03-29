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
            redirect('admin/blogposts');
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
        $data['links_pagination'] = pagination('review/blogposts', $rowscount, $this->num_rows, 3);
        $data['page'] = $page;

        $this->load->view('_parts/header', $head);
        $this->load->view('review/blogposts', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Review');
    }

    public function view_all_review_by_product($product_id)
    {
        

        $data = array();
        $head = array();
        $head['title'] = 'Administration - Review Posts By Product';
        $head['description'] = '!';
        $head['keywords'] = '';

        $rowscount = $this->Review_model->reviewCountByProduct($product_id);
        $data['links_pagination'] = pagination('review/reviewpostbyproduct', $rowscount, $this->num_rows, 3);
        //$data['page'] = $page;

        $data['reviews'] = $this->Review_model->get_all_review_by_product($product_id);

        $this->load->view('_parts/header', $head);
        $this->load->view('review/reviewpostbyproduct', $data);
        $this->load->view('_parts/footer');
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
            $update = array(
            'title' => $this->input->post('title'),
            'comment' => $this->input->post('comment'),
            'rating' => $this->input->post('rating')
            );
            $this->db->set($update);
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('product_reviews');

            redirect('admin/review/review/edit/'.$this->input->post('id'));
        }

        $data['review'] = $this->Review_model->getSingleReview($id);

        $this->load->view('_parts/header', $head);
        $this->load->view('review/editreview', $data);
        $this->load->view('_parts/footer');
    }

    public function delete($id)
    {
        $this->Review_model->deleteReview($id);
        redirect('admin/reviews');
    }

}
