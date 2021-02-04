<div class="wrap">
    <h2>تنظیمات صفحه ورود</h2>
    <?php if( !isset($_GET['tab']) ) $_GET['tab'] = 'text';?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=hmcl_settings_page&tab=text" class="nav-tab<?php if( $_GET['tab'] == 'text'){echo ' nav-tab-active';};?>">متن ها</a>
        <a href="?page=hmcl_settings_page&tab=image" class="nav-tab<?php if( $_GET['tab'] == 'image'){echo ' nav-tab-active';};?>">تصاویر</a>
        <a href="?page=hmcl_settings_page&tab=color" class="nav-tab<?php if( $_GET['tab'] == 'color'){echo ' nav-tab-active';} ;?>">رنگ ها</a>
    </h2>
    
    <?php settings_errors();?>
    
    <form method="post" action="options.php">
        <?php
        
        if ( $_GET['tab'] == 'text' ){
            settings_fields('hmcl_settings_text');
            do_settings_sections('hmcl_settings_text');
        } else if ( $_GET['tab'] == 'image' ) {
            settings_fields('hmcl_settings_image');
            do_settings_sections('hmcl_settings_image');
        } else {
            settings_fields('hmcl_settings_color');
            do_settings_sections('hmcl_settings_color');
        }
        submit_button();
        
        ?>
    </form>
    
</div><!-- /.wrap -->