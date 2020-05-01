<?php
$timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?>
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
            <?php
        }
        ?>
        <div class="content">
            <form class="form-box" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="<?= isset($_POST['folder']) ? $_POST['folder'] : $timeNow ?>" name="folder">
                <input type="hidden" value="<?= isset($_POST['expectation_folder']) ? $_POST['expectation_folder'] : $timeNow.'_s' ?>" name="expectation_folder">
                <div class="form-group available-translations">
                    <b>Languages</b>
                    <?php foreach ($languages as $language) { ?>
                        <button type="button" data-locale-change="<?= $language->abbr ?>" class="btn btn-default locale-change text-uppercase <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'active' : '' ?>">
                            <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                            <?= $language->abbr ?>
                        </button>
                    <?php } ?>
                </div>
                <?php
                $i = 0;
                foreach ($languages as $language) {
                    ?>
                    <div class="locale-container locale-container-<?= $language->abbr ?>" <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'style="display:block;"' : '' ?>>
                        <input type="hidden" name="translations[]" value="<?= $language->abbr ?>">
                        <div class="form-group">
                            
                            <label for="title<?= $i ?>">Title <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <input type="text" name="title[]" placeholder="<?= lang('vendor_product_name') ?>" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['title']) ? $trans_load[$language->abbr]['title'] : '' ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" class="btn btn-default showSliderDescrption" data-descr="<?= $i ?>">Show Slider Description <span class="glyphicon glyphicon-circle-arrow-down"></span></a>
                        </div>
                        <div class="theSliderDescrption" id="theSliderDescrption-<?= $i ?>" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'style="display:block;"' : '' ?>>
                            <div class="form-group">
                                <label for="basic_description<?= $i ?>">Slider Description <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                                <textarea name="basic_description[]" id="basic_description<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['basic_description']) ? $trans_load[$language->abbr]['basic_description'] : '' ?></textarea>
                                <script>
                                    CKEDITOR.replace('basic_description<?= $i ?>');
                                    CKEDITOR.config.entities = false;
                                </script>
                            </div>
                        </div>

                        <label><?= lang('vendor_product_description') ?> <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                        <div class="form-group">
                            <textarea class="form-control" name="description[]" id="description<?= $i ?>"><?= $trans_load != null && isset($trans_load[$language->abbr]['description']) ? $trans_load[$language->abbr]['description'] : '' ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('description<?= $i ?>');
                            CKEDITOR.config.entities = false;
                        </script>
                        <div class="form-group">
                            <label for="expectation<?= $i ?>">Expectation <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <textarea name="expectation[]" id="expectation<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['expectation']) ? $trans_load[$language->abbr]['expectation'] : '' ?></textarea>
                            <script>
                                CKEDITOR.replace('expectation<?= $i ?>');
                                CKEDITOR.config.entities = false;
                            </script>
                        </div>
                        <div class="form-group bordered-group">
                            <div class="expectation-images-container">

                                <?= $expectationImgs ?>
                            </div>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#modalExpectationImages" class="btn btn-default">Upload Expectation images</a>
                        </div>
                  <!--      <div class="form-group">
                            <label for="expectation<?php// $i ?>">Price <img src="<?php// base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?php// $language->name ?>"></label>
                            <input type="text" name="price[]" value="<?php// $trans_load != null && isset($trans_load[$language->abbr]['price']) ? $trans_load[$language->abbr]['price'] : '' ?>" placeholder="<?php// lang('vendor_price') ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="expectation<?php// $i ?>">Old Price <img src="<?php// base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?php// $language->name ?>"></label>
                            <input type="text" name="old_price[]" value="<?php// $trans_load != null && isset($trans_load[$language->abbr]['old_price']) ? $trans_load[$language->abbr]['old_price'] : '' ?>" placeholder="<?php// lang('vendor_old_price') ?>" class="form-control">
                        </div>
                      -->
                    </div>
                    <?php
                    $i++;
                }
                ?>
                <div class="form-group bordered-group">
                    <?php
                    if (isset($_POST['image']) && $_POST['image'] != null) {
                        $image = 'attachments/shop_images/' . $_POST['image'];
                        if (!file_exists($image)) {
                            $image = 'attachments/no-image.png';
                        }
                        ?>
                        <p><?= lang('vendor_current_image') ?></p>
                        <div>
                            <img src="<?= base_url($image) ?>" class="img-responsive img-thumbnail" style="max-width:300px; margin-bottom: 5px;">
                        </div>
                        <input type="hidden" name="old_image" value="<?= $_POST['image'] ?>">
                        <?php if (isset($_GET['to_lang'])) { ?>
                            <input type="hidden" name="image" value="<?= $_POST['image'] ?>">
                            <?php
                        }
                    }
                    ?>
                    <label><?= lang('vendor_cover_image') ?></label>
                    <input type="file" name="userfile">
                </div>
                <div class="form-group bordered-group">
                    <div class="others-images-container">
                        <?= $otherImgs ?>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-default"><?= lang('vendor_up_more_imgs') ?></a>
                </div>
                <div class="form-group for-shop">
                    <label><?= lang('vendor_select_category') ?></label>
                    <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm "  name="shop_categorie[]" class="selectpicker w-100 form-control show-tick show-menu-arrow">

                        <?php foreach ($shop_categories as $key_cat => $shop_categorie) { ?>
                            <option <?= isset($_POST['shop_categorie_list']) && in_array($key_cat, $_POST['shop_categorie_list']) ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
                                <?php
                                foreach ($shop_categorie['info'] as $nameAbbr) {
                                    if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
                                        echo $nameAbbr['name'];
                                    }
                                }
                                ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <?php if ($showBrands == 1) { ?>
                    <div class="form-group for-shop">
                        <label>Brand</label>
                        <select class="selectpicker" name="brand_id">
                            <?php foreach ($brands as $brand) { ?>
                                <option <?= isset($_POST['brand_id']) && $_POST['brand_id'] == $brand['id'] ? 'selected' : '' ?> value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>
            <!--    <div class="form-group for-shop">
                    <label>Is Display On Top Experience</label>
                    <select class="selectpicker" name="display_top_experience">
                      <option value="No" <?php// isset($_POST['display_top_experience']) && $_POST['display_top_experience'] == 'No' ? 'selected' : '' ?>>No</option>
                      <option value="Yes" <?php// isset($_POST['display_top_experience']) && $_POST['display_top_experience'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                    </select>
                </div>
              -->
                <div class="form-group for-shop">
                    <label>Discount On Deal in %</label>
                    <input type="text" placeholder="number" name="discount_percent" value="<?= @$_POST['discount_percent'] ?>" class="form-control" id="discount_percent">
                </div>
                <div class="form-group for-shop">
                    <label>Latitude</label>
                    <input type="text" placeholder="number" name="latitude" value="<?= @$_POST['latitude'] ?>" class="form-control" id="latitude">
                </div>
                <div class="form-group for-shop">
                    <label>Longitude</label>
                    <input type="text" placeholder="number" name="longitude" value="<?= @$_POST['longitude'] ?>" class="form-control" id="longitude">
                </div>
                <div class="form-group for-shop">
                    <label>Country</label>
                    <select class="selectpicker" name="country">
                      <option value="1">Singapore</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>City</label>
                    <select class="selectpicker" name="city">
                      <option value="1">Pulau Ujong</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>MetaWord</label>
                    <select class="selectpicker" name="metaword">
                      <option value="1">Welcome Singapore</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>In Slider</label>
                    <select class="selectpicker" name="in_slider">
                        <option value="1" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 0 || !isset($_POST['in_slider']) ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Position</label>
                    <input type="text" placeholder="Position number" name="position" value="<?= @$_POST['position'] ?>" class="form-control">
                </div>
                <button type="submit" name="setProduct" class="btn btn-green"><?= lang('vendor_submit_product') ?></button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExpectationImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Expectation images</h4>
            </div>
            <div class="modal-body">
                <form id="ExpectationImagesForm">
                    <input type="hidden" value="<?= isset($_POST['expectation_folder']) ? $_POST['expectation_folder'] : $timeNow.'_s' ?>" name="expectation_folder">
                    <label for="others">Select images</label>
                    <input type="file" name="expectations_image[]" id="expectations_image" multiple /><br/>
                    <label for="others">Select Text</label><br />
                    <input type="text" name="expectations_subtitle[]" class="form-control" placeholder="Subtitle text" id="expectations_subtitle"  />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default finish-expectation">
                    <span class="finish-text">Upload</span>
                    <img src="<?= base_url('assets/imgs/load.gif') ?>" class="loadUploadOthers" alt="">
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Upload More Images -->
<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('vendor_up_more_imgs') ?></h4>
            </div>
            <div class="modal-body">
                <form id="uploadImagesForm">
                    <input type="hidden" value="<?= isset($_POST['folder']) ? $_POST['folder'] : $timeNow ?>" name="folder">
                    <label for="others"><?= lang('vendor_select_images') ?></label>
                    <input type="file" name="others[]" id="others" multiple />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default finish-upload">
                    <span class="finish-text"><?= lang('finish') ?></span>
                    <img src="<?= base_url('assets/imgs/load.gif') ?>" class="loadUploadOthers" alt="">
                </button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
