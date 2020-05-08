<?php

class Api_model extends CI_Model
{

    public function getProducts($lang)
    {
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', $lang);
        $this->db->where('products.visibility', 1);
        $query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.id as product_id, products.image as product_image, products.time as product_time_created, products.time_update as product_time_updated, products.visibility as product_visibility, products.shop_categorie as product_category, products.quantity as product_quantity_available, products.procurement as product_procurement, products.url as product_url, products.virtual_products, products.brand_id as product_brand_id, products.position as product_position , products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description')->get('products');
        return $query->result_array();
    }

    public function getProductsByCategory($lang,$category_id)
    {
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', $lang);
        $this->db->where('products.shop_categorie', $category_id);
        $query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.id as product_id, products.image as product_image, products.time as product_time_created, products.time_update as product_time_updated, products.visibility as product_visibility, products.shop_categorie as product_category, products.quantity as product_quantity_available, products.procurement as product_procurement, products.url as product_url, products.virtual_products, products.brand_id as product_brand_id, products.position as product_position , products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description')->get('products');
        return $query->result_array();
    }

/*    public function getProduct($lang, $id)
    {
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', $lang);
        $this->db->where('products.id', $id);
        $this->db->limit(1);
        $query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.id as product_id, products.image as product_image, products.time as product_time_created, products.time_update as product_time_updated, products.visibility as product_visibility, products.shop_categorie as product_category, products.quantity as product_quantity_available, products.procurement as product_procurement, products.url as product_url, products.virtual_products, products.brand_id as product_brand_id, products.position as product_position , products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description')->get('products');
        return $query->row_array();
    }
*/
    public function getProduct($lang, $id)
    {

      $this->db->select('products.folder, products.expectation_folder, products.id, products_translations.description, products.image, products.display_top_experience, products.discount_percent,
        products.latitude, products.longitude, products.country as country_id, "Singapur" as country_name, products.city as city_id,
        "Pulau Ujong" as city_name, products.metaword as metword_id, "Welcome Singapore" as metaword, products.position,
        products.country, products.vendor_id, products_translations.title, products_translations.expectation');
      $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
      //$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
      $this->db->where('products_translations.abbr', $lang);
      $this->db->where('visibility', 1);
      $this->db->where('products.id', $id);
      $query = $this->db->get('products');
      $arr = array();
      if($query->num_rows()> 0){
        foreach ($query->result_array() as $value) {
          $value['review'] = [];
          $value['is_available']= 'Yes';
          if($value['image']){
            $value['image']=base_url().'attachments/shop_images/'.$value['image'];
          }
          $this->db->select('expectation_folder, image, text');
          $this->db->where('expectation_folder', $value['expectation_folder']);
          $query1 = $this->db->get('products_expectation');
          $value['expectation_images'] = array();
          if($query1->num_rows()> 0){
            $exp_data = array();
            foreach ($query1->result_array() as $v) {
              $exp_data['image'] = base_url().EXPECTATION_DIR.$v['expectation_folder'].'/'.$v['image'];
              $exp_data['text'] = $v['text'];
              $value['expectation_images'][] = $exp_data;
            }
          }
          $value['more_images']= $this->loadOthersImages($value['folder']);
          $value['categories']= $this->category_maplist($lang, $id);
          $value['packages']= $this->package_list($lang, $id);
          $arr[] = $value;
        }
      }
      return $arr;
    }

    public function setProduct($post)
    {
        if (!isset($post['brand_id'])) {
            $post['brand_id'] = null;
        }
        if (!isset($post['virtual_products'])) {
            $post['virtual_products'] = null;
        }
        $this->db->trans_begin();
        $i = 0;
        foreach ($_POST['translations'] as $translation) {
            if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
                $myTranslationNum = $i;
            }
            $i++;
        }
        if (!$this->db->insert('products', array(
                    'image' => $post['image'],
                    'shop_categorie' => $post['shop_categorie'],
                    'quantity' => $post['quantity'],
                    'in_slider' => $post['in_slider'],
                    'position' => $post['position'],
                    'virtual_products' => $post['virtual_products'],
                    'folder' => time(),
                    'brand_id' => $post['brand_id'],
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
        $this->setProductTranslation($post, $id);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    private function setProductTranslation($post, $id)
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
            $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
            $post['price'][$i] = str_replace(',', '', $post['price'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'basic_description' => $post['basic_description'][$i],
                'description' => $post['description'][$i],
                'price' => $post['price'][$i],
                'old_price' => $post['old_price'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );

            if (!$this->db->insert('products_translations', $arr)) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i++;
        }
    }

    private function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('products_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['title'] = $row->title;
            $arr[$row->abbr]['basic_description'] = $row->basic_description;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['price'] = $row->price;
            $arr[$row->abbr]['old_price'] = $row->old_price;
        }
        return $arr;
    }

    public function deleteProduct($id)
    {
        $this->db->trans_begin();
        $this->db->where('for_id', $id);
        if (!$this->db->delete('products_translations')) {
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->where('id', $id);
        if (!$this->db->delete('products')) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function loadOthersImages($folder)
    {
        $output = array();
        if (isset($folder) && $folder != null) {
            $dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $i = 0;
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file)) {
                            $output[]= base_url('attachments/shop_images/' . $folder . '/' . $file);
                        }
                    }
                    closedir($dh);
                }
            }
        }
      return $output;
    }
    public function category_maplist($lang, $id)
    {
      $this->db->select('shop_categories.id, shop_categories_translations.name');
      $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = shop_categories.id', 'inner');
      $this->db->where('shop_categories_translations.abbr', $lang);
      $this->db->join('product_shop_categorie_mapping', 'product_shop_categorie_mapping.shop_categorie_id = shop_categories.id', 'inner');
      $this->db->where('product_shop_categorie_mapping.product_id', $id);
      $query1 = $this->db->get('shop_categories');
      if ($query1->num_rows() > 0) {
        return $query1->result_array();
      }
      return array();
    }

    public function package_list($lang, $id)
    {
      $arr = array();
      $this->db->select('packages.*, packages_translations.name, packages_translations.description, packages_translations.before_booking, packages_translations.after_booking, packages_translations.cancellation_summary, packages_translations.price_adult, packages_translations.price_child');
      $this->db->join('packages_translations', 'packages_translations.for_id = packages.id', 'inner');
      $this->db->where('packages_translations.abbr', $lang);
      $this->db->where('packages.experience_id', $id);
      $this->db->order_by('time_update', 'desc');
      $query1 = $this->db->get('packages');
      if ($query1->num_rows() > 0) {
        foreach ($query1->result_array() as $value) {
          if($value['package_available_type']=='Time'){}
            $this->db->select('id, package_id, available_date, slot_time, total_slot, person_per_slot');
            $this->db->where('package_slot.package_id', $value['id']);
            $query2 = $this->db->get('package_slot');
            $value['package_slot'] = array();
            if ($query2->num_rows() > 0) {
              $value['package_slot'] = $query2->result_array();
            }
            $arr[]= $value;
          }
        }

      return $arr;
    }
}
