<div class="wrap hmum_new">
	<h2>ارسال پیام جدید</h2>
	<?php

		//check if send button pressed
		if ( isset( $_POST['hmum_new_send'] ) ) {

			//Include functions for sending message
			require ( HMUM_ADMIN_INC_DIR . 'functions.php' );

			//get current user id (Sender)
			$hmum_from_user = get_current_user_id();

			//get destinaction user id if exists
			if ( $hmum_to_user = hmum_get_user_ID ( esc_html ( $_POST['hmum_new_to'] ) ) ) {

				if ( $hmum_from_user == $hmum_to_user ) {
					$hmum_status = 'fail';
					$hmum_message = 'امکان ارسال پیام به خودتان میسر نیست.';
				} else {

					$hmum_message_data = array(
						'from'		=> $hmum_from_user,
						'to'		=> $hmum_to_user,
						'subject'	=> esc_html($_POST['hmum_new_subject']),
						'type'		=> in_array($hmum_type = absint($_POST['hmum_new_status']), array(1, 2)) ? $hmum_type : 1,
						'message'	=> esc_html( $_POST['hmum_new_message'] ) ,
					);

					if ( hmum_send_message ( 
							$hmum_message_data['from'],
							$hmum_message_data['to'],
							$hmum_message_data['subject'],
							$hmum_message_data['type'],
							$hmum_message_data['message']
							) ) {

						$hmum_status = 'success';
						$hmum_message = 'پیام شما با موفقیت ارسال شد.';

					}
				}

			} else {
				$hmum_status = 'fail';
				$hmum_message = 'آدرس شما وجود ندارد';
			}

			if ( isset($hmum_status) && isset($hmum_message) ) {
				
				echo '<div class="hmum-status-' . $hmum_status . '" style="background-image: url(' . HMUM_ADMIN_IMAGES_URL .  $hmum_status . '.png)" >' . $hmum_message . '</div>' . PHP_EOL;
				
			}

		}

	?>
	<form action="" method="post">
		<div class="description">
			برای ارسال پیام به دیگر کاربران میتوانی از طریق <span class="red">شناسه کاربری</span> آنان و یا <span class="red">ایمیل</span> آنان افدام به ایرسال پیام به آنها نمایید.
		</div>
		<?php do_action( 'hmum_before_sendmessage_form' );?>
		<p>
			<span style='color: red;'>*</span>
			<label for="hmum_new_to">گیرنده:</label><br>
			<input type="text" class="ltr" size="30" required id="hmum_new_to" value="" name="hmum_new_to">
		</p>
		
		<p>
			<span style='color: red;'>*</span>
			<label for="hmum_new_subject">موضوع:</label><br>
			<input type="text" size="30" required id="hmum_new_subject" value="" name="hmum_new_subject">
		</p>
		
		<p>
			<span style='color: red;'>*</span>
			<label for="hmum_new_message">پیام:</label><br>
			<textarea id="hmum_new_message" required name="hmum_new_message" cols="60" rows="10"></textarea>
		</p>

		<p>
			<label for="hmum_new_status">وضعیت:</label> 
			معمولی <input type="radio" name="hmum_new_status" checked value="1">
			فوری <input type="radio" name="hmum_new_status" value="2">
		</p>
		
		<p>
			<input type="submit" name="hmum_new_send" value="ارسال پیام" class="button-secondary">
		</p>
				
	</form>

</div>