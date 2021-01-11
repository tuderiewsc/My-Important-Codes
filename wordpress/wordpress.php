# Block WordPress xmlrpc.php requests
<Files xmlrpc.php>
order deny,allow
deny from all
allow from 123.123.123.123
</Files>

<?php



//////////////// for eeeico ///////////
function encrypt_decrypt($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'H+MbQeThWmYq3t6w9z$C&F)J@NcRfUjXn2r5u7x!A%D*G-KaPdSgVkYp3s6v9y/B';
	$secret_iv = 'RfUjXn2r5u8x/A?D(G-KaPdSgVkYp3s6v9y$B&E)H@MbQeThWmZq4t7w!z%C*F-J';
	$key = hash('sha256', $secret_key);
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

add_action( 'wp_login', 'login_cookie' , 10 , 2);
function login_cookie($login) {
	$user = get_userdatabylogin($login);
	$id = $user->ID;
	$encrypted_id = encrypt_decrypt('encrypt', $id);
	$user = get_userdata( $id );
	$user_roles = $user->roles;
	$encrypted_role = encrypt_decrypt('encrypt', $user_roles[0]);


	$info = array(
		'userId' => $encrypted_id,
		'userRole' => $encrypted_role
	);

	setcookie("wordpress_8L25432ACC2D4A404E635266556A58CC", serialize($info), time()+14400 , '/', '' , false , false );  /* expire in 3 hours */
}

add_action( 'wp_logout', 'logout_cookie' , 15 , 1);
function logout_cookie() {
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}
}

add_filter( 'allowed_redirect_hosts', function(){
	$hosts[] = 'http://192.168.30.99/auth/public/admin/dashboard/';
	return $hosts;
});

add_role( 'buyer', 'Buyer' , array(
	'read' => true, // true allows this capability
	'edit_posts' => true, // Allows user to edit their own posts
	'edit_pages' => true, // Allows user to edit pages
	'edit_others_posts' => true, // Allows user to edit others posts not just their own
	'create_posts' => true, // Allows user to create new posts
	'manage_categories' => true, // Allows user to manage post categories
	'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode'edit_themes' => false, // false denies this capability. User can’t edit your theme
	'edit_files' => true,
	'edit_theme_options'=>true,
	'manage_options'=>true,
	'moderate_comments'=>true,
	'manage_categories'=>true,
	'manage_links'=>true,
	'edit_others_posts'=>true,
	'edit_pages'=>true,
	'edit_others_pages'=>true,
	'edit_published_pages'=>true,
	'publish_pages'=>true,
	'delete_pages'=>true,
	'delete_others_pages'=>true,
	'delete_published_pages'=>true,
	'delete_others_posts'=>true,
	'delete_private_posts'=>true,
	'edit_private_posts'=>true,
	'read_private_posts'=>true,
	'delete_private_pages'=>true,
	'edit_private_pages'=>true,
	'read_private_pages'=>true,
	'unfiltered_html'=>true,
	'edit_published_posts'=>true,
	'upload_files'=>true,
	'publish_posts'=>true,
	'delete_published_posts'=>true,
	'delete_posts'=>true,
	'install_plugins' => false, // User cant add new plugins
	'update_plugin' => false, // User can’t update any plugins
	'update_core' => false // user cant perform core updates
) );


// function wporg_simple_role_caps() {
//     $role = get_role( 'buyer' );
//     $role->add_cap( 'edit_posts', true );
// }
// add_action( 'init', 'wporg_simple_role_caps', 11 );

//////////////// for eeeico ///////////


/* Actions List */
comment_form
wp_head
wp_footer
/* Actions List */


/* Filters List */
the_content
the_excerpt
template_include
/* Filters List */

/* Globals */
	$post_id
	$wp_query
	$content
	$pagenow
	$post_type

/* Globals */


define('plugin_dir', plugin_dir_path(__FILE__));
date_default_timezone_set('Asia/Tehran');


// Search Redirect
add_action('template_redirect', 'openPost');
function openPost()
{
  if (is_search()) {
    global $wp_query;
    if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
      wp_redirect( get_permalink( $wp_query->posts[0]->ID ) );
      exit;
    }
  }
}

$terms = get_the_terms( get_the_ID(), 'category' );
          $cats = array();
          foreach ($terms as $term) {
            $cats[] = $term->term_id;
          }


    $authorImage = get_avatar( get_the_author_meta( 'email' ) , 32  );
    $authorName = get_the_author( );
    $authorDesc = get_the_author_meta( 'description' );


	
function hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
      return $default;
	//Sanitize $color if "#" is provided
  if ($color[0] == '#' ) {
   $color = substr( $color, 1 );
}

//Check if color has 6 or 3 characters and get values
if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
} elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
} else {
    return $default;
}
        //Convert hexadec to rgb
$rgb =  array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
if($opacity){
   if(abs($opacity) > 1)
      $opacity = 1.0;
  $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
} else {
   $output = 'rgb('.implode(",",$rgb).')';
}
        //Return rgb(a) color string
return $output;
}



if (!validate_username($user_login)) {
            $hmu_err[] = 'نام کاربري شما صحيح نيست.';
        }
        if (!is_email($user_email)) {
            $hmu_err[] = 'ايميل شما صحيح نمي باشد.';
        }
        if (email_exists($user_email)) {
            $hmu_err[] = 'ايميل شما قبلا ثبت شده است.';
        }
		
		
		wp_redirect( $location, $status = 302 )
$localtion = get_permalink( $post = 0, $leavename = false )

	
	
	$html = <<<HTML
	<a href="$link" title="$title" style="position:fixed;left: 0;bottom: 0;width: 500px;height: auto;z-index: 1000;">
	<img src="$image" alt="">
	</a>
	HTML;
	echo $html;