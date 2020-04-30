<h1><img src="<?= base_url('assets/imgs/blogger.png') ?>" class="header-img" style="margin-top:-2px;"> Review Posts By Product</h1>
<hr>
<?php if ($this->session->flashdata('result_publish')) { ?>
    <hr>
    <div class="alert alert-info"><?= $this->session->flashdata('result_publish') ?></div>
    <?php
}
?>
            <?php
            if ($reviews) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Deal</th>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Rating</th>
                                <th>Customer Id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($reviews as $row) {

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
                                        <?= get_deal_by_id($row['product_id'])[0]['title']; ?>
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
                                        <?= get_user_by_id($row['customer_id'])[0]['username']; ?>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="<?= base_url('admin/review/review/edit/' . $row['id']) ?>" class="btn btn-info">Edit</a>
                                            <a href="<?= base_url('admin/review/review/delete/' . $row['id']) ?>"  class="btn btn-danger confirm-delete">Delete</a>
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
