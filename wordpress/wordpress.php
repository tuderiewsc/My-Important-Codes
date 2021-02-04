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
// comment_form
// wp_head
// wp_footer
/* Actions List */


/* Filters List */
// the_content
// the_excerpt
// template_include
/* Filters List */

/* Globals */
// $post_id
// $wp_query
// $content
// $pagenow
// $post_type
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


wp_redirect( $location, $status = 302 );
$localtion = get_permalink( $post = 0, $leavename = false );


add_filter( 'excerpt_length', function( $content ) use ($excerptLength) {return $excerptLength;}, 999); //based words count
add_filter('excerpt_more', function (){return '  ...';});

			$paged = ( get_query_var( $paged_type ) ) ? get_query_var( $paged_type ) : '1'; // Static front pages uses get_query_var( 'page' ) and not get_query_var( 'paged' ).


			global $wpdb;
			global $post;
			$postid = $post->ID;
			$user_id = get_current_user_id();
			$row1 = $wpdb->get_results( "SELECT * FROM $wpdb->post_like_table WHERE postid = '$postid' AND userid = '$user_id'");


			?>
			<li class="meta-author">
				<?php echo get_avatar(get_the_author_meta('ID')); ?>
				<a href="<?php echo get_site_url().'/author/'.get_the_author_meta( 'user_login' ); ?>" rel="author">
					<span>
						<span>
							<?php get_the_author_meta( '',the_author() ); ?>
						</span>
					</span>
				</a>
			</li>
			<?

			$post_categories = wp_get_post_terms($post->ID, 'zcategory');

			$tags = get_the_term_list( get_the_ID(), 'ztags', '', ',' );
			echo gettype($tags);
			if ( ! empty( $tags ) ) {
				echo $tags;
			}
			comments_template( '/comments.php', false );


			function post_like_table_create() {
				global $wpdb;
				$table_name = $wpdb->prefix. "post_like_table";
				global $charset_collate;
				$charset_collate = $wpdb->get_charset_collate();
				global $db_version;

				if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name)
					{ $create_sql = "CREATE TABLE " . $table_name . " (
				id INT(11) NOT NULL auto_increment,
				postid INT(11) NOT NULL ,
				userid VARCHAR(40) NOT NULL ,

				PRIMARY KEY (id))$charset_collate;";
				require_once(ABSPATH . "wp-admin/includes/upgrade.php");
				dbDelta( $create_sql );
			}


//register the new table with the wpdb object
			if (!isset($wpdb->post_like_table))
			{
				$wpdb->post_like_table = $table_name;
				$wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
			}

		}
		add_action( 'init', 'post_like_table_create');



		function get_client_ip() {
			$ip=$_SERVER['REMOTE_ADDR'];
			return $ip;
		}

		if ( empty($row1)){
			$wpdb->insert( $wpdb->post_like_table, array( 'postid' => $postid, 'userid' => $user_id ), array( '%d', '%s' ) );
			$liked = 1;
		}else{
			$wpdb->delete( $wpdb->post_like_table, array( 'postid' => $postid, 'userid'=> $user_id ), array( '%d','%s' ) );
			$liked = 0;
		}


		update_post_meta( $postid, 'likes_count', $total_like , '' );


// fix paginate in custom taxonomy //
		$option_posts_per_page = get_option( 'posts_per_page' );
		add_action( 'init', 'my_modify_posts_per_page', 0);
		function my_modify_posts_per_page() {
			add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
		}
		function my_option_posts_per_page() {
			global $option_posts_per_page;
			if ( is_tax( 'zcategory') ) {
				return 1;
			} else {
				return $option_posts_per_page;
			}
		}
// fix paginate in custom taxonomy //


		function secureLink($url , $post , $str){
			$input = get_post_meta($post->ID, $str, true);
			$is_url = filter_var($url, FILTER_VALIDATE_URL);
			if ($url !== '' && $is_url ){
				$url = esc_url( $url, null, 'display' );
				$url = trim($url, '/');
				if (!preg_match('#^http(s)?://#', $url)) {
					$input = 'http://' . $url;
				}
				$urlParts = parse_url($input);
				$domain = preg_replace('/^www\./', '', $urlParts['host']);
				return $domain;
			}else{
				return 0;
			}
		}

		// Remove p tags from category description
		remove_filter('the_content','wpautop');

		$location = $_SERVER['HTTP_REFERER'];
		wp_safe_redirect($location);


		// return data in json
		$data=array( 'postid'=>$postid,'likecount'=>$total_like,'userid'=>$user_id, 'is_loggedin'=> $is_loggedin, 'is_liked'=> $liked);
		echo json_encode($data);
	  die(); // this is required to return a proper result


	  if(wp_get_current_user()->ID != get_post( $post_id )->post_author){
	  	?>
	  	<script type="text/javascript"> window.location.replace('https://sisoog.com/my_planet/'); </script>
	  	<?php
	  	exit();
	  }



	  $post_id = wp_insert_post(array (
	  	'post_type' => 'zplanet',
	  	'taxonomy' => 'zcategory,ztags',
	  	'post_title' => sanitize_text_field( $_POST["post_title"] ),
	  	'post_content' =>  $_POST["post_content"] ,
	  	'tags_input' => array($tags),
	  	'post_category' =>  sanitize_text_field($_POST['post_cats']),
	  	'post_status' => 'pending'
	  ));
	  
	  
	// زیر رسانه -> افزودن  
	   add_media_page( 'زیر شاخه آپلود' , 'زیر شاخه آپلود', 'administrator', 'under_upload', 'echo_under_upload' );
  function echo_under_upload()
  {
    global $pagenow;
    echo $pagenow;
    print_r($_GET);
  }
  
  
  
  // تنظیمات داخل افزونه ها
  add_filter( 'plugin_action_links_'. plugin_basename( __FILE__ ), 'ccm_addLinks' );
function ccm_addLinks($links){
  $links[]='<a href="'.admin_url('admin.php?page=ccm_customstyle').'">تنظیمات</a>';
  return $links;
}

// تنظیمات داخل منو بار
add_action('admin_bar_menu', 'ccm_add_custom_menu', 100);
function ccm_add_custom_menu(){

  global $wp_admin_bar;
  $menuArgs = array(
    //'parent'=> 'top-secondary',
    'parent'=> 'root-default',
    'id'=> 'my_menu',
    'title'=> '<img src="'.plugins_url('images', __FILE__).'/icon.png " width="24" height="24"> تنظیمات استایل',
    'href'=> admin_url('admin.php?page=ccm_customstyle'),
    'meta'=> array(
      'target'=> '_blank'
    )
  );
  $wp_admin_bar->add_menu($menuArgs);
  $wp_admin_bar->add_menu(array(
    'parent'=> 'my_menu',
    'id'=> 'submenu1',
    'title'=> 'زیر منو',
    'href'=> '#',
  ));
}


// custom script
add_action('wp_footer', 'echo_custom_script');
function echo_custom_script(){
  $script = str_replace('\\', '', get_option( 'ccm_script_key' ));
  echo '<script type="text/javascript">' .PHP_EOL;
  echo $script ? $script : '';
  echo '</script>' .PHP_EOL;
}




	$current_user_id = get_current_user_id();
	$query = "SELECT COUNT(*) FROM {$table} WHERE to_user = {$current_user_id} AND is_read = 0";
	$number_message = $wpdb->get_var( $query );
	$hmum_admin_bar_menu_title = $number_message > 0 ? '<span style="color: red">' . $number_message . ' پیام جدید</span>' : 'پیام کاربران';
	$admin_menu_bar->add_menu(array(
			'id' => 'hmum-user-message',
			'title' => $hmum_admin_bar_menu_title,
			'href' => admin_url('admin.php?page=hmum_user_message_inbox'),
		));
		
		
		
		
		add_action('user_register', 'hmum_send_welcome_message_to_new_user');



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


	$message_id_safe = absint($message_id);

return jdate ( 'd F Y ساعت H:i:s', $date );



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


current_user_can( 'administrator' )


$hmum_inbox_page_hook = add_menu_page (
			'پیام کاربران',//Page <title>{$title}</title>
			$hmum_main_menu_title,//Page Menu title
			'read',//capability; this is capability for any user or subscriber
			'hmum_user_message_inbox',//This is menu slug
			function(){ include ( HMUM_ADMIN_VIEW_DIR . 'inbox.php' ); },//This view render inbox page in admin
			HMUM_ADMIN_IMAGES_URL . 'email_icon.png',//Menu icon by 16px x 16px
			'18.69'
		);
		
		
		 //Using jquery-ui slider
        wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');


<?php wp_nonce_field('hm-save-setting');?>

    <input type="radio" <?php checked($hmci_cource_level, 'high'); ?> name="hmci_metabox_level" id="hmci_metabox_level_high" value="high"  />
    <input type="checkbox" <?php checked($hmci_cource_free, 'free'); ?> value="free" name="hmci_metabox_free" id="hmci_metabox_free" />
    <option value="fa" <?php selected($hmci_cource_lang, 'fa'); ?>>فارسی</option>



add_action('save_post', 'hmci_course_information_save');
add_action('save_edit', 'hmci_course_information_save');
function hmci_course_information_save( $post_id ){

    if ( !isset( $_POST['hmci_metabox_course_logo'] ) ) return;
    
    update_post_meta($post_id, '_hmci_course_logo', esc_url_raw( $_POST['hmci_metabox_course_logo'] ));
}
$hmci_cource_logo 	= get_post_meta( $post->ID, '_hmci_course_logo', true );







	  $html = <<<HTML
	  <a href="$link" title="$title" style="position:fixed;left: 0;bottom: 0;width: 500px;height: auto;z-index: 1000;">
	  <img src="$image" alt="">
	  </a>
	  HTML;
	  echo $html;
	  
	  
	  
