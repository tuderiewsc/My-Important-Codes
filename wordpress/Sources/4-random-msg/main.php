<?php
/*
* Plugin Name: پیام تصادفی
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
*/

add_action( 'wp_footer', 'showMsg', 99 );
function showMsg()
{
  $messages = array(
    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.111',
    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.222',
    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.333',
    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.444',
    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.555',
  );

  $messageIndex = rand(0 , (count($messages)-1) );
  $msg = $messages[$messageIndex];
  $nl = PHP_EOL;

  ?>

<p class="msg"
  style="position: fixed;top:0;left: 0;width: 100%;background-color:aqua ;color: #eeeeee;font-family: Vazir;padding: 8px;z-index: 1000;min-height: 40px;">
  <?php echo $msg; ?>
</p>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
      // alert('dfs');
      $('.msg').fadeOut(2000);
    }
  });
});
</script>

<?php


}