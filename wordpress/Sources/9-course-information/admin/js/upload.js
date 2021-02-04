jQuery(document).ready(function($){
    
    $("#hmci_metabox_select_logo").click(function(){
        
        window.send_to_editor = function(html){
            var url = $('img', html).attr('src');
            console.log(url);
            $("#hmci_metabox_course_logo").val(url);
            tb_remove();
        }
        
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
    
});
