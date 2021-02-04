jQuery(document).ready(function($){


	tinymce.PluginManager.add('hmsh_advanced_plugin', function(editor, url){
		editor.addButton('hmsh_advanced_plugin', {
			text    : 'TopMenu',
			icon    : false,
			type    : 'menubutton',
			menu    :[
			{
				text    : 'SubMenu 1',
				onclick : function(){
                        //editor.insertContent('This is content');
                        editor.selection.setContent('[user]' + editor.selection.getContent() + '[/user]');
                      }
                    },{
                    	text    : 'SubMenu 2',
                    	menu    : [
                    	{
                    		text    : 'sub submenu 1',
                    		onclick : function(){
                                ///
                              }
                            },{
                            	text    : 'sub submenu 2',
                            	menu    : [{
                            		text    : 'sub sub sbumenu 1',
                            		onclick : function(){
                                        //
                                      }
                                    },{
                                    	text    : 'sub sub sbumenu 2',
                                    	onclick : function(){
                                    //
                                  }
                                }]
                              }
                              ]
                            },{
                            	text    : 'Main Submenu',
                            	onclick : function(){
                            		editor.windowManager.open({
                            			title   : 'پست های اخیر',
                            			body    : [
                            			{
                            				type    : 'textbox',
                            				label   : 'عنوان',
                            				name    : 'hmsh_post_title',
                            				value   : 'آخرین پست ها',
                            			},{
                            				type    : 'textbox',
                            				label   : 'تعداد پست',
                            				name    : 'hmsh_post_count',
                            				value   : '5',
                            				size    : 60,
                            				style   : 'text-align: left; direction: ltr; color: red;'
                            			},{
                            				type    : 'checkbox',
                            				label   : 'نمایش تاریخ',
                            				name    : 'hmsh_post_date',
                            				value   : 'true'
                            			},{
                            				type    : 'textbox',
                            				label   : 'Testing textarea',
                            				name    : 'tstarea',
                            				multiline   : true,
                            				minHeight   : 100,
                            				minWidth    : 200
                            			}
                            			],
                            			onsubmit    : function(e){
                            				console.log(editor.selection.getContent());
                            				editor.insertContent('[recent-posts count=' + e.data.hmsh_post_count + ' show_date=' + e.data.hmsh_post_date + ']'+e.data.hmsh_post_title+'[/recent-posts]');
                            			}
                            		});
                            	}
                            }
                            ]
                          });
	});

});
