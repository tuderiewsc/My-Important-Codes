<div class="wrap">
    <?php
        global $wpdb;
        $hmei_table = $wpdb->prefix . 'employees_information';
        
//        $result = $wpdb->insert(
//                    $hmei_table,
//                    array(
//                        'fname'     => 'hamed',
//                        'lname'     => 'moodi',
//                        'mission'   => 24,
//                        'weight'    => 60.4,
//                        'birthday'  => '1992-02-04 00:00:00'
//                    ),
//                    array(
//                        '%s', '%s', '%d', '%f', '%s'
//                    )
//                );
//        
//        if ($result) {
//            echo 'inserted ' .$wpdb->insert_id;
//        } else {
//            echo 'err';
//        }
        
        //$user_id = get_current_user_id();
        
        //echo $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND post_author = {$user_id} ");
        
        //$result = $wpdb->get_row("SELECT * FROM {$hmei_table}", OBJECT, 1);
        
        //$result = $wpdb->get_col("SELECT * FROM {$hmei_table}", 9);
        
        $result = $wpdb->get_results("SELECT * FROM {$hmei_table}", OBJECT_K);
        
        print_r($result);
        
        //echo $result->lname;
        
        //echo $wpdb->get_var();
        echo '<br>';
        echo $wpdb->test();
        
    ?>
</div>