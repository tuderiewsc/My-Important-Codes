jQuery(document).ready(function($){

    $("#hmcl_upload_logo").click(function(){

        window.send_to_editor = function(html){
            var imgUrl = $('img', html).attr('src');
            $("#hmcl_custom_logo").val(imgUrl);
            tb_remove();
        }

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

    $("#hmcl_upload_bg").click(function(){
        var t = $(this);
        window.send_to_editor = function(html){
            var imgUrl = $('img', html).attr('src');
            $("#hmcl_custom_bg").val(imgUrl);
            $('<img src="' + imgUrl + '"/>').insertAfter(t);
            tb_remove();
        }

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

    $("#hmcl_custom_text_color, #hmcl_custom_form_color").wpColorPicker();

});