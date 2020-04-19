<?php

class Explore_model extends CI_Model
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

    public function getPosts()
    {
        $this->db->select('*');
        $query = $this->db->get('explore');
        return $query->result_array();
    }

    public function setPost($post)
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
            if (!$this->db->insert('explore', array(
                        'title' => $post['title'],
                        'message' => $post['message'],
                        'abbr' => $post['lang'],
                        'credit_url' => $post['credit_url'],
                        'credit_image' => $post['image']['credit'][0]['file_name']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $id = $this->db->insert_id();

            //Insert Images
            foreach ($_POST['image']['explore'] as $key => $img) {
                $this->db->insert('explore_image',array(
                    'explore_id' => $id,
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


    public function getSingleExplore($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('explore');
        return $query->result_array();
    }

    public function deleteExplore($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('explore');
    }

    public function deleteExploreImage($id)
    {
        $this->db->where('explore_id', $id);
        return $this->db->delete('explore_image');
    }

    public function deleteExploreImageById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('explore_image');
    }

    public function deleteCreditImageById($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('explore', array('credit_image' => null));
    }

    public function getExploreDetails($lang = 'en')
    {
        $this->db->select('*');
        $this->db->where('abbr', $lang);
        $query = $this->db->get('explore');
        return $query->result_array();
    }

    public function getAllImages($id)
    {
        $this->db->select('*');
        $this->db->where('explore_id', $id);
        $query = $this->db->get('explore_image');
        return $query->result_array();
    }

}
