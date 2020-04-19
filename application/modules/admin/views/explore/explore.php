<h1><img src="<?= base_url('assets/imgs/blogger.png') ?>" class="header-img" style="margin-top:-2px;"> Explore List</h1>
<hr>
<?php if ($this->session->flashdata('result_publish')) { ?>
    <hr>
    <div class="alert alert-info"><?= $this->session->flashdata('result_publish') ?></div>
    <?php
}
?>
            <?php
            if ($explore) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Credit Url</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($explore as $row) {

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
                                    <td>
                                        <?= $row['title'] ?>
                                    </td>
                                    <td>
                                        <?= $row['message'] ?>
                                    </td>
                                    <td>
                                        <?= $row['credit_url'] ?>
                                    </td>
                                    <td>
                                        <?= $row['abbr'] ?>
                                    </td>

                                    <td style="text-align: center;"> 
                                        <div>
                                            <a href="<?= base_url('admin/explore/explore/edit/' . $row['id']) ?>" class="btn btn-info">Edit</a>
                                            <a href="<?= base_url('admin/explore/explore/delete/' . $row['id']) ?>" class="btn btn-danger confirm-delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class ="alert alert-info">No Review found!</div>
        <?php } ?>
