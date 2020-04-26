<div id="languages">
    <h1><img src="<?= base_url('assets/imgs/categories.jpg') ?>" class="header-img" style="margin-top:-2px;"> Shop Categories</h1>
    <hr>
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_add')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_add') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_delete')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    ?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_articles" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add shop categorie</a>
    <div class="clearfix"></div>
    <?php
    if (!empty($shop_categories)) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Subcategory for</th>
                        <th>Position</th>
                        <th>Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                foreach ($shop_categories as $key_cat => $shop_categorie) {
                    $catName = '';
                    foreach ($shop_categorie['info'] as $ff) {
                        $catName .= '<div>'
                                . '<a href="javascript:void(0);" class="editCategorie" data-indic="' . $i . '" data-for-id="' . $key_cat . '" data-abbr="' . $ff['abbr'] . '" data-toggle="tooltip" data-placement="top" title="Edit this categorie">'
                                . '<i class="fa fa-pencil" aria-hidden="true"></i>'
                                . '</a> '
                                . '[' . $ff['abbr'] . ']<span id="indic-' . $i . '">' . $ff['name'] . '</span>'
                                . '</div>';
                        $i++;
                    }
                    ?>
                    <tr>
                        <td><?= $key_cat ?></td>
                        <td><?= $catName ?></td>
                        <td>
                            <a href="javascript:void(0);" class="editCategorieSub" data-sub-for-id="<?= $key_cat ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <?php foreach ($shop_categorie['sub'] as $sub) { ?>
                                <div> <?= $sub ?> </div>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="editPosition" data-position-for-id="<?= $key_cat ?>" data-my-position="<?= $shop_categorie['position'] ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <span id="position-<?= $key_cat ?>"><?= $shop_categorie['position'] ?></span>
                        </td>
                        <td width="150px">
                            <?php
                            if (isset($shop_categorie['categorie_image']) && $shop_categorie['categorie_image'] != null) {
                                $image = 'attachments/cat_images/' . $shop_categorie['categorie_image'];
                                if (!file_exists($image)) {
                                    $image = 'attachments/no-image.png';
                                }
                                ?>
                            <span id="image-<?= $key_cat ?>"><img id="image-path-<?= $key_cat ?>" height="80px" width="80px" src="<?= base_url($image) ?>"/></span>
                          <?php }
                          ?>
                          <a href="javascript:void(0);" class="editImage" data-image-for-id="<?= $key_cat ?>" data-my-image="<?= $shop_categorie['categorie_image'] ?>">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                          </a>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/shopcategories/?delete=' . $key_cat) ?>" class="btn btn-danger btn-xs confirm-delete"><span class="glyphicon glyphicon-remove"></span> Del</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
        echo $links_pagination;
    } else {
        ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No shop categories found!</div>
    <?php } ?>

    <!-- add edit home categorie -->
    <div class="modal fade" id="add_edit_articles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($languages as $language) { ?>
                            <input type="hidden" name="translations[]" value="<?= $language->abbr ?>">
                        <?php } foreach ($languages as $language) { ?>
                            <div class="form-group">
                                <label>Name (<?= $language->name ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)</label>
                                <input type="text" name="categorie_name[]" class="form-control">
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label>Parent <sup>this categorie will be subcategorie of parent</sup>:</label>
                            <select class="form-control" name="sub_for">
                                <option value="0">None</option>
                                <?php
                                foreach ($shop_categories as $key_cat => $shop_categorie) {
                                    $aa = '';
                                    foreach ($shop_categorie['info'] as $ff) {
                                        $aa .= '[' . $ff['abbr'] . ']' . $ff['name'] . '/';
                                    }
                                    ?>
                                    <option value="<?= $key_cat ?>"><?= $aa ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group bordered-group">
                            <?php
                            if (isset($_POST['image']) && $_POST['image'] != null) {
                                $image = 'attachments/cat_images/' . $_POST['image'];
                                if (!file_exists($image)) {
                                    $image = 'attachments/no-image.png';
                                }
                                ?>
                                <p>Current image:</p>
                                <div>
                                    <img src="<?= base_url($image) ?>" class="img-responsive img-thumbnail" style="max-width:300px; margin-bottom: 5px;">
                                </div>
                                <input type="hidden" name="old_image" value="<?= $_POST['categorie_image'] ?>">
                                <?php if (isset($_GET['to_lang'])) { ?>
                                    <input type="hidden" name="image" value="<?= $_POST['categorie_image'] ?>">
                                    <?php
                                }
                            }
                            ?>
                            <label for="categorie_image">Categorie Image</label>
                            <input type="file" id="categorie_image" name="categorie_image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="categorieEditor">
    <input type="text" name="new_value" class="form-control" value="">
    <button type="button" class="btn btn-default saveEditCategorie">
        <i class="fa fa-floppy-o noSaveEdit" aria-hidden="true"></i>
        <i class="fa fa-spinner fa-spin fa-fw yesSaveEdit"></i>
    </button>
    <button type="button" class="btn btn-default closeEditCategorie"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
<div id="categorieSubEdit">
    <form method="POST" id="categorieEditSubChanger">
        <input type="hidden" name="editSubId" value="">
        <select class="selectpicker" name="newSubIs">
            <option value=""></option>
            <option value="0">None</option>
            <?php
            foreach ($shop_categories as $key_cat => $shop_categorie) {
                $aa = '';
                foreach ($shop_categorie['info'] as $ff) {
                    $aa .= '[' . $ff['abbr'] . ']' . $ff['name'] . '/';
                }
                ?>
                <option value="<?= $key_cat ?>"><?= $aa ?></option>
            <?php } ?>
        </select>
    </form>
</div>
<div id="positionEditor">
    <input type="hidden" name="positionEditId" value="">
    <input type="text" name="new_position" class="form-control" value="">
    <button type="button" class="btn btn-default savePositionCategorie">
        <i class="fa fa-floppy-o noSavePosition" aria-hidden="true"></i>
        <i class="fa fa-spinner fa-spin fa-fw yesSavePosition"></i>
    </button>
    <button type="button" class="btn btn-default closePositionCategorie"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
<div id="categorieImageEdit" class="modal fade" id="add_edit_articles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Change Image</h4>
        </div>
        <div class="modal-body">
        <form method="POST" action="<?= base_url('admin/editShopCategorieImage')?>" enctype="multipart/form-data" id="categorieEditImageChanger">
            <input type="hidden" name="imageEditId" value="">
            <input type="hidden" name="newImage" value="">
            <img id="newImage_src" src="" height="80px" width="80px"><br/><br/>
            <input type="file" name="edit_categorie_image" id="edit_categorie_image" class="form-control" value=""><br/>
            <input type="submit" class="btn btn-default">
            <button type="button" class="btn btn-default closePositionCategorie" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </form>
      </div>
    </div>
</div>
<style>
#categorieImageEdit {
  padding-right: 17px;
  width: 400px;
  top: 15%;
  left: 40%;
  height: 400px;
}
#categorieImageEdit .modal-dialog{
  width: 380px;
}
</style>
