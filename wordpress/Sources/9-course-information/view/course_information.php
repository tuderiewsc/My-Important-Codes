<?php
$hmci_cource_logo 	= get_post_meta( get_the_ID(), '_hmci_course_logo', true );
$hmci_cource_teacher 	= get_post_meta( get_the_ID(), '_hmci_course_teacher', true );
$hmci_cource_parts 	= get_post_meta( get_the_ID(), '_hmci_course_parts', true );
$hmci_cource_time 	= get_post_meta( get_the_ID(), '_hmci_course_time', true );
$hmci_cource_lang 	= get_post_meta( get_the_ID(), '_hmci_course_lang', true );
$hmci_cource_level 	= get_post_meta( get_the_ID(), '_hmci_course_level', true );
$hmci_cource_free 	= get_post_meta( get_the_ID(), '_hmci_course_free', true );

$hmciLevel = '';
switch ($hmci_cource_level){
case 'high':
    $hmciLevel = 'پیشرفته';
    break;

    case 'middle':
    $hmciLevel = 'متوسط';
    break;
    
    case 'low':
    $hmciLevel = 'مبتدی';
    break;
        
    default :
    return;
            
}

switch ($hmci_cource_lang) {
    case 'fa':
        $hmci_cource_lang = 'فارسی';
        break;

    case 'en':
        $hmci_cource_lang = 'انگلیسی';
        break;

    default:
        $hmci_cource_lang = 'دیگر زبان ها';
        break;
}

if ($hmci_cource_logo == '') {
    $hmci_cource_logo = HMCI_IMAGE_URL . 'no-image.jpg';
}

?>
<div id="hmci-cource-detail-post-<?php the_ID();?>" class="hmci-cource-detail">
    <img src="<?php echo $hmci_cource_logo;?>" width="400" height="300" alt="<?php the_title();?>" class="img-responsive">
    <div>
        <span>+اطلاعات دوره</span>
        <ul>
            <li>مدرس: <?php echo $hmci_cource_teacher == '' ? 'ثبت نشده' : $hmci_cource_teacher;?></li>
            <li>تعداد قسمت ها: <?php echo $hmci_cource_parts;?>  قسمت</li>
            <li>سطح دوره: <?php echo $hmciLevel;?></li>
            <li>زمان دوره: <?php echo $hmci_cource_time;?></li>
            <li>زبان آموزشی: <?php echo $hmci_cource_lang;?></li>
            <li>وضعیت دوره: <?php echo $hmci_cource_free == 'free' ? 'رایگان' : 'غیر رایگان';?></li>
        </ul>
    </div>
</div>