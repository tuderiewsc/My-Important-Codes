<?php
/*
 * Plugin Name: نوتیفیکیشن تلگرام
 */

add_action('show_user_profile', 'hmtn_user_profile');
add_action('edit_user_profile', 'hmtn_user_profile');

function hmtn_user_profile($user){
    if(!user_can(  $user->ID, 'edit_posts'))
        return;
    ?>
    <h3>نوتیفیکیشن</h3>
    <table class="form-table">
        <tr>
            <th><label for="hmtn_api_key">NotifCaster APIKey</label></th>
            <td>
                <input type="text" name="hmtn_api_key" id="hmtn_api_key" value="<?php echo esc_attr( get_the_author_meta( 'hmtn_api_key', $user->ID ) ); ?>" class="regular-text" />
                <a href="https://telegram.me/notifcaster_bot" target="_blank">دریافت کد</a><br />
                <span class="description">کد مربوط به notifcaster را اینجا وارد کنید.</span>
            </td>
        </tr>
    </table>
    <?php
}

add_action('personal_options_update', 'hmtn_save_data');
add_action('edit_user_profile_update', 'hmtn_save_data');
function hmtn_save_data($user_id){
    if(user_can( $user_id, 'edit_posts') )
        return;
    
    update_usermeta( $user_id, 'hmtn_api_key', $_POST['hmtn_api_key'] );
    
}

add_action('comment_post', 'hmtn_send_comment');
function hmtn_send_comment($comment_id){
    $notifcaster_url = 'https://tg-notifcaster.rhcloud.com/api/v1/selfMessage';
    $comment = get_comment($comment_id);
    $post_author_id = get_post_field('post_author',$comment->comment_post_ID);
    $notifcaster_api_key = get_the_author_meta( 'hmtn_api_key', $post_author_id );
    $post_title = get_the_title($comment->comment_post_ID);
    $message = "شما یک پیام برای پست \"" . $post_title . "\" دارید." . PHP_EOL;
    $message.= $comment->comment_content . PHP_EOL;
    $message.= $comment->comment_author . PHP_EOL . $comment->comment_author_email;
    
    $args = array(
        'body'  => array(
            'api_token'  => $notifcaster_api_key,
            'msg'        => $message
        )
    );
    
    wp_remote_post($notifcaster_url, $args);
    
}