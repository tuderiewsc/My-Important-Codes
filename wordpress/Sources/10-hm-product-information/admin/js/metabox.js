jQuery(document).ready(function($) {

    $("#hmpi-product-tab").tabs();
    
    $(document).on("click", ".hmpi-upload_image_button", function() {

        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            console.log(html);
            var imgurl = jQuery('img',html).attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');
			 
            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
                //$(inputText).closest('div')
                $('<p><input type="text" class="ltr" name="hmpi_product_gallery_image[]" style="width: 85%"><input type="button" value="افزودن تصویر" class="button-secondary hmpi-upload_image_button"></p>').appendTo($(inputText).closest('div'));
            }

            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

});
