<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       owmc.co.uk
 * @since      1.0.0
 *
 * @package    Comment_Crusher
 * @subpackage Comment_Crusher/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Comment_Crusher
 * @subpackage Comment_Crusher/includes
 * @author     Oliver Wieland <contact@owmc.co.uk>
 */
class Comment_Crusher {


	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Comment_Crusher_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'COMMENT_CRUSHER_VERSION' ) ) {
			$this->version = COMMENT_CRUSHER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'comment-crusher';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Comment_Crusher_Loader. Orchestrates the hooks of the plugin.
	 * - Comment_Crusher_i18n. Defines internationalization functionality.
	 * - Comment_Crusher_Admin. Defines all hooks for the admin area.
	 * - Comment_Crusher_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-comment-crusher-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-comment-crusher-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-comment-crusher-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-comment-crusher-public.php';

		$this->loader = new Comment_Crusher_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Comment_Crusher_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Comment_Crusher_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Comment_Crusher_Admin( $this->get_plugin_name(), $this->get_version() );

		// AND HERE IS WHERE I PUT MY OWN HOOKS... FINALLY.
		// Remove admin menu
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'comment_crusher_disable_admin_menu');
		// Disable support for comments and trackbacks in post types
		$this->loader->add_action( 'admin_init', $plugin_admin, 'comment_crusher_disable_comments_post_types_support');
		// Close comments on the front-end
		$this->loader->add_filter('comments_open', $plugin_admin, 'comment_crusher_disable_comments_status');
		$this->loader->add_filter('pings_open', $plugin_admin, 'comment_crusher_disable_comments_status');
		// Hide existing comments
		$this->loader->add_filter('comments_array', $plugin_admin, 'comment_crusher_disable_comments_hide_existing_comments' ) ;
		// Redirect any user trying to access comments page
		$this->loader->add_action('admin_init', $plugin_admin, 'comment_crusher_disable_comments_admin_menu_redirect');
		// Remove comments metabox from dashboard
		$this->loader->add_action('admin_init', $plugin_admin, 'comment_crusher_disable_comments_dashboard');
		// Removes Comments from toolbar
		$this->loader->add_action( 'wp_before_admin_bar_render', $plugin_admin, 'comment_crusher_admin_bar_render' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Comment_Crusher_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}



}
