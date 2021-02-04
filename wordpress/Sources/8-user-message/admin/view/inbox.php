<?php
$hmum_isInbox = $_GET['page'] === 'hmum_user_message_inbox' ? true : false;
$hmum_pageHeading = $hmum_isInbox ? 'پیام های دریافتی' : 'پیام های ارسالی'
?>
<div class="wrap hmum_inbox">
	<h2><?php echo $hmum_pageHeading;?></h2>

	<?php

	if (isset($_GET['action']) && isset($_GET['message_id']) && $_GET['action'] === 'delete' && current_user_can('administrator') ){
		if ( !isset($_GET['_wpnonce']) ||  !wp_verify_nonce($_GET['_wpnonce'], 'hm-delete-url-') ) {
			wp_die('Error in Security');
		}

		global $wpdb;
		$Mytable = $wpdb->prefix . 'user_message';
		$wpdb->delete($Mytable, array('id' => $_GET['message_id']), '%d');

	}



		//Include functions for sending message
	require ( HMUM_ADMIN_INC_DIR . 'functions.php' );

	global $hmum_settings;

	?>
	<div class="description" style="color: <?php echo $hmum_settings['inbox_header_text_color'];?>; border-color: <?php echo $hmum_settings['inbox_header_border_color'];?>; background:<?php echo $hmum_settings['inbox_header_background_color'];?>">
		<?php
		echo str_replace( array( '{hmum-total}', '{hmum-unread}'), array(hmum_get_inbox_message_count($hmum_isInbox), hmum_get_inbox_message_count( $hmum_isInbox, true )), $hmum_settings['inbox_header_content'])
		?>
	</div>

	<?php if ( isset($_GET['action']) && isset($_GET['message_id']) && $_GET['action'] === 'read' ):?>
	<?php

	if ( $hmum_read_message = hmum_get_message( $_GET['message_id'] ) ) :
		?>
		<div class="hmum_message_conversation">
			<p class="hmum_subject">
				موضوع پیام: <?php echo $hmum_read_message->subject; ?>
			</p>
			<p class="hmum_author">
				<?php
				if ( $hmum_isInbox ) {
					echo 'از طرف: ' . hmum_get_user_name( $hmum_read_message->from_user ) ;
				} else {
					echo ' به: ' . hmum_get_user_name( $hmum_read_message->to_user );
				}
				echo ' در '. hmum_convert_date( $hmum_read_message->sent_at ) . hmum_parse_date( $hmum_read_message->sent_at );
				?>
			</p>
			<p class="hmum_body">
				متن پیام:<br>
				<?php echo strip_tags( nl2br( $hmum_read_message->message ), '<br></br><br />' );?>
			</p>
		</div>
		<?php
		hmum_set_message_as_read( $hmum_read_message->id );
	endif;

	else:?>
		<table class="widefat">
			<thead>
				<tr>
					<th>ردیف</th>
					<th>عنوان پیام</th>
					<th><?php echo $hmum_isInbox ? 'فرستنده' : 'گیرنده';?></th>
					<th><?php echo $hmum_isInbox ? 'تاریخ دریافت' : 'تاریخ ارسال';?></th>
					<th>نوع پیام</th>
					<th>وضعیت</th>
					<th>عملیات</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ردیف</th>
					<th>عنوان پیام</th>
					<th><?php echo $hmum_isInbox ? 'فرستنده' : 'گیرنده';?></th>
					<th><?php echo $hmum_isInbox ? 'تاریخ دریافت' : 'تاریخ ارسال';?></th>
					<th>نوع پیام</th>
					<th>وضعیت</th>
					<th>عملیات</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				if ( $messages = hmum_get_messages( !$hmum_isInbox ) ){
					$count = 1;
					foreach( $messages as $message):
						?>
						<tr>
							<td><?php echo $count;?></td>
							<td><a href="<?php echo admin_url ( 'admin.php?page=hmum_user_message_' . ($hmum_isInbox ? 'inbox' : 'sent') . '&action=read&message_id=' . $message->id);?>"><?php echo $message->subject;?></a></td>
							<td><?php echo $hmum_isInbox ? hmum_get_user_name($message->from_user) : hmum_get_user_name($message->to_user);?></td>
							<td><?php echo hmum_convert_date( $message->sent_at  ) . hmum_parse_date( $message->sent_at );?></td>
							<td><?php echo $message->type == 1 ? 'معمولی' : 'فوری';?></td>
							<td><?php echo $message->is_read ? '<span style="color: green">خوانده شده</span>' : '<span style="color: red">خوانده نشده</span>';?></td>
							<!--<td><a href="<?php echo admin_url ( 'admin.php?page=hmum_user_message_' . ($hmum_isInbox ? 'inbox' : 'sent') . '&action=delete&message_id=' . $message->id . '&_wpnonce=' . wp_create_nonce( 'hm-message-delete' ) );?>" onclick="return confirm('برای حذف پیام مطمئن هستید؟')">حذف پیام</a></td>-->
							<td>
								<?php
								$urlQuery = add_query_arg(array(
									'page'          => 'hmum_user_message_' . ($hmum_isInbox ? 'inbox' : 'sent'),
									'action'        => 'delete',
									'message_id'    => $message->id
								));
								$noncedUrl = wp_nonce_url($urlQuery, 'hm-delete-url');
								?>
								<a href="<?php echo $noncedUrl;?>" onclick="return confirm('are you sure for delete?')">حذف</a>
							</td>
						</tr>
						<?php
						$count++;
					endforeach;
				} else {
					echo '<tr><td colspan="6">پیامی برای نمایش وجود ندارد.</td></tr>';
				}
				?>
			</tbody>
		</table>
	<?php endif;?>
</div>
