<?php

class Package_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deletePackage($id)
    {
        $this->db->trans_begin();
        $this->db->where('for_id', $id);
        if (!$this->db->delete('packages_translations')) {
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->where('id', $id);
        if (!$this->db->delete('packages')) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function packagesCount($search_title = null, $package_type = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
            $this->db->join('products_translations', 'products_translations.for_id = packages.experience_id', 'right');
            $this->db->where("(products_translations.title LIKE '%$search_title%')");
        }
        if ($package_type != null) {
            $this->db->where('package_available_type', $package_type);
        }

        $this->db->join('packages_translations', 'packages_translations.for_id = packages.id', 'left');
        $this->db->where('packages_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('packages');
    }

    public function getPackages($limit, $page, $search_title = null, $orderby = null, $package_type = null, $vendor = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
           $this->db->where("(products_translations.title LIKE '%$search_title%')");
        }
        if ($orderby !== null) {
            $ord = explode('=', $orderby);
            if(isset($ord[0]) && $ord[0]=='price_adult'){
              $this->db->order_by('packages_translations.' . $ord[0], $ord[1]);
            }
            else if (isset($ord[0]) && isset($ord[1])) {
                $this->db->order_by('packages.' . $ord[0], $ord[1]);
            }
        } else {
        //    $this->db->order_by('products.position', 'asc');
        }
        if ($package_type != null) {
            $this->db->where('package_available_type', $package_type);
        }
        if ($vendor != null) {
            $this->db->where('vendor_id', $vendor);
        }
        $this->db->join('products', 'products.id = packages.experience_id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = packages.experience_id', 'left');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->join('packages_translations', 'packages_translations.for_id = packages.id', 'left');
        $this->db->where('packages_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $query = $this->db->select('packages.*, vendors.id as vendor_id, vendors.name as vendor_name, products_translations.title, packages_translations.name, packages_translations.description, packages_translations.price_adult, packages_translations.price_child, packages_translations.abbr, packages_translations.for_id')->get('packages', $limit, $page);
        return $query->result();
    }

    public function numShopPackages()
    {
        return $this->db->count_all_results('packages');
    }

    public function getOnePackage($id)
    {
        $this->db->select('packages.*, packages_translations.*');
        $this->db->where('packages.id', $id);
        $this->db->join('packages_translations', 'packages_translations.for_id = packages.id', 'inner');
        $this->db->where('packages_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $query = $this->db->get('packages');
        if ($query->num_rows() > 0) {
          $arr = $query->row_array();
            return $arr;
        } else {
            return false;
        }
    }

    public function productStatusChange($id, $to_status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('products', array('visibility' => $to_status));
        return $result;
    }

    public function setPackage($post, $id = 0)
    {
        $this->db->trans_begin();
        $is_update = false;
        if ($id > 0) {
            $is_update = true;
            if(isset($post['slot_time'])){
              $this->db->where('package_id', $id);
              if (!$this->db->delete('package_slot')) {
                  log_message('error', print_r($this->db->error(), true));
              }
              else{
                for($i=0; $i < $post['slot_id_count']; $i++){
                  if (!$this->db->insert('package_slot', array(
                  'package_id' => $id,
                  'slot_time' => $post['slot_time'][$i],
                  'total_slot' => $post['total_slot'][$i],
                  'person_per_slot'=> $post['person_per_slot'][$i]
                ))){
                      log_message('error', print_r($this->db->error(), true));
                   }
                }
              }
            }

            if (!$this->db->where('id', $id)->update('packages', array(
                        'experience_id' => $post['experience_id'],
                  //      'credit_point_for_review' => $post['credit_point_for_review'],
                    //    'credit_point_for_booking' => $post['credit_point_for_booking'],
                    //    'deduct_max_points_on_booking' => $post['deduct_max_points_on_booking'],
                        'number_of_booking_available' => $post['number_of_booking_available'],
                  //      'is_point_on_booking' => $post['is_point_on_booking'],
                        'cancellation_policy' => $post['cancellation_policy'],
                        'how_to_redeem_offer' => $post['how_to_redeem_offer'],
                        'duration' => $post['duration'],
                        'confirmation' => $post['confirmation'],
                        'ticket_type' => $post['ticket_type'],
                        'meeting_place' => $post['meeting_place'],
                        'experience_type' => $post['experience_type'],
                        'ticket_collection' => $post['ticket_collection'],
                        'discount_available' => $post['discount_available'],
                        'package_available_type' => $post['package_available_type'],
                        'specific_day' => $post['specific_day'],
                        'available_date' => $post['available_date'],
                  //      'slot_time' => $post['slot_time'],
                  //      'total_slot' => $post['total_slot'],
                //        'person_per_slot' => $post['person_per_slot'],
                        'time_update' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
        } else {
            /*
             * Lets get what is default tranlsation number
             * in titles and convert it to url
             * We want our plaform public ulrs to be in default
             * language that we use
             */
            $i = 0;
            foreach ($_POST['translations'] as $translation) {
                if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
                    $myTranslationNum = $i;
                }
                $i++;
            }

            if (!$this->db->insert('packages', array(
                        'experience_id' => $post['experience_id'],
                //        'credit_point_for_review' => $post['credit_point_for_review'],
              //          'credit_point_for_booking' => $post['credit_point_for_booking'],
              //          'deduct_max_points_on_booking' => $post['deduct_max_points_on_booking'],
                        'number_of_booking_available' => $post['number_of_booking_available'],
              //          'is_point_on_booking' => $post['is_point_on_booking'],
                        'cancellation_policy' => $post['cancellation_policy'],
                        'how_to_redeem_offer' => $post['how_to_redeem_offer'],
                        'duration' => $post['duration'],
                        'confirmation' => $post['confirmation'],
                        'ticket_type' => $post['ticket_type'],
                        'meeting_place' => $post['meeting_place'],
                        'experience_type' => $post['experience_type'],
                        'ticket_collection' => $post['ticket_collection'],
                        'discount_available' => $post['discount_available'],
                        'package_available_type' => $post['package_available_type'],
                        'specific_day' => $post['specific_day'],
                        'available_date' => $post['available_date'],
                  //      'slot_time' => $post['slot_time'],
                //        'total_slot' => $post['total_slot'],
                //        'person_per_slot' => $post['person_per_slot'],
                        'time' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }

            $id = $this->db->insert_id();
            if(isset($post['slot_id_count'])){
              for($i=0; $i < $post['slot_id_count']; $i++){
                if (!$this->db->insert('package_slot', array(
                'package_id' => $id,
                'slot_time' => $post['slot_time'][$i],
                'total_slot' => $post['total_slot'][$i],
                'person_per_slot'=> $post['person_per_slot'][$i]
              ))){
                    log_message('error', print_r($this->db->error(), true));
                 }
              }
            }
        }

        $this->setPackageTranslation($post, $id, $is_update);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function setPackageTranslation($post, $id, $is_update)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id);
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['name'][$i] = str_replace('"', "'", $post['name'][$i]);
            $post['price_adult'][$i] = str_replace(' ', '', $post['price_adult'][$i]);
            $post['price_adult'][$i] = str_replace(',', '.', $post['price_adult'][$i]);
            $post['price_adult'][$i] = preg_replace("/[^0-9,.]/", "", $post['price_adult'][$i]);
            $post['price_child'][$i] = str_replace(' ', '', $post['price_child'][$i]);
            $post['price_child'][$i] = str_replace(',', '.', $post['price_child'][$i]);
            $post['price_child'][$i] = preg_replace("/[^0-9,.]/", "", $post['price_child'][$i]);

            $arr = array(
                'name' => $post['name'][$i],
                'description' => $post['description'][$i],
                'before_booking' => $post['before_booking'][$i],
                'after_booking' => $post['after_booking'][$i],
                'cancellation_summary' => $post['cancellation_summary'][$i],
                'price_adult' => $post['price_adult'][$i],
                'price_child' => $post['price_child'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );
            if ($is_update === true && $emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr'], $arr['url']);
                if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('packages_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                if (!$this->db->insert('packages_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
        }
    }

    public function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('packages_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['name'] = $row->name;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['before_booking'] = $row->before_booking;
            $arr[$row->abbr]['after_booking'] = $row->after_booking;
            $arr[$row->abbr]['cancellation_summary'] = $row->cancellation_summary;
            $arr[$row->abbr]['price_adult'] = $row->price_adult;
            $arr[$row->abbr]['price_child'] = $row->price_child;
        }
        return $arr;
    }

    public function getMultiSlot($id)
    {
        $this->db->where('package_id', $id);
        $query = $this->db->get('package_slot');
        $arr = array();
        if($query->num_rows()){
          $arr = $query->result();
        }
        return $arr;
    }
    public function getMultiSlotCount($id)
    {
        $this->db->where('package_id', $id);
        $query = $this->db->get('package_slot');
        $count = 0;
        if($query->num_rows()){
          $count = $query->num_rows();
        }
        return $count;
    }

}
