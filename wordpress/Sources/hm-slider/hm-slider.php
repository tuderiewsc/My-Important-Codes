<?php
/*
  Plugin Name: hm-slider
  License: GPLv2
 */

class WPTuts_Simple_Metabox_Admin_Page {

    var $hook;
    var $title;
    var $menu;
    var $permissions;
    var $slug;
    var $page;

    /**
     * Constructor class for the Simple Admin Metabox
     * @param $hook - (string) parent page hook
     * @param $title - (string) the browser window title of the page
     * @param $menu - (string)  the page title as it appears in the menuk
     * @param $permissions - (string) the capability a user requires to see the page
     * @param $slug - (string) a slug identifier for this page
     * @param $body_content_cb - (callback)  (optional) a callback that prints to the page, above the metaboxes. See the tutorial for more details.
     */
    function __construct($hook, $title, $menu, $permissions, $slug, $body_content_cb = '__return_true') {
        $this->hook = $hook;
        $this->title = $title;
        $this->menu = $menu;
        $this->permissions = $permissions;
        $this->slug = $slug;
        $this->body_content_cb = $body_content_cb;
        /* Add the page */
        add_action('admin_menu', array($this, 'add_page'));
    }

    /**
     * Adds the custom page.
     * Adds callbacks to the load-* and admin_footer-* hooks
     */
    function add_page() {
        /* Add the page */
        $this->page = add_submenu_page($this->hook, $this->title, $this->menu, $this->permissions, $this->slug, array($this, 'render_page'), 10);
        /* Add callbacks for this screen only */
        add_action('load-' . $this->page, array($this, 'page_actions'), 9);
        add_action('admin_footer-' . $this->page, array($this, 'footer_scripts'));
    }

    /**
     * Prints the jQuery script to initiliase the metaboxes
     * Called on admin_footer-*
     */
    function footer_scripts() {
        ?>
        <script> postboxes.add_postbox_toggles(pagenow);</script>
        <?php
    }

    /*
     * Actions to be taken prior to page loading. This is after headers have been set.
     * call on load-$hook
     * This calls the add_meta_boxes hooks, adds screen options and enqueues the postbox.js script.   
     */

    function page_actions() {
        do_action('add_meta_boxes_' . $this->page, null);
        do_action('add_meta_boxes', $this->page, null);
        /* User can choose between 1 or 2 columns (default 2) */
        add_screen_option('layout_columns', array('max' => 2, 'default' => 2));
        /* Enqueue WordPress' script for handling the metaboxes */
        wp_enqueue_script('postbox');
    }

    /**
     * Renders the page
     */
    function render_page() {
        ?>
        <div class="wrap">

                <?php screen_icon(); ?>

            <h2> <?php echo esc_html($this->title); ?> </h2>

            <form name="my_form" method="post">  
                <input type="hidden" name="action" value="some-action">
        <?php
        wp_nonce_field('some-action-nonce');
        /* Used to save closed metaboxes and their order */
        wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);
        wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
        ?>

                <div id="poststuff">

                    <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>"> 

                        <div id="post-body-content">
                            <?php call_user_func($this->body_content_cb); ?>
                        </div>    

                        <div id="postbox-container-1" class="postbox-container">
        <?php do_meta_boxes('', 'side', null); ?>
                        </div>    

                        <div id="postbox-container-2" class="postbox-container">
        <?php do_meta_boxes('', 'normal', null); ?>
        <?php do_meta_boxes('', 'advanced', null); ?>
                        </div>	     					

                    </div> <!-- #post-body -->

                </div> <!-- #poststuff -->

            </form>			

        </div><!-- .wrap -->
        <?php
    }

}

/* Example Usage */
//Create a page
$example = new WPTuts_Simple_Metabox_Admin_Page('edit.php', __('Title', 'domain'), __('Menu Title', 'domain'), 'manage_options', 'example_page', 'sh_example_body_content');

//Define the body content for the page (if callback is specified above)
function sh_example_body_content() {
    ?>
    <p> This class is just a simple example of a custom admin page with metaboxes. The class is intended to act as a skeleton class. You can use it to add several admin pages, but you might find that some pages require a seperate class extension.<p>

    <p> This content always sits at the top of the page<p>
        <?php
    }

    //Add some metaboxes to the page
    add_action('add_meta_boxes', 'sh_example_metaboxes');

    function sh_example_metaboxes() {
        add_meta_box('example1', 'Example 1', 'sh_example_metabox', 'posts_page_example_page', 'normal', 'high');
        add_meta_box('example2', 'Example 2', 'sh_example_metabox', 'posts_page_example_page', 'side', 'high');
    }

    //Define the insides of the metabox
    function sh_example_metabox() {
        ?>
    <p> An example of a metabox <p>
    <?php
}
