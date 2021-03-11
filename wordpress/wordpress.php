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




function __construct() {
        parent::__construct(
            'hmaw_author_widget',
            'نویسندگان برتر',
            array(
                'description'   => 'نمایش نویسندگان برتر از نظر تعدا مطلب، سابقه،...',
                'classname'     => 'hmaw_form_class'
            )
        );
        if (is_active_widget(false, false, $this->id_base)) {

            add_action('wp_enqueue_scripts', array(&$this, 'script'));

            add_action('admin_enqueue_scripts', array(&$this, 'upload_sctipt'));

        }
    }



add_action('plugins_loaded', function(){
    load_plugin_textdomain('hm-digital-shop', false, basename(plugin_dir_path(__FILE__)) . '/languages/');
});

register_activation_hook(__FILE__, 'hmds_activation_func');
function hmds_activation_func(){
    global $wpdb;
    
    $table = $wpdb->prefix . 'digital_product';
    $table2 = $wpdb->prefix . 'digital_product_transaction';
    
    $query1 = "CREATE TABLE `{$table}` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `price` int(11) DEFAULT '0',
    `download_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
   ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    
    $query2 = "CREATE TABLE `{$table2}` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user` int(11) NOT NULL,
        `file` int(11) NOT NULL,
        `price` int(11) NOT NULL,
        `res_number` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
        `ref_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
        `description` text COLLATE utf8_unicode_ci NOT NULL,
        `paymenter` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
        `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
        `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
        `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($query1);
    dbDelta($query2);
    
}

register_uninstall_hook(__FILE__, 'hmds_uninstall_func');
function hmds_uninstall_func(){
    global $wpdb;
    
    $table = $wpdb->prefix . 'digital_product';
    $table2 = $wpdb->prefix . 'digital_product_transaction';
    
    $wpdb->query("DROP TABLE IF EXISTS $table");
    $wpdb->query("DROP TABLE IF EXISTS $table2");
}

    <td>digital_product id=<?php echo absint($product->id) ;?></td>
	
	
	function hmds_get_product( $product_id ) {
    global $wpdb;
    $table = $wpdb->prefix . 'digital_product';
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $product_id), OBJECT);
}
        $result = $wpdb->get_col("SELECT * FROM {$hmei_table}", 9);


    return $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE file = %d AND user = %d AND ref_number <> 'null'", $prodcut_id, $user_id));

$insertResult = $wpdb->insert($table, array(
        'user'          => $user_id,
        'file'          => $file_id,
        'price'         => $price,
        'res_number'    => $ResNumber,
        'ref_number'    => 'null',
        'description'   => $description,
        'paymenter'     => $paymenter,
        'email'         => $email,
        'mobile'        => $mobile,
        'create_time'   => current_time( 'mysql' ))
        );
    return $insertResult;
	
	
	    return $wpdb->update($table, array('ref_number' => $RefNumber), array('res_number' => $ResNumber));


        $ResNumber = uniqid() ;// Order Id In Your System
        $Description = urlencode($product->title);


		<tbody>
            <?php hmds_get_products();?>
        </tbody>
		
		
$limit = 10; // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;
$transactions = $wpdb->get_results( "SELECT * FROM $table LIMIT $offset, $limit" );

//in jquery
function update_products(){
        $.get(hmds_data.ajaxurl + '?action=hmds_full_data', function(html){
            $("table#hmds_data_table tbody").html(html);
        });
    }
//	
	
	
	wp_localize_script('hmds-script', 'hmds_data', array(
        'ajaxurl'               => admin_url('admin-ajax.php'),
        'hmds_wpnonce'          => wp_create_nonce('hmds_save_link'),
        'hmds_wpnonce_delete'   => wp_create_nonce('hmds_delete_link'),
        'sure'                  => __('Are you sure?', 'hm-digital-shop'),
        'err'                   => __('An error happen', 'hm-digital-shop'),
    ));
	    $(document).on('click', 'a.hmds_delete', function(){
        if(!confirm(hmds_data.sure)) return false;


		extract(shortcode_atts(array(
        'id' => 0
    ), $atts));
    $product = hmds_get_product( $id );
		
		
		function hmbs_set_404(){
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 );
    exit;
}
$url = 'http://it-ebooks-api.info/v1/book/' . urlencode($book_id);
    $result = wp_remote_get($url);
    if (wp_remote_retrieve_response_code($result) != 200 ) {
        hmbs_set_404();
    }
	
	
	//update_term_meta($term_id, $meta_key, $meta_value, $prev_value)
function hmic_update_term_meta( $term_id, $meta_key, $meta_value ){
    global $wp_version;
    if(version_compare($wp_version, '4.4', '>=') ) {
        return update_term_meta($term_id, $meta_key, $meta_value);
    }else{
        return update_option("taxonomy_{$term_id}_{$meta_key}", $meta_value);
    }
}


//get_term_meta($term_id, $key, $single)
function hmic_get_term_meta( $term_id, $key, $single ){
    global $wp_version;
    if (version_compare( $wp_version, '4.4', '>=') ) {
        return get_term_meta($term_id, $key, $single);
    }else{
        return get_option("taxonomy_{$term_id}_{$key}", '');
    }
}

//add column
add_filter('manage_edit-software_columns', function( $columns ){
    $columns['software_icon'] = 'آیکون نرم افزار';
    return $columns;
});

//add column data
add_filter('manage_software_custom_column', function( $out, $column_name, $term_id ){
    
    if($column_name == 'software_icon') {
        $icon_url = hmic_get_term_meta($term_id, 'software_icon', true);
        $out = '<img src="'. esc_url($icon_url).'" width="48" height="48"/>';
    }
    return $out;
}, 10, 3);

add_filter('manage_post_posts_columns', function($columns){
    $columns['software_icon'] = 'نرم افزار';
    return $columns;
});

add_filter('manage_post_posts_custom_column', function($column_name, $post_id){
    if( $column_name == 'software_icon' ){
        $term_ids = wp_get_object_terms($post_id, 'software', array('fields' => 'ids'));
        $term_id = isset($term_ids[0]) ? $term_ids[0] : 0;
        if($term_id) {
            $term = get_term($term_id);
            $icon_url = hmic_get_term_meta($term_id, 'software_icon', true);
            echo '<img title="'. $term->name .'|'.$term->description.'" width="32" height="32" src="' . esc_url($icon_url) . '"/>';
        }else{
            echo '<img width="32" height="32" src="' . HMIC_NO_ICON_URL . '"/>';
        }
    }
}, 10, 2);


add_action('admin_enqueue_scripts', function($hook){
    if( $hook == 'edit-tags.php' && $_GET['taxonomy'] == 'software' ){
        wp_enqueue_script('hmic-select-icon', plugin_dir_url(__FILE__) . 'js/select_icon.js', array('jquery', 'media-upload', 'thickbox'));
        wp_enqueue_style('thickbox');
    }
    if( $hook == 'post.php' || $hook == 'post-new.php' ){
        wp_enqueue_style('hmic-select-icon-post', plugin_dir_url(__FILE__) . 'css/select_icon.css');
        wp_enqueue_script('hmic-select-icon-post', plugin_dir_url(__FILE__) . 'js/select_icon.js');
    }
//wp_die($hook);
});
		
		
		function add_async_forscript($url)
{
	if (strpos($url, '#asyncload')===false)
		return $url;
	else if (is_admin())
		return str_replace('#asyncload', '', $url);
	else
		return str_replace('#asyncload', '', $url)."' async='async" ."' defer='defer";
}
add_filter('clean_url', 'add_async_forscript', 11, 1);
// load css&js
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script('myScripts', RAD_JS.'scripts.js#asyncload' , '1.3');
});

// load css&js


/**
 * Add extra fields to register form.
 */
function wooc_extra_register_fields() {?>
	<p class="form-row form-row-first">
		<label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?></label>
		<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name"
		       value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
	</p>
	<p class="form-row form-row-last">
		<label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?></label>
		<input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name"
		       value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_billing_phone"><?php _e( 'Phone Number', 'woocommerce' ); ?></label>
		<input type="text" class="input-text" name="billing_phone" id="reg_billing_phone"
		       value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" maxlength="11"
		       onkeyup="this.value = this.value.replace(/[^\d\.]+/g, '');"/>
	</p>
	<div class="clear"></div>
	<?php
}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
/**
 * Below code save extra fields.
 */
function wooc_save_extra_register_fields( $customer_id ) {
	if ( isset( $_POST['billing_phone'] ) ) {
		// Phone input filed which is used in WooCommerce
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	}
	if ( isset( $_POST['billing_first_name'] ) ) {
		//First name field which is by default
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		// First name field which is used in WooCommerce
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}
	if ( isset( $_POST['billing_last_name'] ) ) {
		// Last name field which is by default
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		// Last name field which is used in WooCommerce
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	}
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );



 //Redirect wp-login.php
function redirect_to_nonexistent_page(){
	$new_login=  'my-account';
	if(strpos($_SERVER['REQUEST_URI'], $new_login) === false){
		wp_safe_redirect( home_url(  ) );
		exit();
	}
}
add_action( 'login_head', 'redirect_to_nonexistent_page');
function redirect_to_actual_login(){
	$new_login =  'radcustomsignin';
	if(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY) == $new_login&& ($_GET['redirect'] !== false)){
		wp_safe_redirect(home_url("wp-login.php?$new_login&redirect=false"));
		exit();
	}
}
add_action( 'init', 'redirect_to_actual_login');
 //Redirect wp-login.php



//add text note to product description page for all downloadable products
function append_download_note() {
		echo '<p><a href="https://eeeico.com/contact-us/">جهت سفارش لطفا با ما تماس بگیرید</a></p>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'append_download_note', 10, 0 );


function add_cron_recurrence_interval( $schedules ) {
	$schedules['every_ten_minutes'] = array(
		'interval'  => 60,
		'display'   => __( 'هر 10 دقیقه', 'uap' )
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'add_cron_recurrence_interval' );

		/*
* Rich Snippet Data
* Add missing data not handled by WooCommerce yet - Webjame.Com
*/
function custom_woocommerce_structured_data_product ($data) {
	global $product;
	$data['brand'] = $product->get_attribute('brand') ? $product->get_attribute('brand') : null;
	$data['mpn'] = $product->get_sku() ? $product->get_sku() : null;
	return $data;
}
add_filter( 'woocommerce_structured_data_product', 'custom_woocommerce_structured_data_product' );



	$hmum_inbox_page_hook = add_menu_page (
			'پیام کاربران',//Page <title>{$title}</title>
			$hmum_main_menu_title,//Page Menu title
			'read',//capability; this is capability for any user or subscriber
			'hmum_user_message_inbox',//This is menu slug
			function(){ include ( HMUM_ADMIN_VIEW_DIR . 'inbox.php' ); },//This view render inbox page in admin
			HMUM_ADMIN_IMAGES_URL . 'email_icon.png',//Menu icon by 16px x 16px
			'18.69'
		);

	$hmum_sent_page_hook = add_submenu_page (
			'hmum_user_message_inbox',//Page <title>{$title}</title>
			'پیام های ارسال شده',//Page Menu title
			'پیام های ارسال شده',//capability; this is capability for any user or subscriber
			'read',//This is menu slug
			'hmum_user_message_sent',
			function(){ include ( HMUM_ADMIN_VIEW_DIR . 'inbox.php' ); }//This view render inbox page in admin
		);

	add_action("load-{$hmum_sent_page_hook}", 'hmum_new_page_styles');
	add_action("load-{$hmum_inbox_page_hook}", 'hmum_new_page_styles');
}

function hmum_new_page_styles() {

	add_action ('admin_enqueue_scripts', function(){
		wp_enqueue_style ( 'admin-new-message', HMUM_ADMIN_CSS_URL . 'new.css' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'color-picker-script',HMUM_ADMIN_JS_URL . 'color-picker-script.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-core', 'jquery-ui-slider' ), false, true );
	});

	add_action ('admin_print_styles', function(){
		$mainBackground = HMUM_ADMIN_IMAGES_URL . 'communication.png';
		echo "
		<style type='text/css'>
		.wrap.hmum_new {
			background: url({$mainBackground}) no-repeat left bottom;
		}
		</style>
		";

	});
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



	  $html = <<<HTML
	  <a href="$link" title="$title" style="position:fixed;left: 0;bottom: 0;width: 500px;height: auto;z-index: 1000;">
	  <img src="$image" alt="">
	  </a>
	  HTML;
	  echo $html;
	  
	  
	  
