<?php
/*
 * Plugin Name: آزمایش Http
 */

defined('ABSPATH') || exit;

add_action('admin_menu', function(){
	add_menu_page(
		'Http Test',
		'Http Test',
		'administrator',
		'hmtt_http',
		function(){
			echo '<pre class="ltr left-align">';
			$result = null;
                //$url = 'http://www.omdbapi.com/?t=inception&y=&plot=full&r=json';
			$url = 'http://localhost/test-script/http.php';

			$args = array(
				'method'=>'POST',
				'body' => array(
					'name' => 'hamed',
					'family' => 'moodi'
				),
				'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'
			);

			$result = wp_remote_request($url, $args);
			if(is_wp_error($result)){

				echo $result->get_error_message();

			}else{

                    //echo wp_remote_retrieve_header($result, 'content-type');

//                    if($result['response']['code'] == 200) {
//                        echo 'Ok';
//                    }else {
//                        echo 'No';
//                    }
//                    print_r($result);
			}

			echo '</pre>';

		}
	);
});

class HMTT_Film_Inf extends WP_Widget {

	function __construct() {

		parent::__construct(

            // base ID of the widget
			'hmtt_film_information',

            // name of the widget
			'اطلاعات فیلم',

            // widget options
			array (
				'description' => 'نمایش اطلاعات فیلم'
			)

		);
	}

	function form( $instance ) {

		$title = (!isset($instance['title']) || $instance['title'] == '') ? 'معرفی فیلم' : $instance['title'] ;
		$film = (!isset($instance['film']) || $instance['film'] == '') ? 'inception' : $instance['film'] ;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">نام</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo esc_attr($title);?>" class="widefat"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('film'); ?>">فیلم</label>
			<input type="text" id="<?php echo $this->get_field_id('film'); ?>" name="<?php echo $this->get_field_name('film');?>" value="<?php echo esc_attr($film);?>" class="widefat"/>
		</p>
		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance[ 'film' ] = strip_tags($new_instance[ 'film' ]);
		return $instance;

	}

	function widget( $args, $instance ) {
		$title = (!isset($instance['title']) || $instance['title'] == '') ? 'نویسندگان با سابقه' : $instance['title'] ;
		$film = (!isset($instance['film']) || $instance['film'] == '') ? 'inception' : $instance['film'] ;
		extract($args);
		echo $before_widget . $before_title . $title . $after_title;

		$url = "http://www.omdbapi.com/?t=$film&y=&plot=full&r=json";
		$response = wp_remote_get($url);

		if(is_wp_error($response) ) {
            //Error
		} else {
			if (wp_remote_retrieve_response_code($response) == 200 ){
                //show data
				$body = wp_remote_retrieve_body($response);
				$film = json_decode($body);

				?>
				<li>عنوان: <?php echo $film->Title;?></li>
				<li>سال ساخت: <?php echo $film->Year;?></li>
				<li>رتبه: <?php echo $film->imdbRating;?></li>
				<li>کارگردان: <?php echo $film->Director;?></li>
				<li>نویسنده: <?php echo $film->Writer;?></li>
				<li>زمان: <?php echo str_replace('min', 'دقیقه', $film->Runtime);?></li>
				<?php

			} else {
				wp_remote_retrieve_response_message($response);
			}
		}

		echo $after_widget;
	}

}

add_action('widgets_init', function(){
	register_widget('HMTT_Film_Inf');
});