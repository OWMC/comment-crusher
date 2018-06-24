<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       owmc.co.uk
 * @since      1.0.0
 *
 * @package    Comment_Crusher
 * @subpackage Comment_Crusher/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Comment_Crusher
 * @subpackage Comment_Crusher/admin
 * @author     Oliver Wieland <contact@owmc.co.uk>
 */
class Comment_Crusher_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Comment_Crusher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Comment_Crusher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/comment-crusher-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Comment_Crusher_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Comment_Crusher_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/comment-crusher-admin.js', array( 'jquery' ), $this->version, false );

	}	


	/**
	 * Register my functions... finally
	 *
	 * @since    1.0.0
	 */
	// Remove admin menu
	public function disable_admin_menu() {
	    remove_menu_page('edit-comments.php');
	}
	// Disable support for comments and trackbacks in post types
	function df_disable_comments_post_types_support() {
	    $post_types = get_post_types();
	    foreach ($post_types as $post_type) {
	        if(post_type_supports($post_type, 'comments')) {
	            remove_post_type_support($post_type, 'comments');
	            remove_post_type_support($post_type, 'trackbacks');
	        }
	    }
	}
	// Close comments on the front-end
	function df_disable_comments_status() {
	    return false;
	}
	// Hide existing comments
	function df_disable_comments_hide_existing_comments($comments) {
	    $comments = array();
	    return $comments;
	}
	// Redirect any user trying to access comments page
	function df_disable_comments_admin_menu_redirect() {
	    global $pagenow;
	    if ($pagenow === 'edit-comments.php') {
	        wp_redirect(admin_url()); exit;
	    }
	}
	// Remove comments metabox from dashboard
	function df_disable_comments_dashboard() {
	    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	}
	// Removes Comments from toolbar
	function mytheme_admin_bar_render() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu('comments');
	    $wp_admin_bar->remove_menu('new-content');
	    $wp_admin_bar->remove_menu('edit');
	}



}
