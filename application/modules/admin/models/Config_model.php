<?php

class Config_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getSiteConfigData( $abbr = 'en', $page = null )
    {
        $this->db->select('*');
        $this->db->where('abbr',$abbr);
        if($page != null){
            $this->db->where('type',$page);
        }
        $query = $this->db->get('config');
        return $query->result_array();
    }

    public function editSiteConfigData($data)
    {
        $arr['type'] = $data['type'];
        $arr['key_name'] = $data['key_name'];
        $arr['value'] = $data['value'];

        $this->db->where('id',$data['edit']);
        return $this->db->update('config',$arr);
    }

}
