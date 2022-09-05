(function($){
    "use strict";

    // IMAGE UPLOADING :)
    $(".upload-photo").on( "change", function(e) {
        var path = $('.admin-image-preview');
        readURL(this,path);
    });

    $(".upload-photo2").on( "change", function(e) {
        var path = $('.admin-image-preview2');
        readURL(this,path);
    });

    $(".upload-photo3").on( "change", function(e) {
        var path = $('.admin-image-preview3');
        readURL(this,path);
    });

    $(".upload-photo4").on( "change", function(e) {
        var path = $('.admin-image-preview4');
        readURL(this,path);
    });

    $(".upload-photo5").on( "change", function(e) {
        var path = $('.admin-image-preview5');
        readURL(this,path);
    });

    $(".upload-photo6").on( "change", function(e) {
        var path = $('.admin-image-preview6');
        readURL(this,path);
    });

    $(".upload-photo7").on( "change", function(e) {
        var path = $('.admin-image-preview7');
        readURL(this,path);
    });

    $(".upload-photo8").on( "change", function(e) {
        var path = $('.admin-image-preview8');
        readURL(this,path);
    });

    function readURL(input,path) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            path.attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Tagify
    if( $('.tags').length > 0 ) {
        $('.tags').tagify();
    }

    // Slug
    $('.item-name').on('keyup', function(){
        let str = $(this).val().replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'-').replace(/ /g, '-');

        $('#slug').val(str)
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('action', $(e.relatedTarget).data('href'));
    });

    $(document).on('click',".delete-record", function() {
        Swal.fire({
            title: $(this).data('title'),
            text: $(this).data('text'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: $(this).data('ok_btn'),
            cancelButtonText: $(this).data('cancel_btn')
            })
            .then((result) => {
                if (result.value) {
                    window.location = $(this).data('href');
                }
        });
    });

    // Action Alert
    $(document).on('click',".confirm-action", function() {
        Swal.fire({
            title: $(this).data('title'),
            text: $(this).data('text'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: $(this).data('ok_btn'),
            cancelButtonText: $(this).data('cancel_btn')
            })
            .then((result) => {
                if (result.value) {
                    window.location = $(this).data('href');
                }
        });
    });

    // Datatable
    $('#admin-table').DataTable({
        language: {
                search: "",
                searchPlaceholder: "Searh here...",
                lengthMenu:     "_MENU_",
        },
        responsive: true,
        ordering: false
    });

      //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // Get Subcategory on-change of category dropwdown menu
    $(document).on('change', '#category_id', function(){
        let category_id = $(this).val();
        let url = $(this).attr('data-href');
        getSubCategories(url, category_id);
    });

     // Summernote
     $('.summernote').summernote()

     // Hide Show Specific Fields on-change of checkbox in item form
     $('#is_specification').on('change',function(){
         if(this.checked){
             $("#specifications-section").removeClass('d-none');
         }else{
             $('#specifications-section').addClass('d-none');
         }
     });

    // Append specification to item form
    $(document).on('click', '.add-specification', function(){
        var text = $(this).data('text');
        var text1 = $(this).data('text1');
        $('#specifications-section').append(`
            <div class="row">
            <div class="form-group  col-md-5">
                <input type="text" name='specification_name[]' class='form-control' placeholder="${text}" value="">
            </div>

            <!-- /.col-lg-6 -->
            <div class="form-group  col-md-6">
                <input type="text" name='specification_description[]' class='form-control' placeholder="${text1}" value="">
            </div>
            <!-- /.col-lg-6 -->

            <div class="form-group  col-md-1">
                <button type="button" class="btn btn-danger btn-md remove-specification"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        `);
    });

    $(document).on('click','.remove-specification',function(){
        $(this).parent().parent().remove();
    });

    // Append License to item form
    $(document).on('click', '.add-license', function(){
        var text = $(this).data('text');
        var text1 = $(this).data('text1');
        $('#license-section').append(`
            <div class="row">
            <div class="form-group  col-md-5">
                <input type="text" name='license_name[]' class='form-control' placeholder="${text}" value="">
            </div>

            <!-- /.col-lg-6 -->
            <div class="form-group  col-md-6">
                <input type="text" name='license_key[]' class='form-control' placeholder="${text1}" value="">
            </div>
            <!-- /.col-lg-6 -->

            <div class="form-group  col-md-1">
                <button type="button" class="btn btn-danger btn-md remove-license"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        `);
    });

    $(document).on('click','.remove-license',function(){
        $(this).parent().parent().remove();
    });

    $('#attr_name').on('keyup',function(){
        var text = $(this).val();
        var str = text.replace(/\ /g, "-");
        $('#attr_keyword').val(str.toLowerCase());
    });

    // bulk delete start
    $(document).on('change','.bulk_all_delete',function(){
        let target = $(this).attr('data-target');
        if($(this).is(':checked')){
            $('#'+target+' .bulk-item').prop('checked',true);
        }else{
            $('#'+target+' .bulk-item').prop('checked',false);
        }

        bulk_select(target);
    });

    $(document).on('change','#product-bulk-delete input.bulk-item',function(){
        bulk_select('product-bulk-delete');
    })

    $(document).on('change','#transaction-bulk-delete input.bulk-item',function(){
        bulk_select('transaction-bulk-delete');
    })
    $(document).on('change','#order-bulk-delete input.bulk-item',function(){
        bulk_select('order-bulk-delete');
    })
    $(document).on('change','#blog-bulk-delete input.bulk-item',function(){
        bulk_select('blog-bulk-delete');
    })

    // Notification

    $(document).on('click', '#clear-notification', function(){
        $.get($(this).data('href'), function(){
            window.location.reload()
        });
    });

    function bulk_select(target){
        var selected = [];
        $('#'+target+' input:checked').each(function() {
            selected.push($(this).val());
        });
        $('#bulk_delete').val(selected);

    }

    //Date picker
    $('.date-picker').datetimepicker({
        format: 'L'
    });

    $('.date-picker1').datetimepicker({
        format: 'L'
    });

    // Social Picker
    if( $('.social-picker').length > 0 ){
        $('.social-picker').iconpicker();
    }

    // Append specification to item form
    $(document).on('click', '.add-social', function(){
        var text = $(this).data('text');
        $('#icon-picket-section').append(`
            <div class="row">
            <div class="form-group  col-md-2">
                <button class="btn btn-primary social-picker " name="social_icons[]" data-icon="fab fa-font-awesome"></button>
            </div>

            <!-- /.col-lg-6 -->
            <div class="form-group  col-md-9">
                <input type="text" name='social_links[]' class='form-control' placeholder="${text}" value="">
            </div>
            <!-- /.col-lg-6 -->

            <div class="form-group  col-md-1">
                <button type="button" class="btn btn-danger btn-md remove-social"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        `);
        $('.social-picker').iconpicker();
    });

    $(document).on('click','.remove-social',function(){
        $(this).parent().parent().remove();
    });


    // Timepicker
    $('.timepicker').datetimepicker({
        format: 'LT'
    })

    // Popular Category Script
    $(document).on('change', '#category_id1, #category_id2, #category_id3, #category_id4', function(){
        let category_id = $(this).val();
        let countNumber = '';
        let catId = $(this).attr('id');
        countNumber = catId.slice(countNumber.length - 1);
        let url = $(this).attr('data-href');
    });

    $(document).on('change', '#subcategory_id1, #subcategory_id2, #subcategory_id3, #subcategory_id4', function(){
        let subcategory_id = $(this).val();
        let countNumber = '';
        let catId = $(this).attr('id');
        countNumber = catId.slice(countNumber.length - 1);
        let url = $(this).attr('data-href');
    });

    // Two Column Category Script
    $(document).on('change', '#column_category_id1, #column_category_id2', function(){
        let category_id = $(this).val();
        let countNumber = '';
        let catId = $(this).attr('id');
        countNumber = catId.slice(countNumber.length - 1);
        let url = $(this).attr('data-href');
        columnGetSubCategory(url, category_id, countNumber);
    });

    function columnGetSubCategory(url, subcategory_id, count) {
        $.get(url + '?category_id=' + subcategory_id, function(data) {
            let response = data.data;
            let view_html = `<option value="" >Select One</option>`;
            $.each(response, function(key, value) {
                view_html += `<option value="${value.id}">${value.name}</option>`;
            });
            $('#cloumn_subcategory_id' + count).html(view_html);
        });
    }

    $(document).on('change', '#cloumn_subcategory_id1, #cloumn_subcategory_id2', function(){
        let subcategory_id = $(this).val();
        let countNumber = '';
        let catId = $(this).attr('id');
        countNumber = catId.slice(countNumber.length - 1);
        let url = $(this).attr('data-href');
        columnGetChildCategory(url, subcategory_id, countNumber);
    });

    function columnGetChildCategory(url, subcategory_id, count) {
        $.get(url + '?subcategory_id=' + subcategory_id, function(data) {
            let response = data.data;
            let view_html = `<option value="" >Select One</option>`;
            $.each(response, function(key, value) {
                view_html += `<option value="${value.id}">${value.name}</option>`;
            });
            $('#cloumn_childcategory_id' + count).html(view_html);
        });
    }

    // Feature Category Script
    $(document).on('change', '#feature_category_id1, #feature_category_id2, #feature_category_id3, #feature_category_id4', function(){
        let category_id = $(this).val();
        let countNumber = '';
        let catId = $(this).attr('id');
        countNumber = catId.slice(countNumber.length - 1);
        let url = $(this).attr('data-href');
        featureGetSubCategory(url, category_id, countNumber);
    });

    function featureGetSubCategory(url, subcategory_id, count) {
        $.get(url + '?category_id=' + subcategory_id, function(data) {
            let response = data.data;
            let view_html = `<option value="" >Select One</option>`;
            $.each(response, function(key, value) {
                view_html += `<option value="${value.id}">${value.name}</option>`;
            });
            $('#feature_subcategory_id' + count).html(view_html);
        });
    }

    $(document).on('change', '#feature_subcategory_id1, #feature_subcategory_id2, #feature_subcategory_id3, #feature_subcategory_id4', function(){
        let subcategory_id = $(this).val();
        let countNumber = '';
        let catId = $(this).attr('id');
        countNumber = catId.slice(countNumber.length - 1);
        let url = $(this).attr('data-href');
        featureGetChildCategory(url, subcategory_id, countNumber);
    });

    function featureGetChildCategory(url, subcategory_id, count) {
        $.get(url + '?subcategory_id=' + subcategory_id, function(data) {
            let response = data.data;
            let view_html = `<option value="" >Select One</option>`;
            $.each(response, function(key, value) {
                view_html += `<option value="${value.id}">${value.name}</option>`;
            });
            $('#feature_childcategory_id' + count).html(view_html);
        });
    }

    // Email SMTP Checkbox
    $(document).on('change', '.email_smtp_check', function(){
        let smtp_check = $(this).attr('checked');
        console.log(smtp_check);
    });
    $(function () {
        $(".email_smtp_check").click(function () {
            if ($(this).is(":checked")) {
                $(".email_smtp_row").removeClass("d-none");
            } else {
                $(".email_smtp_row").addClass("d-none");
            }
        });
    });


    // flash deal item select date
    $(document).on('change', '#is_type', function(){
        if ($(this).val() == 'flash_deal') {
            $('.show-datepicket').removeClass('d-none');
            $('input .flash-deal-datepicker').prop('required', true);
        } else {
            $('.show-datepicket').addClass('d-none');
            $('input .flash-deal-datepicker').val('');
            $('input .flash-deal-datepicker').prop('required', false);
        }
    });

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    mode: "htmlmixed",
    theme: "monokai"
    });

})(jQuery);
