<?php
/*
Plugin Name: کنترل کاربران
License: GPLv2
*/

add_action( 'show_user_profile', 'hmu_extra_field' );
add_action( 'edit_user_profile', 'hmu_extra_field' );

function hmu_extra_field( $user ){
    if ( !current_user_can('edit_users') ) 
        return;
    
    ?>
        <h3>اطلاعات اضافی</h3>

        <table class="form-table">
            <tr>
                <th><label for="hmu_active_user">فعال بودن کاربر</label></th>
                <td>
                    <input type="checkbox" name="hmu_active_user" value="active"  <?php checked(get_user_meta($user->ID, 'hmu_active_user', true), 'active');?> />
                </td>
            </tr>
        </table>
    <?php
}

add_action( 'personal_options_update', 'hmu_save_extra_field' );
add_action( 'edit_user_profile_update', 'hmu_save_extra_field' );

function hmu_save_extra_field( $user_id )
{
    if ( !current_user_can('edit_users') ) 
        return;
    
    update_user_meta( $user_id,'hmu_active_user', sanitize_text_field( $_POST['hmu_active_user'] ) );
    
}

add_filter( 'authenticate', function($user, $username, $password){
    $userObject = get_user_by( 'login', $username );
    if ( !$userObject )
        return $user;
    
    if ( get_user_meta($userObject->ID, 'hmu_active_user', true) != 'active' && !user_can($userObject, 'edit_users') ) {
        $errors = new WP_Error();
        $errors->add('hmu_err', 'حساب کاربری شما غیر فعال است.');
        return $errors;
    }
    return $user;
}, 99, 3);
//////////////////////////////////////////////////
add_filter('user_contactmethods', function($contantMethods){
    $contantMethods['hmu_mobile'] = 'شماره همراه';
    return $contantMethods;
});

add_action('register_form', function(){
    ?>
        <p>
            <label for="hmu_mobile">شماره همراه<br />
            <input type="text" name="hmu_mobile" id="hmu_mobile" class="input" /></label>
        </p>
    <?php
});

add_action('user_register', function($user_id){
    $userData = array();
    $userData['ID']         = $user_id;
    $userData['hmu_mobile'] = sanitize_text_field($_POST['hmu_mobile']);
    wp_update_user($userData);
});

add_filter('manage_users_columns', function($columns){
    $columns['hmu_mobile'] = 'شماره همراه';
    return $columns;
});

add_action('manage_users_custom_column', function($value, $column_name, $user_id){
    $mobile = get_user_meta($user_id, 'hmu_mobile', true);
    if ('hmu_mobile' == $column_name)
        return $mobile;
    
    return $value;
    
}, 10, 3);
