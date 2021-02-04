<?php

function hmum_get_user_ID ( $user_or_email ) {
	
	if ( is_email( $user_or_email ) ) {
		return email_exists( $user_or_email ); //return user id if email exists and return false if email does not exists
	} else {
		if ( $user = get_user_by( 'login', $user_or_email ) ) {
	        return $user->ID;
	    }
	}
	return false;

}

function hmum_get_user_name ( $user_id ) {
	if ( $user = get_user_by( 'id', $user_id ) ) {
        return $user->user_login;
    }
}

function hmum_send_message ( $from, $to, $subject, $type, $message, $parent_message =false) {

	global $wpdb;

	$table = $wpdb->prefix . 'user_message';

	return $wpdb->insert(
			$table,
			array(
				'from_user' 	=> $from,//user_id
				'to_user' 		=> $to,//user_id
				'subject'		=> $subject,
				'message'		=> $message,
				'type'			=> $type,
				'sent_at'		=> current_time('mysql')
			),
			array('%d', '%d', '%s', '%s', '%d', '%s')
		);

}

function hmum_get_inbox_message_count ( $isInbox = true , $unread = false ) {
	
	global $wpdb;

	$table = $wpdb->prefix . 'user_message';

	$current_user_id = get_current_user_id();

	$whichMessage = $isInbox ? 'to_user' : 'from_user';

	$query = "SELECT COUNT(*) FROM {$table} WHERE {$whichMessage} = {$current_user_id}";

	$unread == false ? '' : $query.= " AND is_read = 0";

	return $wpdb->get_var( $query );

}

//get inbox message list
function hmum_get_messages ( $sent = false) {

	global $wpdb;

	$table = $wpdb->prefix . 'user_message';

	$current_user_id = get_current_user_id();

	$query = '';

	if ( $sent ) {
		$query = "SELECT * FROM {$table} WHERE from_user = {$current_user_id}";
	} else {
		$query = "SELECT * FROM {$table} WHERE to_user = {$current_user_id}";
	}

	$query.= " ORDER BY id DESC";

	return $wpdb->get_results($query, OBJECT);

}

function hmum_get_message ($message_id) {
	
	global $wpdb;

	$user_id = get_current_user_id();

	$message_id_safe = absint($message_id);

	$table = $wpdb->prefix . 'user_message';

	$query = "SELECT * FROM {$table} WHERE (from_user = {$user_id} OR  to_user = {$user_id}) AND id = {$message_id_safe} ORDER BY id ASC ";

	return $wpdb->get_row( $query, OBJECT);

}

function hmum_convert_date ( $date ) {

	if ( function_exists( 'jdate' ) ) {
		return jdate ( 'd F Y ساعت H:i:s', $date );
	}

}

function hmum_parse_date ( $date ) {

	$diff = strtotime( current_time('mysql') ) - strtotime( $date );

	if ( $diff < 60 ) {
		return ' - ' . $diff . ' ثانیه پیش';
	} else if ( $diff < 3600 ) {
		return ' - ' . floor($diff/60) . ' دقیقه پیش';
	} else if ( $diff < 86400 ) {
		return ' - ' . floor( $diff / 3600 ) . ' ساعت پیش';
	} else if ( $diff < 2592000 ) {
		return ' - ' . floor( $diff / 86400 ) . ' روز پیش';
	}
	return '';
}

function hmum_set_message_as_read ( $message_id ) {

	$user_id = get_current_user_id();
	
	global $wpdb;

	$table = $wpdb->prefix . 'user_message';

	return $wpdb->update($table, array( 'is_read' => 1), array( 'id' => $message_id , 'to_user' => $user_id), null, array( '%d' , '%d'));

}

function sanitize_hex_color( $color ) {
    if ( '' === $color )
        return '';
 
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
        return $color;
}