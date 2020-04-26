<div id="products">
    <?php
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_publish')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <hr>
        <?php
    }
    ?>
    <h1><img src="<?= base_url('assets/imgs/products-img.png') ?>" class="header-img" style="margin-top:-2px;"> Package List</h1>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="well hidden-xs">
                <div class="row">
                    <form method="GET" id="searchPackagesForm" action="">
                        <div class="col-sm-4">
                            <label>Order:</label>
                            <select name="order_by" class="form-control selectpicker change-package-type-form">
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'id=desc' ? 'selected=""' : '' ?> value="id=desc">Newest</option>
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'id=asc' ? 'selected=""' : '' ?> value="id=asc">Latest</option>
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'price_adult=asc' ? 'selected=""' : '' ?> value="price_adult=asc">Low price</option>
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'price_adult=desc' ? 'selected=""' : '' ?> value="price_adult=desc">High Price</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Experience Title:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Product Title" type="text" value="<?= isset($_GET['search_title']) ? $_GET['search_title'] : '' ?>" name="search_title">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" value="">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Package Type:</label>
                            <select name="package_type" class="form-control selectpicker change-package-type-form">
                                <option value="">None</option>
                                <option <?php if(isset($_GET['package_type']) && $_GET['package_type']=='Specific Day'){ echo 'selected'; } ?> value="Specific Day">Specific Day</option>
                                <option <?php if(isset($_GET['package_type']) && $_GET['package_type']=='Time'){ echo 'selected'; } ?> value="Time">Time</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <?php
            if ($packages) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Experience</th>
                                <th>Vendor</th>
                                <th>Price Adult</th>
                                <th>Price Child</th>
                                <th>Package Type</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($packages as $row) {
                            ?>

                                <tr>
                                    <td>
                                        <?= $row->name ?>
                                    </td>
                                    <td>
                                        <?= $row->title ?>
                                    </td>
                                    <td>
                                        <?= $row->vendor_name ?>
                                    </td>
                                    <td>
                                        <?= $row->price_adult ?>
                                    </td>
                                    <td><?= $row->price_child ?></td>
                                    <td><?= $row->package_available_type ?></td>
                                    <td>
                                        <div class="pull-right">
                                            <a href="<?= base_url('vendor/edit/package/' . $row->id) ?>" class="btn btn-info">Edit</a>
                                            <a href="<?= base_url('vendor/package_list?delete=' . $row->id) ?>"  class="btn btn-danger confirm-delete">Delete</a>
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
            <div class ="alert alert-info">No products found!</div>
        <?php } ?>
    </div>
