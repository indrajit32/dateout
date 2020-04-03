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
        <form method="POST" enctype="multipart/form-data">

                <div class="form-group"> 
                    <label for="user_id">Deal</label>

                      <select class="form-control" name="product_id">

                        <?php $deal_details = get_all_deals();  
                            foreach ($deal_details as $value) {
                        ?>
                            

                        <option value="<?php echo $value['for_id']; ?>" >
                        
                        <?php echo $value['title']; ?>

                        </option>
                        <?php
                            }
                        ?>
                        

                      </select>
                </div>

                <div class="form-group"> 
                    <label for="user_id">Customer</label>

                      <select class="form-control" name="user_id">

                        <?php $user_details = get_all_user(); 
                            foreach ($user_details as $value) {
                        ?>
                            

                        <option value="<?php echo $value['id']; ?>" >
                        
                        <?php echo $value['username']; ?>

                        </option>
                        <?php
                            }
                        ?>
                        

                      </select>
                </div>

                <div class="form-group"> 
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder= "Review Title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="comment">Comments</label>
                    <textarea name="comment" placeholder= "comment"  rows="5" class="form-control">

                    </textarea>
                </div>

                <div class="form-group"> 
                    <label for="rating">Rating</label>
                    <input type="hidden" name="rating" id="halfstarsInput" placeholder= "Rating" class="form-control">
                    

                <div  style="font-size: 2em;">
                    <div id="halfstarsReview"></div>
                </div>

                </div>
            <div class="form-group">
                <?php if (isset($_POST['image'])) { ?>
                    <input type="hidden" name="old_image" value="<?= $_POST['image'] ?>">
                    <div><img class="img-responsive" src="<?= base_url('attachments/blog_images/' . $_POST['image']) ?>"></div>
                    <label for="userfile">Choose another image:</label>
                <?php } else { ?>
                    <label for="userfile">Upload image:</label>
                <?php } ?>
                <input type="file" id="userfile" name="userfile[]" multiple>
            </div>
            <button type="submit" name="submit" class="btn btn-default">Publish</button>
            <?php if ($id > 0) { ?>
                <a href="<?= base_url('admin/blog') ?>" class="btn btn-info">Cancel</a>
            <?php } ?>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#halfstarsReview").rating({
        "half": true,
        "click": function (e) {
            console.log(e);
            $("#halfstarsInput").val(e.stars);
        }
        });
    });

</script>