<?php

class Review_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deletePost($id)
    {
        $this->db->trans_begin();
        $this->db->where('id', $id)->delete('blog_posts');
        $this->db->where('for_id', $id)->delete('blog_translations');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function postsCount($search = null)
    {
        if ($search !== null) {
            $this->db->like('blog_translations.title', $search);
        }
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('blog_posts');
    }

    public function getPosts($lang = null, $limit, $page, $search = null, $month = null)
    {
        if ($search !== null) {
            $search = $this->db->escape_like_str($search);
            $this->db->where("(blog_translations.title LIKE '%$search%' OR blog_translations.description LIKE '%$search%')");
        }
        if ($month !== null) {
            $from = $month['from'];
            $to = $month['to'];
            $this->db->where("time BETWEEN $from AND $to");
        }
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        if ($lang == null) {
            $this->db->where('blog_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        } else {
            $this->db->where('blog_translations.abbr', $lang);
        }
        $query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts', $limit, $page);
        return $query->result_array();
    }

    public function setPost($post, $id)
    {
        $this->db->trans_begin();
            /*
             * Lets get what is default tranlsation number
             * in titles and convert it to url
             * We want our plaform public ulrs to be in default 
             * language that we use
             */
            $i = 0;
            //echo '<pre>'; print_r($_POST); die;
            if (!$this->db->insert('product_reviews', array(
                        'customer_id' => $post['user_id'],
                        'product_id' => $post['product_id'],
                        'rating' => $post['rating'],
                        'title' => $post['title'],
                        'comment' => $post['comment'],
                        'created_at' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $id = $this->db->insert_id();

            //Insert Images
            foreach ($_POST['image'] as $key => $img) {
                $this->db->insert('product_review_images',array(
                    'product_review_id' => $id,
                    'image' => $img['file_name']
                ));
            }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function setBlogTranslations($post, $id, $is_update)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id);
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'description' => $post['description'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );
            if ($is_update === true && $emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr'], $arr['url']);
                if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('blog_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                if (!$this->db->insert('blog_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
        }
    }

    public function getOnePost($id)
    {
        $query = $this->db->where('id', $id)->get('blog_posts');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('blog_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['title'] = $row->title;
            $arr[$row->abbr]['description'] = $row->description;
        }
        return $arr;
    }

}
