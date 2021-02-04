jQuery(document).ready(function($){
    $("input.upload_image_button").click(function(){
        var previewElement = $("div#hmaw_preview");
        window.send_to_editor = function(html){
            var imageUrl = $('img', html).attr('src');
            //console.log(imageUrl);
            //$("#hmaw_preview").text('test');
            $("input.hmaw_image_url").val(imageUrl);
            $(previewElement).html('<img src="' + imageUrl + '">');
            tb_remove();
        }
        
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
});