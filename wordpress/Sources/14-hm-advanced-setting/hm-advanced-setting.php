<?php
/*
 * Plugin Name: Advanced Setting Page
 */

add_action('admin_menu', 'hmas_add_menu');
function hmas_add_menu(){
    global $hmas_hook;
    $hmas_hook = add_options_page('تنظیمات پیشرفته',' تنظیمات پیشرفته', 'manage_options', 'hmas_settings_page', 'hmas_render_settings');
    
    add_action('load-' . $hmas_hook, function(){
        global $hmas_hook;
        do_action('add_meta_boxes', $hmas_hook, null);
        do_action('add_meta_boxes_' . $hmas_hook, null );
        add_screen_option('layout_columns', array('max'=>2,'default'=>2));
        wp_enqueue_script('postbox');
    },9);
    
    add_action('admin_footer-' . $hmas_hook, function(){
        ?>
        <script>postboxes.add_postbox_toggles(pagenow)</script>
        <?php
    });
    
    add_action('add_meta_boxes_' . $hmas_hook, function(){
        add_meta_box('hmas_save_area', 'ذخیره', 'hmas_save_setting_callback', null, 'side');
    });
    
    add_action('add_meta_boxes_' . $hmas_hook, function(){
        add_meta_box('hmas_setting_area', 'تنظیمات من', 'hmas_my_setting_callback', null, 'side');
    });
    
}

function hmas_my_setting_callback(){
    do_settings_sections('hmas_settings_group');
}

function hmas_save_setting_callback(){
    submit_button();
}

add_action('admin_init', function(){
    add_settings_section('hmas_public_section', 'تنظیمات عمومی', null, 'hmas_settings_group');
    add_settings_field('hmas_setting_name', 'نام افزونه', 'hmas_setting_name_cb', 'hmas_settings_group', 'hmas_public_section');
    register_setting('hmas_settings_group', 'hmas_name');
});

function hmas_setting_name_cb(){
    ?><input type="text" name="hmas_name" value="<?php echo get_option('hmas_name', "نامی انتخاب نشده"); ?>"/><?php
}

function hmas_render_settings(){
    
?>
<div class="wrap">
    <h2>صفحه تنظیمات</h2>
    <?php settings_errors();?>
    <form action="options.php" method="post">
        <?php settings_fields('hmas_settings_group');?>
        <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);?>
        <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);?>
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-<?php echo get_current_screen()->get_columns() == 1 ? '1' : '2'; ?>">
                <div id="post-body-content">
                    <h3>بخش عمومی</h3>
                    <p>This is description</p>
                    
                </div>
                <div class="postbox-container" id="postbox-container-1">
                    <?php do_meta_boxes('', 'side', null);?>
                </div>
                <div class="postbox-container" id="postbox-container-2">
                    <?php do_meta_boxes('', 'normal', null);?>
                    <?php do_meta_boxes('', 'advanced', null);?>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
    
}