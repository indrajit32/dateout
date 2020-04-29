<?php

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOneProduct($id, $vendor_id)
    {
      $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.price');
      $this->db->where('products.id', $id);
      $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
      $this->db->where('products.vendor_id', $vendor_id);
      $this->db->join('products_translations', 'products_translations.for_id = products.id', 'inner');
      $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
      $query = $this->db->get('products');
      if ($query->num_rows() > 0) {
        $arr = $query->row_array();
          $query1 = $this->db->query('SELECT shop_categorie_id FROM product_shop_categorie_mapping WHERE product_id = '.$id);
          if($query1->num_rows() > 0){
            foreach( $query1->result() as $k){
              $arr['shop_categorie_list'][]= $k->shop_categorie_id;
            }
          }
          return $arr;
      }
      else {
          return false;
      }
    }

    public function getProducts_vendor($vendor_id)
    {
        $this->db->join('vendors', 'vendors.id = '.$vendor_id, 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->where('products.vendor_id', $vendor_id);
        $query = $this->db->select('products_translations.for_id, products_translations.title')->get('products');
        return $query->result();
    }

    public function delete_expected_images($img, $folder)
    {
      $this->db->where('expectation_folder', $folder);
      $this->db->where('image', $img);
      $result = $this->db->delete('products_expectation');
      return $result;
    }
    public function get_expected_images($expectation_folder)
    {
    $arr ="";
        $this->db->where('expectation_folder', $expectation_folder);
        $query = $this->db->get('products_expectation');
        if ($query->num_rows() > 0) {
          $arr = $query->result();
        }
        return $arr;
    }
    public function set_expected_images($img, $txt, $expectation_folder)
    {
        $result = $this->db->insert('products_expectation', array('expectation_folder' => $expectation_folder, 'image' => $img, 'text' => $txt ));
        return $result;
    }
    public function setProduct($post, $id = 0)
    {
        $this->db->trans_begin();
        $is_update = false;
        if ($id > 0) {
            $is_update = true;
          if(isset($post['shop_categorie'])){
              $this->db->where('product_id', $id);
              if (!$this->db->delete('product_shop_categorie_mapping')) {
                  log_message('error', print_r($this->db->error(), true));
              }
              else{
                foreach ($post['shop_categorie'] as $k) {
                  if (!$this->db->insert('product_shop_categorie_mapping', array(
                  'product_id' => $id,
                  'shop_categorie_id' => $k))){
                      log_message('error', print_r($this->db->error(), true));
                   }
                }
              }
            }
            if (!$this->db->where('id', $id)->where('vendor_id', $post['vendor_id'])->update('products', array(
                      'image' => $post['image'] != null ? $_POST['image'] : $_POST['old_image'],
                      'display_top_experience' => $post['display_top_experience'],
                      'discount_percent' => $post['discount_percent'],
                      'latitude' => $post['latitude'],
                      'longitude' => $post['longitude'],
                      'discount_percent' => $post['discount_percent'],
                      'country' => $post['country'],
                      'city' => $post['city'],
                      'metaword' => $post['metaword'],
                      'in_slider' => $post['in_slider'],
                      'position' => $post['position'],
                //      'virtual_products' => $post['virtual_products'],
              //        'brand_id' => $post['brand_id'],
                      'vendor_id' => $post['vendor_id'],
                      'time_update' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
        } else {
            $i = 0;
            foreach ($_POST['translations'] as $translation) {
                if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
                    $myTranslationNum = $i;
                }
                $i++;
            }
            if (!$this->db->insert('products', array(
                  'image' => $post['image'] != null ? $_POST['image'] : $_POST['old_image'],
                    'latitude' => $post['latitude'],
                    'longitude' => $post['longitude'],
                    'discount_percent' => $post['discount_percent'],
                    'display_top_experience' => $post['display_top_experience'],
                    'country' => $post['country'],
                    'city' => $post['city'],
                    'metaword' => $post['metaword'],
                    'in_slider' => $post['in_slider'],
                    'position' => $post['position'],
              //      'virtual_products' => $post['virtual_products'],
                    'folder' => $post['folder'],
                    'expectation_folder' => $post['expectation_folder'],
            //        'brand_id' => $post['brand_id'],
                    'vendor_id' => $post['vendor_id'],
                    'time' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $id = $this->db->insert_id();

            $this->db->where('id', $id);
            if (!$this->db->update('products', array(
                        'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            if(isset($post['shop_categorie'])){
                foreach ($post['shop_categorie'] as $k) {
                  if (!$this->db->insert('product_shop_categorie_mapping', array(
                  'product_id' => $id,
                  'shop_categorie_id' => $k))){
                      log_message('error', print_r($this->db->error(), true));
                   }
                }
            }
        }
        $this->setProductTranslation($post, $id, $is_update);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    private function setProductTranslation($post, $id, $is_update = false)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id, 'product');
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
        //    $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
        //    $post['price'][$i] = str_replace(',', '', $post['price'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'description' => $post['description'][$i],
                'basic_description' => $post['basic_description'][$i],
                'expectation' => $post['expectation'][$i],
          //      'price' => $post['price'][$i],
          //      'old_price' => $post['old_price'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );
            if ($is_update === true && $emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr'], $arr['url']);
                if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('products_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                if (!$this->db->insert('products_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
        }
    }

    public function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('products_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['title'] = $row->title;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['basic_description'] = $row->basic_description;
            $arr[$row->abbr]['expectation'] = $row->expectation;
        //    $arr[$row->abbr]['price'] = $row->price;
        //    $arr[$row->abbr]['old_price'] = $row->old_price;
        }
        return $arr;
    }

    public function getProducts($limit, $page, $vendor_id)
    {
        $this->db->order_by('products.position', 'asc');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->select('products.*, products_translations.title, products_translations.description, products_translations.price')->get('products', $limit, $page);
        return $query->result();
    }

    public function productsCount($vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        return $this->db->count_all_results('products');
    }

    public function deleteProduct($id)
    {
        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->where('vendor_id', $vendor_id);
        if (!$this->db->delete('products')) {
            log_message('error', print_r($this->db->error(), true));
        } else {
            $this->db->where('for_id', $id);
            if (!$this->db->delete('products_translations')) {
                log_message('error', print_r($this->db->error(), true));
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

}
