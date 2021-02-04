jQuery(document).ready(function($){
    tinymce.PluginManager.add('hmsh_recent_post', function(editor, url){
        
        editor.addButton('hmsh_recent_post', {
            text    : 'پست های اخیر',
            icon    : 'hmsh_recent_post',
            onclick : function(){
                //editor.insertContent('[recent-posts]');
                editor.selection.setContent('[user]' + editor.selection.getContent() + '[/user]');
            }
        });
        
    });
});