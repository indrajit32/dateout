<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= base_url('assets/js/rating.js') ?>"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

<h1><img src="<?= base_url('assets/imgs/blogger.png') ?>" class="header-img" style="margin-top:-2px;"> Publish explore</h1>
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
                <div class="form-group available-translations">
                    <b>Languages</b>
                    <?php foreach ($languages as $language) { ?>
                        <button type="button" data-locale-change="<?= $language->abbr ?>" onclick="myFunction('<?= $language->abbr ?>')">
                            <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                            <?= $language->abbr ?>
                        </button>
                    <?php } ?>
                </div>
            </div>

                <div class="form-group"> 
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder= "Review Title" class="form-control">

                    <input type="hidden" name="lang" id="lang">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" placeholder= "message"  rows="5" class="form-control">

                    </textarea>
                </div>

                <div class="form-group">
                    <label for="explore">Upload explore image:</label>
                    <input type="file" id="explore" name="explore[]" multiple>
                </div>

                <div class="form-group"> 
                    <label for="title">Credit Url</label>
                    <input type="text" name="credit_url" placeholder= "Review Title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="credit">Upload credit image:</label>
                    <input type="file" id="credit" name="credit" >
                </div>

            <button type="submit" name="submit" class="btn btn-default">Publish</button>
        </form>
    </div>
</div>

<script type="text/javascript">

    function myFunction(lang){
        $('#lang').val(lang);
    }

    $(document).ready(function(){
        $('#lang').val('en');
    });

</script>