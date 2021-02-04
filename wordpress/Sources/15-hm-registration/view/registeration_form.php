<?php if ( ! is_user_logged_in() ):?>
<?php
    global $hmu_err;
    if ( !empty( $hmu_err ) ) {
        echo '<ul style="color: red;">';
        foreach ( $hmu_err as $err ) {
            echo '<li>' . $err . '</li>';
        }
        echo '</ul>';
    }  
?>
<form id="hmu_registration_form" class="hmu_form" action="" method="POST">
    <fieldset>
        <p>
            <label for="hmu_user_Login">نا کاربری</label><br>
            <input name="hmu_user_login" id="hmu_user_login" class="ltr left-align" required type="text"/>
        </p>
        <p>
            <label for="hmu_user_email">رایانامه</label><br>
            <input name="hmu_user_email" id="hmu_user_email" class="ltr left-align" required type="email"/>
        </p>
        <p>
            <label for="hmu_user_first">نام</label><br>
            <input name="hmu_user_first" id="hmu_user_first" type="text"/>
        </p>
        <p>
            <label for="hmu_user_last">نام خانوادگی</label><br>
            <input name="hmu_user_last" id="hmu_user_last" type="text"/>
        </p>
        <p>
            <label for="password">گذرواژه</label><br>
            <input name="hmu_user_pass" id="password" class="ltr left-align" required type="password"/>
        </p>
        <p>
            <label for="password_again">تکرار گذرواژه</label><br>
            <input name="hmu_user_pass_confirm" id="password_again" class="ltr left-align" required type="password"/>
        </p>
        <p>
            <input type="hidden" name="hmu_register_nonce" value="<?php echo wp_create_nonce('hmu-register-nonce'); ?>"/>
            <input type="submit" value="ثبت نام"/>
        </p>
    </fieldset>
</form>
<?php else:?>
<?php
global $current_user;
get_currentuserinfo();
echo $current_user->display_name . ' خوش آمدید.';
echo '<br><a href="' . wp_logout_url() . '">خروج</a>';
?>
<?php endif; ?>
