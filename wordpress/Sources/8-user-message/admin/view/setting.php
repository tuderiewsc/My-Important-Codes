
<div class="wrap hmum_setting">
	<h2>تنظمیات</h2>
	<?php

	check_admin_referer('hm-save-setting');

//            if( !isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'hm-save-setting') ) {
//                die('Error in security...');
//            }

	if ( isset( $_POST['hmum_setting_save'] ) ) {

		$hmum_settings = get_option('hmum_settings');

			//Include functions for sending message
		require ( HMUM_ADMIN_INC_DIR . 'functions.php' );

		$hmum_settings_new = array(
			'welcome_text' 				=> sanitize_text_field( $_POST['hmum_setting_welcome_message'] ),
			'inbox_header_background_color'	=> sanitize_hex_color( $_POST['hmum_setting_header_background_color'] ),
			'inbox_header_border_color'		=> sanitize_hex_color( $_POST['hmum_setting_header_border_color'] ),
			'inbox_header_text_color'		=> sanitize_hex_color( $_POST['hmum_setting_header_text_color'] ),
			'inbox_header_content'			=> strip_tags( $_POST['hmum_editor'], '<i><b><strong>'),
			'activation'					=> current_user_can('administrator') ? sanitize_text_field( $_POST['hmum_setting_active'] ) : $hmum_settings['activation']
		);

		update_option( 'hmum_settings', $hmum_settings_new );

	}

	$hmum_settings = get_option('hmum_settings');

	?>
	<form method="post" action="">
		<table class="form-table">
			<?php wp_nonce_field('hm-save-setting');?>
			<?php if(current_user_can('administrator')):?>
				<tr>
					<th scope="row">
						<label for="hmum_setting_active">رنگ بندی سرتیتر</label>
					</th>
					<td>
						فعال <input type="radio" name="hmum_setting_active" value="active" <?php echo checked($hmum_settings['activation'], 'active');?>> |
						غیر فعال <input type="radio" name="hmum_setting_active" value="inactive" <?php echo checked($hmum_settings['activation'], 'inactive');?>>
					</td>
				</tr>
			<?php endif;?>
			<tr>
				<th scope="row">
					<label for="hmum_setting_welcome_message">متن پیام خوش آمدگویی</label>
				</th>
				<td>
					<textarea class="widefat" name="hmum_setting_welcome_message" id="hmum_setting_welcome_message" cols="60" rows="6"><?php echo $hmum_settings['welcome_text'];?></textarea>
					<p class="description">
						زمانی که کاربر در سایت ثبت نام می کند این پیام بصورت خودکار از admin برای او ارسال می شود.
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hmum_setting_heading_preview">پیش نمایش سرتیتر</label>
				</th>
				<td>
					<div id="hmum_setting_heading_preview" class="description" style="color: <?php echo $hmum_settings['inbox_header_text_color'];?>; border-color: <?php echo $hmum_settings['inbox_header_border_color'];?>; background:<?php echo $hmum_settings['inbox_header_background_color'];?>">
						<?php echo str_replace( array('{hmum-unread}', '{hmum-total}'), array(5, 38), $hmum_settings['inbox_header_content'] );?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hmum_setting_heading_color">رنگ بندی سرتیتر</label>
				</th>
				<td>
					پس زمینه:
					<input type="Text" data-default-color="#D0D0D0" value="<?php echo $hmum_settings['inbox_header_background_color'];?>" name="hmum_setting_header_background_color" id="hmum_setting_heading_color" />
					حاشیه:
					<input type="Text" data-default-color="#E8EAE7" value="<?php echo $hmum_settings['inbox_header_border_color'];?>" name="hmum_setting_header_border_color" id="hmum_setting_header_border_color" />
					رنگ متن:
					<input type="Text" data-default-color="#000000" value="<?php echo $hmum_settings['inbox_header_text_color'];?>" name="hmum_setting_header_text_color" id="hmum_setting_header_text_color" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hmum_setting_heading_color">قالب متن سرتیتر</label>
				</th>
				<td>

					<?php
					$editor_id = "hmum_editor";
					wp_editor( $hmum_settings['inbox_header_content'], $editor_id, array(
						'wpautop'             => true,
				        'media_buttons'       => false,//Default true
				        'default_editor'      => '',
				        'drag_drop_upload'    => false,
				        'textarea_name'       => $editor_id,
				        'textarea_rows'       => 4,
				        'tabindex'            => '',
				        'tabfocus_elements'   => ':prev,:next',
				        'editor_css'          => '',
				        'editor_class'        => '',
				        'teeny'               => false,
				        'dfw'                 => false,
				        '_content_editor_dfw' => false,
				        'tinymce'             => true,
				        'quicktags'           => false,//default true
				      ));?>
				      <p class="description">
				      	از {hmum-unread} برای پسام های خوانده نشده و
				      	از {hmum-total} برای تعداد کل پیام های استفاده کنید.
				      </p>
				    </td>
				  </tr>
				  <tr>
				  	<th scope="row">
				  		<input type="submit" name="hmum_setting_save" value="ذخیره" class="button-primary">
				  	</th>
				  	<td>

				  	</td>
				  </tr>
				</table>
			</form>

		</div>

