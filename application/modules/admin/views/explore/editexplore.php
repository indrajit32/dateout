<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= base_url('assets/js/rating.js') ?>"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

<h1><img src="<?= base_url('assets/imgs/blogger.png') ?>" class="header-img" style="margin-top:-2px;"> Publish review</h1>
<hr>
<div class="row">
    <div class="col-sm-8 col-md-7">
        <?php if (validation_errors()) { ?>
            <hr>
            <div class="alert alert-danger"><?= validation_errors() ?></div>
            <hr>
        <?php }
        ?>
        <?php if ($this->session->flashdata('result_publish')) { ?>
            <hr>
            <div class="alert alert-danger"><?= $this->session->flashdata('result_publish'); ?></div>
            <hr>
        <?php }
        ?>
        <form method="POST" action="explore/edit" enctype="multipart/form-data">

                <input type="hidden" value="<?php echo $explore[0]['id'] ?>" name="id">
                <div class="form-group"> 
                    <label for="title">Title</label>
                    <input type="text" value="<?php echo $explore[0]['title'] ?>" name="title" placeholder= "Review Title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" placeholder= "message"  rows="5" class="form-control">
                        <?php echo $explore[0]['message'] ?>
                    </textarea>
                </div>

                <div class="form-group"> 
                    <label for="url">Credit Url</label>
                    <input type="credit_url" value="<?php echo $explore[0]['credit_url'] ?>" name="credit_url" placeholder= "Credit Url" class="form-control">
                </div>


                <?php
                $images = get_explore_images_by_id($explore[0]['id']);
                $img = [];
                foreach ($images as $key => $value) {
                    $u_path = 'attachments/explore_images/';
                    if ($value['image'] != null && file_exists($u_path . $value['image'])) {
                        $img[$key]['img'] = base_url($u_path . $value['image']);
                        $img[$key]['img_id'] = $value['id'];
                        $img[$key]['img_name'] = $value['image'];
                    } else {
                        $img[$key]['img'] = base_url('attachments/no-image.png');
                        $img[$key]['img_id'] = $value['id'];
                        $img[$key]['img_name'] = $value['image'];
                    }
                }
                
                ?>

                <?php  if( count($img) > 0 ){ ?>
                <div class="form-group"> 
                    <label for="rating">Explore Images</label>
                    <div>
                    <?php  foreach ($img as $value) { ?>
                        <div class="other-img" id="image-container-<?php echo $value['img_id']; ?>">
                            <img src="<?php echo $value['img']; ?>" style="width: 100px;height: 100px">
                            <a href="javascript:void(0);" onclick="removeDealImage('<?php echo $value['img_name']; ?>', '<?php echo $value['img_id']; ?>')">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                    
                    <?php } ?>
                    </div>

                </div>
            <?php } ?>


            <div class="form-group">
                <label for="credit">Upload image:</label>
                <input type="file" id="credit" name="explore[]" multiple>
            </div>

            <?php  if( $explore[0]['credit_image'] != null ){ ?>
                <div class="form-group"> 
                    <label for="rating">Credit Images</label>
                    <div>
                        <div class="other-img" id="image-container-<?php echo $explore[0]['id']; ?>">
                            <img 
                            src="<?php echo base_url() ?>attachments/explore_images/<?php echo $explore[0]['credit_image'] ?>" 
                            style="width: 100px;height: 100px">
                            <a 
                            href="javascript:void(0);" 
                            onclick="removeCreditImage('<?php echo $explore[0]['credit_image']; ?>', '<?php echo $explore[0]['id']; ?>')">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                    </div>

                </div>
            <?php } ?>


            <div class="form-group">
                <label for="credit">Upload image:</label>
                <input type="file" id="credit" name="credit[]">
            </div>
            <button type="submit" name="submit" class="btn btn-default">Edit</button>

        </form>
    </div>
</div>

<script type="text/javascript">
        //products publish
        function removeDealImage(image, img_id) {
            var url = '<?php echo base_url(); ?>'+'admin/explore/explore/deleteImages';
            $.ajax({
                type: "POST",
                url: url,
                data: {image: image, img_id: img_id}
            }).done(function (data) {
                $('#image-container-' + img_id).remove();
            });
        }

        function removeCreditImage(image, img_id){
            var url = '<?php echo base_url(); ?>'+'admin/explore/explore/deleteCreditImages';
            $.ajax({
                type: "POST",
                url: url,
                data: {image: image, img_id: img_id}
            }).done(function (data) {
                $('#image-container-' + img_id).remove();
            });

        } 
</script>