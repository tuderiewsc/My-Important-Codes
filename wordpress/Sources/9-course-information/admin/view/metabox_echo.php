<?php
$hmci_cource_logo 	= get_post_meta( $post->ID, '_hmci_course_logo', true );
$hmci_cource_teacher   	= get_post_meta( $post->ID, '_hmci_course_teacher', true );
$hmci_cource_parts 	= get_post_meta( $post->ID, '_hmci_course_parts', true );
$hmci_cource_time 	= get_post_meta( $post->ID, '_hmci_course_time', true );
$hmci_cource_lang 	= get_post_meta( $post->ID, '_hmci_course_lang', true );
$hmci_cource_level 	= get_post_meta( $post->ID, '_hmci_course_level', true );
$hmci_cource_free 	= get_post_meta( $post->ID, '_hmci_course_free', true );
?>
<p>
    <label for="hmci_metabox_course_logo">لوگو</label>
    <input type="text" placeholder="http://example.com/image.jpg" style="width: 80%" name="hmci_metabox_course_logo" id="hmci_metabox_course_logo" class="ltr left" value="<?php echo esc_url( $hmci_cource_logo );?>"/>
    <input type="button" class="button-secondary" value="انتخاب" id="hmci_metabox_select_logo"/>
</p>
<p>
    <label for="hmci_metabox_teacher">مدرس: </label>
    <input type="text" placeholder="مدرس" class="widefat" value="<?php echo esc_attr( $hmci_cource_teacher );?>" name="hmci_metabox_teacher" id="hmci_metabox_teacher"/>
</p>
<p>
    <label for="hmci_metabox_part">تعداد قسمت: </label>
    <input type="text" placeholder="تعداد قسمت" class="widefat" name="hmci_metabox_part" value="<?php echo esc_attr( $hmci_cource_parts );?>" id="hmci_metabox_part"/>
</p>
<p>
    <label for="hmci_metabox_time">زمان دوره: </label>
    <input type="text" placeholder="زمان دوره" class="widefat" name="hmci_metabox_time" value="<?php echo esc_attr( $hmci_cource_time );?>" id="hmci_metabox_time"/>
</p>
<p>
    <label for="hmci_metabox_lang">زبان دوره: </label>
    <select name="hmci_metabox_lang">
        <option value="fa" <?php selected($hmci_cource_lang, 'fa'); ?>>فارسی</option>
        <option value="en" <?php selected($hmci_cource_lang, 'en'); ?>>انگلیسی</option>
        <option value="other" <?php selected($hmci_cource_lang, 'other'); ?>>زبان های دیگر</option>
    </select>
</p>
<p>
    سطح آموزشی:<br>
    <label for="hmci_metabox_level_low">مبتدی</label>
    <input type="radio" name="hmci_metabox_level" id="hmci_metabox_level_low" value="low"  <?php checked($hmci_cource_level, 'low'); ?>/>  
    <label for="hmci_metabox_level_middle">متوسط</label>
    <input type="radio" name="hmci_metabox_level" id="hmci_metabox_level_middle" value="middle" <?php checked($hmci_cource_level, 'middle'); ?> />  
    <label for="hmci_metabox_level_high">پیشرفته</label>
    <input type="radio" name="hmci_metabox_level" id="hmci_metabox_level_high" value="high" <?php checked($hmci_cource_level, 'high'); ?> />
</p>
<p>
    <label for="hmci_metabox_free">رایگان: </label>
    <input type="checkbox" value="free" name="hmci_metabox_free" id="hmci_metabox_free" <?php checked($hmci_cource_free, 'free'); ?>/>
</p>