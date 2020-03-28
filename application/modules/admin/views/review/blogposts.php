<h1><img src="<?= base_url('assets/imgs/blogger.png') ?>" class="header-img" style="margin-top:-2px;"> Review Posts</h1>
<hr>
<?php if ($this->session->flashdata('result_publish')) { ?>
    <hr>
    <div class="alert alert-info"><?= $this->session->flashdata('result_publish') ?></div>
    <?php
}
?>
<div class="row">
    <div class="col-sm-6">
        <form method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="<?= @$_GET['search'] ?>" placeholder="Find here">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Search</button>
                </span>
            </div>
            <?php if (isset($_GET['search'])) { ?>
                <a href="<?= base_url('admin/blog') ?>">Clear search</a>
            <?php } ?>
        </form>
    </div>
</div>
<hr>
            <?php
            if ($posts) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Id</th>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Rating</th>
                                <th>Customer Id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($posts as $row) {

                                /*
                                $u_path = 'attachments/shop_images/';
                                if ($row->image != null && file_exists($u_path . $row->image)) {
                                    $image = base_url($u_path . $row->image);
                                } else {
                                    $image = base_url('attachments/no-image.png');
                                }
                                */
                                ?>

                                <tr>
                                    <!--<td>
                                        <img src="<?= $image ?>" alt="No Image" class="img-thumbnail" style="height:100px;">
                                    </td> -->
                                    <td>
                                        <?= $row['product_id'] ?>
                                    </td>
                                    <td>
                                        <?= $row['title'] ?>
                                    </td>
                                    <td>
                                        <?= $row['comment'] ?>
                                    </td>
                                    <td>
                                        <?= $row['rating'] ?>
                                    </td>
                                    <td>
                                        <?= $row['customer_id'] ?>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="<?= base_url('admin/review/review/view_all_review_by_product/' . $row['product_id']) ?>" class="btn btn-info">View Details</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?= $links_pagination ?>
            </div>
            <?php
        } else {
            ?>
            <div class ="alert alert-info">No Review found!</div>
        <?php } ?>
<?= $links_pagination ?>
