<?php
/*
* Plugin Name: random advertisement
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
*/

add_action( 'wp_footer', 'my_showAds',  99  );
function my_showAds()
{
	$ads = array(
		array( 'image' => 'n_index1.jpg', 'link' => 'http://tst.com/ad1', 'title'=> 'title1'),
		array( 'image' => 'n_index2.jpg', 'link' => 'http://tst.com/ad2', 'title'=> 'title2'),
		array( 'image' => 'n_index3.jpg', 'link' => 'http://tst.com/ad3', 'title'=> 'title3'),
		array( 'image' => 'n_index4.jpg', 'link' => 'http://tst.com/ad4', 'title'=> 'title4'),
	);

	$imageIndex = rand(0 , (count($ads)-1));
	$image = plugins_url( 'images/'. $ads[$imageIndex]['image'], __FILE__ );
	$link = $ads[$imageIndex]['link'];
	$title = $ads[$imageIndex]['title'];
		


	$html = <<<HTML
	<a href="$link" title="$title" style="position:fixed;left: 0;bottom: 0;width: 500px;height: auto;z-index: 1000;">
	<img src="$image" alt="">
	</a>
	HTML;

	echo $html;

}


?>

