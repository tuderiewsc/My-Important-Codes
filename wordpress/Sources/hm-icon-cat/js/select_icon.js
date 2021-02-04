jQuery(document).ready(function ($) {

    $("#hmic_select_software_icon").click(function () {
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
    
    window.send_to_editor = function (html) {
        var fileurl;
        fileurl = $('img', html).attr('src');
        $("img.hmic_software_icon_img").attr('src', fileurl);
        $("input#hmic_software_icon").val(fileurl);
        tb_remove();
    };
    
    $("div#taxonomy-software img").click(function(){
        var term_slug = $(this).data('term-slug');
        $(this).closest('div').find('img').removeClass('selected');
        $(this).addClass('selected');
        $("#hmic_software_select_input").val(term_slug);
    });

});

