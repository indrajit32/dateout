<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-21 12:42:10 --> 404 Page Not Found: ../modules/admin/controllers/review//index
ERROR - 2020-03-21 12:50:20 --> Query error: Table 'shop.product_reviews' doesn't exist - Invalid query: INSERT INTO `product_reviews` (`customer_id`, `product_id`, `title`, `comment`, `created_at`) VALUES ('11', '11', 'sss', 'ddddd\r\n                    ', 1584791420)
ERROR - 2020-03-21 12:51:04 --> Query error: Table 'shop.product_reviews' doesn't exist - Invalid query: INSERT INTO `product_reviews` (`customer_id`, `product_id`, `title`, `comment`, `created_at`) VALUES ('11', '11', 'sss', 'ddddd\r\n                    ', 1584791464)
ERROR - 2020-03-21 12:51:47 --> Query error: Table 'dateout.value_store' doesn't exist - Invalid query: SELECT value FROM value_store WHERE thekey = 'outOfStock'
ERROR - 2020-03-21 12:53:18 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shop`.`product_reviews`, CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `product_reviews` (`customer_id`, `product_id`, `title`, `comment`, `created_at`) VALUES ('11', '11', 'sss', 'ddddd\r\n                    ', 1584791598)
ERROR - 2020-03-21 12:54:52 --> Severity: Notice --> Undefined variable: myTranslationNum C:\xampp\htdocs\dateout\application\modules\admin\models\Review_model.php 88
ERROR - 2020-03-21 12:54:52 --> Severity: Notice --> String offset cast occurred C:\xampp\htdocs\dateout\application\modules\admin\models\Review_model.php 88
ERROR - 2020-03-21 12:54:52 --> Severity: Notice --> Undefined index: translations C:\xampp\htdocs\dateout\application\modules\admin\models\Review_model.php 106
ERROR - 2020-03-21 12:54:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\dateout\application\modules\admin\models\Review_model.php 106
ERROR - 2020-03-21 12:58:42 --> 404 Page Not Found: /index
ERROR - 2020-03-21 12:58:49 --> 404 Page Not Found: /index
ERROR - 2020-03-21 13:07:18 --> Severity: Warning --> is_uploaded_file() expects parameter 1 to be string, array given C:\xampp\htdocs\dateout\system\libraries\Upload.php 412
ERROR - 2020-03-21 13:07:18 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2020-03-21 13:23:40 --> 404 Page Not Found: /index
ERROR - 2020-03-21 14:49:42 --> Could not find the language line "vendor_home_page"
ERROR - 2020-03-21 14:51:09 --> Could not find the language line "vendor_home_page"
ERROR - 2020-03-21 14:51:26 --> Could not find the language line "vendor_home_page"
