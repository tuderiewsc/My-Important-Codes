<?php
/*
* Plugin Name: درباره نویسنده
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
*/

defined('ABSPATH') || die('Error');

class ccm_About_Author
{
  public $version = '1.0.0';

  public function __construct()
  {
    # code...
  }

  public function run()
  {
    add_filter( 'the_content', array($this, 'echoAbout') );
    add_action( 'wp_head', array($this, 'echoAboutStyle') );
  }

  public function echoAbout($content)
  {
    $authorImage = get_avatar( get_the_author_meta( 'email' ) , 32  );
    $authorName = get_the_author( );
    $authorDesc = get_the_author_meta( 'description' );

    $aboutBox = '<div class="about-author">';
    $aboutBox .= $authorImage;
    $aboutBox .= '<strong style="color:red;">' .$authorName. '</strong>' . $authorDesc;
    $aboutBox .= '</div>';

    return $content . $aboutBox;
  }

  public function echoAboutStyle()
  {
    ?>
<style type="text/css">
.about-author {
  padding: 15px;
  border-radius: 3px;
  border: 1px solid #554455;
  background-color: goldenrod;
  line-height: 200%;
  text-align: justify;
  font-size: 14px;
}

.about-author img {
  border-radius: 50%;

}
</style>
<?php
  }

}

$ccm_About_Author = new ccm_About_Author();
$ccm_About_Author->run();