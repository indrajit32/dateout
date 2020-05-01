$(document).ready(function () {
    // lets give 'active' class to choosed link from nav
    $(".left-side ul li").each(function (index) {
        var currentUrl = window.location.href;
        var urlOfLink = $(this).find('a').attr('href');
        currentUrl = currentUrl.split('?')[0];//remove if contains GET
        if (currentUrl == urlOfLink) {
            $(this).addClass('active');
        }
    });
});

// Upload Expectation Images on publish product
$('.finish-expectation').click(function () {
    $('.finish-expectation .finish-text').hide();
    $('.finish-expectation .loadUploadOthers').show();
    var someFormElement = document.getElementById('ExpectationImagesForm');
    var formData = new FormData(someFormElement);
    $.ajax({
        url: urls.uploadExpectationImages,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data)
        {
            $('.finish-upload .finish-text').show();
            $('.finish-upload .loadUploadOthers').hide();
            reloadExpectationsImagesContainer();
            $('#modalExpectationImages').modal('hide');
            document.getElementById("ExpectationImagesForm").reset();
        }
    });
});

// Upload More Images on publish product
$('.finish-upload').click(function () {
    $('.finish-upload .finish-text').hide();
    $('.finish-upload .loadUploadOthers').show();
    var someFormElement = document.getElementById('uploadImagesForm');
    var formData = new FormData(someFormElement);
    $.ajax({
        url: urls.uploadOthersImages,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data)
        {
            $('.finish-upload .finish-text').show();
            $('.finish-upload .loadUploadOthers').hide();
            reloadOthersImagesContainer();
            $('#modalMoreImages').modal('hide');
            document.getElementById("uploadImagesForm").reset();
        }
    });
});

$('.orders-page .show-more').click(function () {
    var tr_id = $(this).data('show-tr');
    $('table').find('[data-tr="' + tr_id + '"]').toggle(function () {
        if ($('[data-tr="' + tr_id + '"]').is(':visible')) {
            $('.orders-page .fa-chevron-up').show();
            $('.orders-page .fa-chevron-down').hide();
        } else {
            $('.orders-page .fa-chevron-up').hide();
            $('.orders-page .fa-chevron-down').show();
        }
    });

});

$('.change-ord-status').change(function () {
    var the_id = $(this).data('ord-id');
    var to_status = $(this).val();

    $.post(urls.changeVendorOrdersOrderStatus, {the_id: the_id, to_status: to_status}, function (data) {
        if (data == '0') {
            alert('Error with status change. Please check logs!');
        }
    });
});

$(".change-package-type-form").change(function () {
    $('#searchPackagesForm').submit();
});

$('.locale-change').click(function () {
    var toLocale = $(this).data('locale-change');
    $('.locale-container').hide();
    $('.locale-container-' + toLocale).show();
    $('.locale-change').removeClass('active');
    $(this).addClass('active');
});

function reloadOthersImagesContainer() {
    $('.others-images-container').empty();
    $('.others-images-container').load(urls.loadOthersImages, {"folder": $('[name="folder"]').val()});
}

function reloadExpectationsImagesContainer() {
    $('.expectation-images-container').empty();
    $('.expectation-images-container').load(urls.loadExpectationsImages, {"expectation_folder": $('[name="expectation_folder"]').val()});
}

//products publish
function removeSecondaryProductImage(image, folder, container) {
    $.ajax({
        type: "POST",
        url: urls.removeSecondaryImage,
        data: {image: image, folder: folder}
    }).done(function (data) {
        $('#image-container-' + container).remove();
        reloadExpectationsImagesContainer();
    });
}

function removeSecondaryExpectationsImage(image, folder, container) {
    $.ajax({
        type: "POST",
        url: urls.removeSecondaryExpectationsImage,
        dataType : "json",
        data: {image: image, folder: folder}
    }).done(function (data) {
        $('#image-container-' + container).remove();
        reloadExpectationsImagesContainer();
    });
}

$(".showSliderDescrption").click(function () {
    var desc_id = $(this).data('descr');
    $("#theSliderDescrption-" + desc_id).slideToggle("slow", function () {});
});

$('.finish-slot').click(function () {
  var available_date = $('#available_date').val();
  var slot_time = $('#slot_time').val();
  var total_slot = $('#total_slot').val();
  var person_per_slot = $('#person_per_slot').val();
  if(slot_time=='' || total_slot=='' || person_per_slot==''){
    $('.error_msg').css('display', 'block');
  }
  else{
    $('.finish-slot .finish-text').hide();
    $('.finish-slot .loadUploadOthers').show();
    var count = parseInt($('#slot_id_count').val());
    count = count+1;

    var str = "<table id='table_"+count+"' class='slot_class bordered-group'><tr><td>Available Date:</td><td><input type='text' class='form-control' name='available_date[]' readonly value='"+available_date+"'></td><td>Time:</td><td><input type='text' class='form-control' name='slot_time[]' readonly value='"+slot_time+"'></td><td>Total Slot:</td><td><input type='text' class='form-control' name='total_slot[]' readonly value='"+total_slot+"'></td><td>Person per Slot:</td><td><input type='text' class='form-control' name='person_per_slot[]' readonly value='"+person_per_slot+"'></td><td><button onclick='removeslot("+count+")'>X</button></td></tr></table>";
    $('.multislot-container').append(str);
    $('#slot_id_count').val(count);
    $('#ExpectationImagesForm')[0].reset();
    $('.finish-slot .loadUploadOthers').hide();
    $('.finish-slot .finish-text').show();
    $('#modalmultislot').modal('hide');
  }
});

function removeslot(id){
  $('#table_'+id).remove();
  var count = parseInt($('#slot_id_count').val());
  count = count-1;
  $('#slot_id_count').val(count);
}
