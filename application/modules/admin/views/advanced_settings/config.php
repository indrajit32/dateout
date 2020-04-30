<div id="users">
    <h1>
        <img src="<?= base_url('assets/imgs/settings-page.png') ?>" class="header-img" style="margin-top:-3px;"> Config
    </h1> 
    <hr>
    <div class="clearfix"></div>

    <div class="form-group available-translations">
        <b>Languages</b>
        <?php foreach ($languages as $language) { ?>
            <button type="button" data-locale-change="<?= $language->abbr ?>" class="btn btn-default locale-change text-uppercase <?= $language->abbr == $lang ? 'active' : '' ?>" onclick="myFunction('<?= $language->abbr ?>')">
                <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                <?= $language->abbr ?>
            </button>
        <?php } ?>
    </div>
    <?php
    if ($data) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Type</th>
                        <th>Key Name</th>
                        <th>Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php foreach ($data as $dt) { ?>
                    <tr id="row_<?= $dt['id'] ?>">
                        <td id="row_id_<?= $dt['id'] ?>" ><?= $dt['id'] ?></td>
                        <td id="row_type_<?= $dt['id'] ?>" ><?= $dt['type'] ?></td>
                        <td id="row_key_name_<?= $dt['id'] ?>" ><?= $dt['key_name'] ?></td>
                        <td id="row_value_<?= $dt['id'] ?>"><?= $dt['value'] ?></td>
                        <td class="text-center">
                            <div>
                                <a href="?edit=<?= $dt['id'] ?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No data found!</div>
    <?php } ?>

    <!-- add edit users -->
    <div class="modal fade" id="add_edit_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo base_url(); ?>admin/advanced_settings/config/edit" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Config</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                        <?php  /*  ?>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" name="type" value="" class="form-control" id="type_<?= $_GET['edit'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="key_name">Key Name</label>
                            <input type="key_name" name="key_name" class="form-control" value="" id="key_name_<?= $_GET['edit'] ?>">
                        </div>
                        <?php  */ ?>
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" class="form-control" value="" id="value_<?= $_GET['edit'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
<?php if (isset($_GET['edit'])) { ?>
        $(document).ready(function () {

            $(".modal-footer").show();

            var v1 = $("#row_<?= $_GET['edit']?> #row_type_<?= $_GET['edit']?>").text();
            var v2 = $("#row_<?= $_GET['edit']?> #row_key_name_<?= $_GET['edit']?>").text();
            var v3 = $("#row_<?= $_GET['edit']?> #row_value_<?= $_GET['edit']?>").text();

            $("#type_<?= $_GET['edit'] ?>").val(v1);
            $("#key_name_<?= $_GET['edit'] ?>").val(v2);
            $("#value_<?= $_GET['edit'] ?>").val(v3);

            $("#add_edit_users").modal('show');
        });
<?php }else{ ?>

 $(document).ready(function () {
    $(".modal-footer").hide();
 });

<?php } ?>

    function myFunction(lang){

        var url = '<?php echo base_url(); ?>admin/advanced_settings/config/index/'+lang;
        window.location.href = url;
    }

</script>