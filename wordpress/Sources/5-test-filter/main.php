<?php
/*
* Plugin Name: تست فیلترها
* Plugin URI: http://ccm.com
* Author: Unco
* Author URI: http://ccm.com
* Version: 1.0.0
* License: GPLv2
* Description: 	لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
*/

// remove_all_filters( 'the_content', 8 );

add_filter( 'the_content', 'testReplace');
function testReplace($content)
{
  return str_replace(' لورم ', ' <a href="http://lorem.ir">لورم</a> ', $content);

}

// add_filter( 'myFilter', 'echoFilter'); // filter is definded in footer.php
// function echoFilter($name)
// {
  //   return $name . '  sharif';
  // }
  
  /* footer.php */
  /* <?php
        //$name = 'Ali';
        $names = array('Ali', 'Reza', 'Hesam' );
        //$res = apply_filters( 'myFilter', $name );
        $res = apply_filters_ref_array( 'myFilter', $names);
        echo $res
        ?> */
  /* footer.php */

  add_filter( 'myFilter', 'echoFilter',10,3); // filter is definded in footer.php
  function echoFilter($name1 ,$name2, $name3)
  {
    return $name1.'-'.$name2 .'-'.$name3;
  }
  remove_filter( 'myFilter', 'echoFilter');

  // add_filter( 'the_content', 'secondFilter' );
  // add_filter( 'the_title', 'secondFilter' );
  // function secondFilter($text){
    //   $replace =array();
    //   if (current_filter() == 'the_content') {
      //     $replace = array('متن','نامفهوم');
      //   }else {
        //     $replace = array('تحلیل','متن','نامفهوم');
        //   }

        //   return str_replace($replace, '***' ,$text);
        // }

        add_filter('pre_option_link_manager_enabled', '__return_true');


        //add_filter('user_row_actions', '__return_empty_array');
        add_filter('user_row_actions', 'addMyAction');
        function addMyAction($actions){
          $actions[] = '<a href="#">New Action</a>';
          return $actions;
        }


        // Related posts
		add_filter('the_content', 'addRelationPost');
        function addRelationPost($content){
          if (! is_singular( 'post' )) {
            return $content;
          }

          $terms = get_the_terms( get_the_ID(), 'category' );
          $cats = array();
          foreach ($terms as $term) {
            $cats[] = $term->term_id;
          }

          $query = array(
            'cat__in' => $cats ,
            'posts_per_page' => 5 ,
            'post__not_in' => array(get_the_ID()) ,
            'orderby' => 'rand'
          );
          $loop = new WP_Query($query);

          if ($loop->have_posts()) {
            $content .= '<ul class="post-related">';
            while ($loop->have_posts()) {
              $loop->the_post();
              $content .= the_title(
                '<li><a href=" '.get_permalink().' ">',
                '</a></li>',
                false
              );

            }
            $content .= '</ul>';

            wp_reset_query();
          }

          return $content;


        }