<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
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
        <form method="POST" action="review/edit" enctype="multipart/form-data">

                <div class="form-group"> 
                    <label for="product_id">Product id</label>
                    <input type="text" value="<?php echo $review[0]['product_id'] ?>" name="product_id" placeholder= "Product Id" class="form-control">

                    <input type="hidden" value="<?php echo $review[0]['id'] ?>" name="id">
                </div>

                <div class="form-group"> 
                    <label for="user_id">User id</label>
                    <input type="text" value="<?php echo $review[0]['customer_id'] ?>" name="user_id" placeholder= "User Id" class="form-control">
                </div>

                <div class="form-group"> 
                    <label for="title">Title</label>
                    <input type="text" value="<?php echo $review[0]['title'] ?>" name="title" placeholder= "Review Title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="comment">Comments</label>
                    <textarea name="comment" placeholder= "comment"  rows="5" class="form-control">
                        <?php echo $review[0]['comment'] ?>
                    </textarea>
                </div>

                <div class="form-group"> 
                    <label for="rating">Rating</label>
                    <input type="text" value="<?php echo $review[0]['rating'] ?>"  name="rating" placeholder= "Rating" class="form-control">
                </div>
            <button type="submit" name="submit" class="btn btn-default">Edit</button>

        </form>
    </div>
</div>