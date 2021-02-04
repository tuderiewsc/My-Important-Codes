jQuery(document).ready(function($){

    $('#hmpl_like').click(function(){
        
        var post_id = $(this).closest('div').data('post-id');
        var myDiv = $(this).closest('div');
        var mySpan = $(myDiv).find('span');
        
        $.ajax({
            type    : 'POST',
            url     : post_like_data.ajax_url,
            data    : {
                action  : 'hmpl_post_liked',
                post_id : post_id,
                _wpnonce: post_like_data._wpnonce
            },
            beforeSend: function (xhr) {
                $(myDiv).addClass('disable');
            },
            complete: function (jqXHR, textStatus) {
                $(myDiv).removeClass('disable');
            },
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                
                if (data == 0){
                    $(mySpan).html('You must login').css('color','red');
                    return;
                }
                
                if ( data.result == 'ok' ) {
                    $(mySpan).css('color','green').html(data.data);
                } else {
                    $(mySpan).html(data.data).css('color','red');
                }
                
            }
        });
    });
    
    
})
