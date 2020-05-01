<?php
$timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-12">
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?>
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
            <?php
        }
        ?>
        <div class="content">
            <form class="form-box" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="<?= isset($_POST['folder']) ? $_POST['folder'] : $timeNow ?>" name="folder">
                <input type="hidden" value="<?= isset($_POST['expectation_folder']) ? $_POST['expectation_folder'] : $timeNow.'_s' ?>" name="expectation_folder">
                <div class="form-group available-translations">
                    <b>Languages</b>
                    <?php foreach ($languages as $language) { ?>
                        <button type="button" data-locale-change="<?= $language->abbr ?>" class="btn btn-default locale-change text-uppercase <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'active' : '' ?>">
                            <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                            <?= $language->abbr ?>
                        </button>
                    <?php } ?>
                </div>
                <?php
                $i = 0;
                foreach ($languages as $language) {
                    ?>
                    <div class="locale-container locale-container-<?= $language->abbr ?>" <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'style="display:block;"' : '' ?>>
                        <input type="hidden" name="translations[]" value="<?= $language->abbr ?>">
                        <div class="form-group">
                            <label><?= lang('vendor_package_name') ?> <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <input type="text" name="name[]" placeholder="<?= lang('vendor_package_name') ?>" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['name']) ? $trans_load[$language->abbr]['name'] : '' ?>" class="form-control">
                        </div>
                        <div class="form-group">
                          <label><?= lang('vendor_package_description') ?> <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                          <div class="form-group">
                              <textarea class="form-control" name="description[]" id="description<?= $i ?>"><?= $trans_load != null && isset($trans_load[$language->abbr]['description']) ? $trans_load[$language->abbr]['description'] : '' ?></textarea>
                          </div>
                          <script>
                              CKEDITOR.replace('description<?= $i ?>');
                              CKEDITOR.config.entities = false;
                          </script>
                        </div>
                        <div class="form-group">
                            <label for="expectation<?= $i ?>">Before Booking summary <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <textarea name="before_booking[]" id="before_booking<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['before_booking']) ? $trans_load[$language->abbr]['before_booking'] : '' ?></textarea>
                            <script>
                                CKEDITOR.replace('before_booking<?= $i ?>');
                                CKEDITOR.config.entities = false;
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="after_booking<?= $i ?>">After Booking summary <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <textarea name="after_booking[]" id="after_booking<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['after_booking']) ? $trans_load[$language->abbr]['after_booking'] : '' ?></textarea>
                            <script>
                                CKEDITOR.replace('after_booking<?= $i ?>');
                                CKEDITOR.config.entities = false;
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="cancellation_summary<?= $i ?>">Cancellation Policy summary <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <textarea name="cancellation_summary[]" id="cancellation_summary<?= $i ?>" rows="50" class="form-control"><?= $trans_load != null && isset($trans_load[$language->abbr]['cancellation_summary']) ? $trans_load[$language->abbr]['cancellation_summary'] : '' ?></textarea>
                            <script>
                                CKEDITOR.replace('cancellation_summary<?= $i ?>');
                                CKEDITOR.config.entities = false;
                            </script>
                        </div>
                        <div class="form-group for-shop">
                            <label>Price (Adult) <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <input type="text" name="price_adult[]" placeholder="without currency at the end" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['price_adult']) ? $trans_load[$language->abbr]['price_adult'] : '' ?>" class="form-control">
                        </div>
                        <div class="form-group for-shop">
                            <label>Price (Child) <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                            <input type="text" name="price_child[]" placeholder="without currency at the end" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['price_child']) ? $trans_load[$language->abbr]['price_child'] : '' ?>" class="form-control">
                        </div>
                      </div>
                    <?php
                    $i++;
                }
                ?>
                <div class="form-group for-shop">
                    <label>Experience</label>
                    <select class="selectpicker" name="experience_id">
                      <option> Select</option>
                      <?php foreach ($product_list as $value) { ?>
                        <option <?= isset($_POST['experience_id']) && $_POST['experience_id'] == $value->for_id ? 'selected' : '' ?> value="<?= $value->for_id; ?>"><?= $value->title; ?></option>
                      <?php } ?>
                    </select>
                </div>
        <!--        <div class="form-group for-shop">
                    <label>Credit Point For Review </label>
                    <input type="text" name="credit_point_for_review" placeholder="Credit Point For Review" value="<?php // @$_POST['credit_point_for_review'] ?>" class="form-control">
                </div>
                <div class="form-group for-shop">
                    <label>Credit Point For Booking </label>
                    <input type="text" name="credit_point_for_booking" placeholder="Credit Point For Booking" value="<?php// @$_POST['credit_point_for_booking'] ?>" class="form-control">
                </div>
                <div class="form-group for-shop">
                    <label>Deduct Max Points on Booking </label>
                    <input type="text" name="deduct_max_points_on_booking" placeholder="without currency at the end" value="<?php// @$_POST['deduct_max_points_on_booking'] ?>" class="form-control">
                </div>
                <div class="form-group for-shop">
                    <label>Is Point On Booking </label>
                    <select class="selectpicker" name="is_point_on_booking">
                        <option <?php// isset($_POST['is_point_on_booking']) && $_POST['is_point_on_booking'] == 'Not Applicable' ? 'selected' : '' ?> value="Not Applicable">Not Applicable</option>
                        <option <?php// isset($_POST['is_point_on_booking']) && $_POST['is_point_on_booking'] == 'Applicable' ? 'selected' : '' ?> value="Applicable">Applicable</option>
                    </select>
                </div> -->
                <div class="form-group for-shop">
                    <label>Number of Booking Available</label>
                    <input type="text" class="form-control" name="number_of_booking_available" placeholder="0 means not applicable" value="<?= @$_POST['number_of_booking_available'] ?>">
                </div>
                <div class="form-group for-shop">
                    <label>Cancellation Policy</label>
                    <select class="selectpicker" name="cancellation_policy">
                        <option <?= isset($_POST['cancellation_policy']) && $_POST['cancellation_policy'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['cancellation_policy']) && $_POST['cancellation_policy'] == 'No Cancellation' ? 'selected' : '' ?> value="No Cancellation">No Cancellation</option>
                        <option <?= isset($_POST['cancellation_policy']) && $_POST['cancellation_policy'] == 'Cancellation Free' ? 'selected' : '' ?> value="Cancellation Free">Cancellation Free</option>
                        <option <?= isset($_POST['cancellation_policy']) && $_POST['cancellation_policy'] == 'Free Cancellation after (certain hours Notice)' ? 'selected' : '' ?>
                          value="Free Cancellation after (certain hours Notice)">Free Cancellation after (certain hours Notice)</option>
                        <option <?= isset($_POST['cancellation_policy']) && $_POST['cancellation_policy'] == 'No Cancellation, Rescheduling is possible' ? 'selected' : '' ?>
                          value="No Cancellation, Rescheduling is possible">No Cancellation, Rescheduling is possible</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>How to Redeem Offer</label>
                    <select class="selectpicker" name="how_to_redeem_offer">
                        <option <?= isset($_POST['how_to_redeem_offer']) && $_POST['how_to_redeem_offer'] == 'Not Aplication' ? 'selected' : '' ?>
                          value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['how_to_redeem_offer']) && $_POST['how_to_redeem_offer'] == 'Show Mobile or Pinted Voucher' ? 'selected' : '' ?>
                          value="Show Mobile or Pinted Voucher">Show Mobile or Pinted Voucher</option>
                        <option <?= isset($_POST['how_to_redeem_offer']) && $_POST['how_to_redeem_offer'] == 'Show Printed Voucher' ? 'selected' : '' ?>
                          value="Show Printed Voucher">Show Printed Voucher</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Duration</label>
                    <select class="selectpicker" name="duration">
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '30 Minutes' ? 'selected' : '' ?> value="30 Minutes">30 Minutes</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '1 Hours' ? 'selected' : '' ?> value="1 Hours">1 hours</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '1 Hours 30 Minutes' ? 'selected' : '' ?> value="1 Hours 30 Minutes">1 Hours 30 Minutes</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '2 Hours' ? 'selected' : '' ?> value="2 Hours">2 Hours</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '2 Hours 30 Minutes' ? 'selected' : '' ?> value="2 Hours 30 Minutes">2 Hours 30 Minutes</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '3 Hours' ? 'selected' : '' ?> value="3 Hours">3 Hours</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '3 Hours 30 Minutes' ? 'selected' : '' ?> value="3 Hours 30 Minutes">3 Hours 30 Minutes</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '4 Hours' ? 'selected' : '' ?> value="4 Hours">4 Hours</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '4 Hours 30 Minutes' ? 'selected' : '' ?> value="4 Hours 30 Minutes">4 Hours 30 Minutes</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '5 Hours' ? 'selected' : '' ?> value="5 Hours">5 Hours</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '5 Hours 30 Minutes' ? 'selected' : '' ?> value="5 Hours 30 Minutes">5 Hours 30 Minutes</option>
                        <option <?= isset($_POST['duration']) && $_POST['duration'] == '6 Hours' ? 'selected' : '' ?> value="6 Hours">6 Hours</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Confirmation</label>
                    <select class="selectpicker" name="confirmation">
                        <option <?= isset($_POST['confirmation']) && $_POST['confirmation'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['confirmation']) && $_POST['confirmation'] == 'Instant Confirmation' ? 'selected' : '' ?> value="Instant Confirmation">Instant Confirmation</option>
                        <option <?= isset($_POST['confirmation']) && $_POST['confirmation'] == '24 Hours Confirmation' ? 'selected' : '' ?> value="24 Hours Confirmation">24 Hours Confirmation</option>
                        <option <?= isset($_POST['confirmation']) && $_POST['confirmation'] == '72 Hours Confirmation' ? 'selected' : '' ?> value="72 Hours Confirmation">72 Hours Confirmation</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Ticket Type</label>
                    <select class="selectpicker" name="ticket_type">
                        <option <?= isset($_POST['ticket_type']) && $_POST['ticket_type'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['ticket_type']) && $_POST['ticket_type'] == 'Open Date Ticket' ? 'selected' : '' ?> value="Open Date Ticket">Fixed Date Ticket</option>
                        <option <?= isset($_POST['ticket_type']) && $_POST['ticket_type'] == 'Redeemable within Fixed Period' ? 'selected' : '' ?> value="Redeemable within Fixed Period">Redeemable within Fixed Period</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Meeting Place</label>
                    <select class="selectpicker" name="meeting_place">
                        <option <?= isset($_POST['meeting_place']) && $_POST['meeting_place'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['meeting_place']) && $_POST['meeting_place'] == 'Meet up at Location' ? 'selected' : '' ?> value="Meet up at Location">Meet up at Location</option>
                        <option <?= isset($_POST['meeting_place']) && $_POST['meeting_place'] == 'Pick-Up Arrangement to be made' ? 'selected' : '' ?> value="Pick-Up Arrangement to be made">Pick-Up Arrangement to be made</option>
                        <option <?= isset($_POST['meeting_place']) && $_POST['meeting_place'] == 'Meet up with Guide' ? 'selected' : '' ?> value="Meet up with Guide">Meet up with Guide</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Experience Type</label>
                    <select class="selectpicker" name="experience_type">
                        <option <?= isset($_POST['experience_type']) && $_POST['experience_type'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['experience_type']) && $_POST['experience_type'] == 'Private Experience' ? 'selected' : '' ?> value="Private Experience">Private Experience </option>
                        <option <?= isset($_POST['experience_type']) && $_POST['experience_type'] == 'Join In Group' ? 'selected' : '' ?> value="Join In Group">Join In Group</option>
                        <option <?= isset($_POST['experience_type']) && $_POST['experience_type'] == 'Join In & Private Session Avaliable' ? 'selected' : '' ?> value="Join In & Private Session Avaliable">Join In & Private Session Avaliable</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Ticket Collection</label>
                    <select class="selectpicker" name="ticket_collection">
                        <option <?= isset($_POST['ticket_collection']) && $_POST['ticket_collection'] == 'Not Aplication' ? 'selected' : '' ?> value="Not Aplication">Not Aplication</option>
                        <option <?= isset($_POST['ticket_collection']) && $_POST['ticket_collection'] == 'Enter Directly With Voucher' ? 'selected' : '' ?> value="Enter Directly With Voucher">Enter Directly With Voucher</option>
                        <option <?= isset($_POST['ticket_collection']) && $_POST['ticket_collection'] == 'Collect Physical Copy' ? 'selected' : '' ?> value="Collect Physical Copy">Collect Physical Copy</option>
                        <option <?= isset($_POST['ticket_collection']) && $_POST['ticket_collection'] == 'Collect Physical Ticket/ Enter Directly with Voucher' ? 'selected' : '' ?> value="Collect Physical Ticket/ Enter Directly with Voucher">Collect Physical Ticket/ Enter Directly with Voucher</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Discount Available</label>
                    <select class="selectpicker" name="discount_available">
                        <option <?= isset($_POST['discount_available']) && $_POST['discount_available'] == 'Not Applicable' ? 'selected' : '' ?> value="Not Applicable">Not Aplication</option>
                        <option <?= isset($_POST['discount_available']) && $_POST['discount_available'] == 'Applicable' ? 'selected' : '' ?> value="Applicable">Applicable</option>
                    </select>
                </div>
                <div class="form-group for-shop">
                    <label>Package Available</label>
                    <select id="package_available" class="selectpicker" name="package_available_type">
                        <option <?= isset($_POST['package_available_type']) && $_POST['package_available_type'] == 'Specific Day' ? 'selected' : '' ?> value="Specific Day">specific Day</option>
                        <option <?= isset($_POST['package_available_type']) && $_POST['package_available_type'] == 'Time' ? 'selected' : '' ?> value="Time">Time</option>
                    </select>
               </div>
               <?php
                if(isset($_POST['package_available_type']) && $_POST['package_available_type'] != 'Specific Day'){
                         $style ='style="display:none;"';
                     }
                     else {
                       $style ='';
                     }
                 ?>
              <div id="specific_day" class="form-group for-shop"  <?= $style ?>>
                    <label>Available On Same Day</label>
                    <select class="selectpicker" name="specific_day" >
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Sunday' ? 'selected' : '' ?> value="Sunday">Sunday</option>
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Monday' ? 'selected' : '' ?> value="Monday">Monday</option>
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Tuesday' ? 'selected' : '' ?> value="Tuesday">Tuesday</option>
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Wednesday' ? 'selected' : '' ?> value="Wednesday">Wednesday</option>
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Thursday' ? 'selected' : '' ?> value="Thursday">Thursday</option>
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Friday' ? 'selected' : '' ?> value="Friday">Friday</option>
                        <option <?= isset($_POST['specific_day']) && $_POST['specific_day'] == 'Saturday' ? 'selected' : '' ?> value="Saturday">Saturday</option>
                    </select>
              </div>
              <?php if(isset($_POST['package_available_type']) && $_POST['package_available_type'] != 'Time'){
                        $style ='style="display:none;"';
                    }
                    else if(isset($_POST['package_available_type'])) {
                      $style ='';
                    }
                    else{
                      $style ='style="display:none;"';

                    }
                ?>
              <div id="time" class="form-group for-shop" <?= $style ?>>

              <div class="form-group bordered-group for-shop" >
                  <div class="multislot-container">

                      <?= $multislot ?>
                  </div>
                  <input type="hidden" name="slot_id_count" id="slot_id_count" value="<?= @$_POST['slot_id_count'] ?>">
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#modalmultislot" class="btn btn-default">Add Slot</a>
              </div>
              </div>
                <button type="submit" name="setPackage" class="btn btn-green"><?= lang('vendor_submit_package') ?></button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalmultislot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Slot</h4>
            </div>
            <div class="modal-body">
                <form id="ExpectationImagesForm">
                    <div class="form-group for-shop">
                      <p class="error_msg" style="color: red; display:none;">Please enter correct value</p>
                    </div>
                    <div class="form-group for-shop">
                      <label>Available on same date</label>
                    <div class="input-group date" data-provide="datepicker">
                      <input type="text" name="available_date" id="available_date" placeholder="Available on date" value="<?= @$_POST['available_date'] ?>" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                  </div>
                    <div class="form-group for-shop">
                        <label>Slot Time (Multi)</label>
                        <input type="text" name="slot_time" id="slot_time" placeholder="HH:MM" value="<?= @$_POST['slot_time'] ?>" class="form-control">
                    </div>
                    <div class="form-group for-shop">
                        <label>Total Slots </label>
                        <input type="text" name="total_slot" id="total_slot" placeholder="Number" value="<?= @$_POST['total_slot'] ?>" class="form-control">
                    </div>
                    <div class="form-group for-shop">
                        <label>Person Required per Slot</label>
                        <input type="text" placeholder="number" id="person_per_slot" name="person_per_slot" value="<?= @$_POST['person_per_slot'] ?>" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default finish-slot">
                    <span class="finish-text">Save</span>
                    <img src="<?= base_url('assets/imgs/load.gif') ?>" class="loadUploadOthers" alt="">
                </button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$('#package_available').change(function(){
  if($('#package_available').val()=="Specific Day"){
      $('#time').css('display', 'none');
      $('#specific_day').css('display', 'block');
  }
  else if ($('#package_available').val()=="Time") {
      $('#specific_day').css('display', 'none');
      $('#time').css('display', 'block');
  }
});
$('.date').datepicker({
    startDate: new Date()
});
</script>
<style>
.slot_class td{
  padding: 15px;
}
.slot_class button{
  color: red;
}
.slot_class input{
      background-color: #F2F4F4;
}
</style>
