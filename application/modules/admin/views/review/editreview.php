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
        <form method="POST" action="review/edit" enctype="multipart/form-data">


                <div class="form-group"> 
                    <label for="product_id">Product</label>
                        <input type="hidden" value="<?php echo $review[0]['id'] ?>" name="id">
                      <select class="form-control" name="product_id">

                        <?php $deal_details = get_all_deals(); 
                            foreach ($deal_details as $value) {
                        ?>
                            

                        <option value="<?php echo $value['for_id']; ?>" 
                            <?php echo ( $review[0]['product_id'] == $value['for_id'] ) ? 'selected' : '' ; ?> >
                        
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
                            

                        <option value="<?php echo $value['id']; ?>" 
                            <?php echo ( $review[0]['customer_id'] == $value['id'] ) ? 'selected' : '' ; ?> >
                        
                        <?php echo $value['username']; ?>

                        </option>
                        <?php
                            }
                        ?>
                        

                      </select>
                </div>

                <div class="form-group"> 
                    <label for="title">Title</label>
                    <input type="text" value="<?php echo $review[0]['title'] ?>" name="title" placeholder= "Review Title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="comment">Comments</label>
                    <textarea name="comment" placeholder= "comment"  rows="5" class="form-control">
                        <?php echo trim($review[0]['comment']) ?>
                    </textarea>
                </div>

                <div class="form-group"> 
                    <label for="rating">Rating</label>
                    <input type="hidden" name="rating" id="halfstarsInput" placeholder= "Rating" class="form-control" value="<?php echo $review[0]['rating'] ?>">
                    

                <div  style="font-size: 2em;">
                    <div id="halfstarsReview"></div>
                </div>

                </div>
                <?php
                $images = get_review_images_by_id($review[0]['id']);
                $img = [];
                foreach ($images as $key => $value) {
                    $u_path = 'attachments/review_images/';
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
                    <label for="rating">Images</label>
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
                <label for="userfile">Upload image:</label>
                <input type="file" id="userfile" name="userfile[]" multiple>
            </div>
            <button type="submit" name="submit" class="btn btn-default">Edit</button>

        </form>
    </div>
</div>

<script type="text/javascript">
        $("#halfstarsReview").rating({
        "half": true,
        "click": function (e) {
            console.log(e);
            $("#halfstarsInput").val(e.stars);
        }
        });

        $(document).ready(function(){
            $("#halfstarsReview").rating({
                "half": true,
                "value": '<?php echo $review[0]['rating'] ?>'
            });
        });

        //products publish
        function removeDealImage(image, img_id) {

            var url = '<?php echo base_url(); ?>'+'admin/review/review/deleteImages';
            $.ajax({
                type: "POST",
                url: url,
                data: {image: image, img_id: img_id}
            }).done(function (data) {
                $('#image-container-' + img_id).remove();
            });
        } 
</script>