<div class="wrap">
    <p>
        <?php _e('Use this shortcode in your post', 'hm-image-slider');?>
    <hr>
    <span style="color:red; display: block;" class="ltr left-align">[hmslider id=<?php echo $post->ID;?>]</span>
    <?php _e('Use this code in your functions.php', 'hm-image-slider');?>
    <hr>
    <span style="color:red; display: block;" class="ltr left-align">&lt;?php do_shortcode('[hmslider id=<?php echo $post->ID;?>]');?&gt;</span>
    </p>
</div>