//Script for color picker
jQuery(document).ready(function($){
	
	$('#hmum_setting_heading_color, #hmum_setting_header_border_color, #hmum_setting_header_text_color')
	.wpColorPicker({
		width: 400,
		palettes: ['#F00', '#459', '#78b', '#ab0', '#de3', '#f0f'],
		border: false,
		change: function(event, ui) {
	        // event = standard jQuery event, produced by whichever control was changed.
	        // ui = standard jQuery UI object, with a color member containing a Color.js object
	 
	        // change the headline color
	        
	        var selId = $(event.target).attr('id');

	        //console.log(selId);
	        
	        if ( selId == 'hmum_setting_heading_color' ) {
	        	$("#hmum_setting_heading_preview").css( 'background-color', ui.color.toString());
	        } else if ( selId == 'hmum_setting_header_border_color' ) {
	        	$("#hmum_setting_heading_preview").css( 'border-color', ui.color.toString());
	        } else {
	        	$("#hmum_setting_heading_preview").css( 'color', ui.color.toString());
	        }

	    }
	});
	
});