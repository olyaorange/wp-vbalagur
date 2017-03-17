<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/includes
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
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/includes
 * @author     Codeneric <support@codeneric.com>
 */
class Infinite_Masonry_Gallery_Base {

	protected $loader;

	protected $plugin_name;


	protected $slug;

	protected $version;


	public function __construct() {

//		include ABSPATH . WPINC . '/version.php';
//		if(function_exists('get_plugin_data')){
//			$plugin_data = get_plugin_data(dirname(__FILE__) .'/../infinite-masonry-gallery.php');
//			$this->version = $plugin_data['Version'];
//		}

		global $cc_img_config;


		$this->version = $cc_img_config['version'];
		$this->plugin_name = $cc_img_config['plugin_name'];

		$this->slug = $cc_img_config['slug'];

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}


	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/public.php';

		$this->loader = new Infinite_Masonry_Gallery_Base_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Infinite_Masonry_Gallery_Base_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Infinite_Masonry_Gallery_Base_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

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
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		global $cc_img_config;

		$plugin_admin = new Infinite_Masonry_Gallery_Base_Admin( $this->get_plugin_name(), $this->get_version(), $this->slug );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'update_database');

		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes' );



		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles', 10 );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', 10 );



		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'dequeue_files', 99998 );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_box_data' );



//		$this->loader->add_action( 'wp_ajax_codeneric_img_get_project_status', $plugin_admin, 'get_project_status' );
//		$this->loader->add_action( 'wp_ajax_codeneric_img_update_premium', $plugin_admin, 'update_premium' );
//		$this->loader->add_action( 'before_delete_post', $plugin_admin, 'deleted_client' );


		$this->loader->add_filter( 'manage_'.$cc_img_config['slug'].'_posts_columns', $plugin_admin, 'define_table_columns' );
		$this->loader->add_action( 'manage_'.$cc_img_config['slug'].'_posts_custom_column', $plugin_admin, 'fill_custom_columns', 10 ,2 );

//		$this->loader->add_action( 'wp_ajax_img_star_photo', $plugin_admin, 'star_photo_cb');
//		$this->loader->add_action( 'wp_ajax_codeneric_img_check_username', $plugin_admin, 'check_username');


		$this->loader->add_action( 'wp_ajax_cc_img_get_attachment', $plugin_admin, 'get_attachment');
		$this->loader->add_action( 'wp_ajax_cc_send_feedback', $plugin_admin, 'send_feedback');
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_settings_page');
		$this->loader->add_action( 'admin_init', $plugin_admin, 'settings_init');

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_support_page');

//		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_premium_page');

//		$this->loader->add_filter( 'upload_dir', $plugin_admin, 'resume_photo_upload_dir' );

//		$this->loader->add_filter( 'plugins_api_args', $plugin_admin, 'plugins_api_args_filter' );


//		$this->loader->add_action( 'wp_ajax_codeneric_img_install_premium', $plugin_admin, 'premium_ajax_install' );

//		$this->loader->add_action( 'codeneric/img/watermark', $plugin_admin, 'watermark', 10, 1);

//		$this->loader->add_action( 'wp_ajax_codeneric_img_check_email', $plugin_admin, 'check_email' );





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

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Infinite_Masonry_Gallery_Base_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'wp_ajax_nopriv_img_star_photo', $plugin_public, 'star_photo_cb' );

		$this->loader->add_action( 'wp_ajax_nopriv_img_get_mini_thumbs', $plugin_public, 'get_mini_thumbs' );
		$this->loader->add_action( 'wp_ajax_img_get_mini_thumbs', $plugin_public, 'get_mini_thumbs' );


		$this->loader->add_filter( 'protected_title_format', $plugin_public, 'remove_protected_string' );



		$this->loader->add_action( 'codeneric_img_shortcode_enqueue_scripts', $plugin_public, 'enqueue_scripts', 10 ,1);
//		$this->loader->add_action( 'init', $plugin_public, 'posts_logout');



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
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Infinite_Masonry_Gallery_Base_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}



}
