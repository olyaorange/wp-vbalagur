<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/admin
 * @author     Codeneric <support@codeneric.com>
 */

require_once(dirname(__FILE__).'/../includes/common.php');

class Infinite_Masonry_Gallery_Base_Admin {


	private $plugin_name;
	private $version;
	private $slug;

	public function __construct( $plugin_name='', $version='', $slug='') {
		global $cc_img_config;
		$this->plugin_name =    $cc_img_config['plugin_name'];
		$this->version     =    $cc_img_config['version'];
		$this->slug     =       $cc_img_config['slug'];



	}


	public function register_post_type() {
		register_post_type( $this->slug,
			array(
				'labels'             => array(
					'name'               => __('All galleries', $this->plugin_name),
					'singular_name'      => __('Gallery', $this->plugin_name),
					'menu_name'          => __('Infinite Masonry', $this->plugin_name),
	//				'name_admin_bar'     => __('d', $this->plugin_name),
					'all_items'          => __('All galleries', $this->plugin_name),
					'add_new'            => __('Add new gallery', $this->plugin_name),
					'add_new_item'       => __('Add new gallery', $this->plugin_name),
					'edit_item'          => __('IMG Gallery', $this->plugin_name),
//					'new_item'           => __('i', $this->plugin_name),
//					'view_item'          => __('j', $this->plugin_name),
					'search_items'       => __('Search galleries', $this->plugin_name),
					'not_found'          => __('No gallery found', $this->plugin_name)
					//'not_found_in_trash' => __('m', $this->plugin_name),
//					'parent_item_colon'  => __('n', $this->plugin_name),
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'query_var'          => true,
				'can_export'         => true,
				'has_archive'        => false,
				'menu_icon'          => 'dashicons-camera',
				'rewrite'            => array( 'slug' => $this->slug, 'with_front' => false ),
				'supports'           => array(
					'title' => false,
					'editor' => false
				),
				'taxonomies'         => array( '' ),
			)
		);

	}


	public function add_meta_boxes() {
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/client.php';
//		add_meta_box(  $this->plugin_name.'-client', __('Client Information', $this->plugin_name), 'codeneric_img_admin_client', $this->slug, 'normal', 'high' );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/project.php';
		add_meta_box(  $this->plugin_name.'-project', __('Gallery', $this->plugin_name), 'codeneric_img_admin_project', $this->slug, 'normal', 'high' );
	}

	public function save_meta_box_data($post_id) {




		if(get_post_type($post_id) != $this->slug)
			return; // not our business

		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;


		$this->save_projects($post_id);
//		$this->save_client($post_id);


	}

	public function save_projects($post_id){
		$GALLERY = isset($_POST['gallery']) ? $_POST['gallery'] : array() ;
		$GALLERY['images'] = isset($_POST['gallery']['images']) ? $_POST['gallery']['images'] : '' ;
		$GALLERY['images'] = explode(',',$GALLERY['images']);
		if(count($GALLERY['images'])=== 1 && empty($GALLERY['images'][0]))
			$GALLERY['images'] = array();


		update_post_meta( $post_id, 'gallery', $GALLERY );
	}




	// also used by premium
	public static function generate_frontend_globals($post) {
		global $cc_img_config;
		$config = $cc_img_config;
		// INJECT VARS TO JS
		$imgGlobals = array();

		// is not true if we are in premium-tab, where we still need some vars for modal display
		if(isset($post)) {

			$imgGlobals['post_id'] = $post->ID;
			$imgGlobals['gallery'] = Infinite_Masonry_Gallery_Base_Admin::prepareProjectsForFrontend($post->ID);
			$data = get_option('codeneric/img/canned-email-sent', array());
			$imgGlobals['canned_email_sent'] = in_array($post->ID, $data);

			$options = get_option('cc_img_settings', array());
			$cannedEmail = isset($options['canned_email']) ? $options['canned_email'] : '';
			$cannedEmail = trim($cannedEmail);
			$imgGlobals['canned_email_empty'] = $cannedEmail === '';
			$imgGlobals['portal_page'] = isset($options['cc_img_portal_page']) ? $options['cc_img_portal_page'] : '';
			$imgGlobals = apply_filters('codeneric/img/statistics/append', $imgGlobals);

		}


		$imgGlobals['id'] = get_option( 'cc_img_id' );

		$imgGlobals['pages'] = get_pages();

		$imgGlobals['admin_email'] = get_option('admin_email');

		$imgGlobals['assets'] = plugin_dir_url( __FILE__ ).'../assets/';

		$adminurl = admin_url( 'edit.php' );
		$imgGlobals['premium_url'] = add_query_arg( array('post_type' => $config['slug'], 'page' => 'premium'), $adminurl);
		$imgGlobals['support_url'] = add_query_arg( array('post_type' => $config['slug'], 'page' => 'support'), $adminurl);

//			$config = get_option('cc_img_config');

		//wp_localize_script( $this->plugin_name . '-admin', 'cc_wpps_url', $config['wpps_url'] );


//		$imgGlobals['wpps_url'] = str_replace('http://', 'https://', $config['wpps_url']);
		$imgGlobals['landing_url'] = $config['landing_url'];

		$imgGlobals['locale'] = get_locale();
		$imgGlobals['has_premium_ext'] = $config['has_premium_ext'];


//		function isSecure() {
//			return
//				( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' )
//				|| $_SERVER['SERVER_PORT'] == 443;
//		}
		$isSecure =
				( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' )
				|| $_SERVER['SERVER_PORT'] == 443;

		$return_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$return_url = $isSecure ? "https://$return_url" : "http://$return_url";
		$return_url = add_query_arg( 'paid', 'yes', $return_url );

		$imgGlobals['paypal_return'] = $return_url;
		$imgGlobals['paypal_merchant'] = $config['paypal_merchant'];
		$imgGlobals['paypal_post_url'] = $config['paypal_post_url'];
		$imgGlobals['paypal_env'] = $config['paypal_env'];

		$imgGlobals['stripe_key'] = $config['stripe_key'];



		return $imgGlobals;
	}
	// also used by premium
	public static function prepareProjectsForFrontend($post_id) {

		$gallery = get_post_meta( $post_id, "gallery", true );

//		die(var_dump($gallery));
		$res = $gallery;
		if(!is_array($gallery)) $gallery = array('images' => array());

		$res['images'] = array();

		foreach ( $gallery['images'] as $index_2 => $attachID ) {
			$attachment     = Infinite_Masonry_Gallery_Base_Common::get_full_and_thumb_image( intval( $attachID ) );
			$attachment->id = $attachID;
			//print_r($attachment);
			$res['images'][] = $attachment;
			//print_r($projects);
			//array_push($gallery, $attachment->thumb);
		}


		$res['id'] = $post_id;

	return $res;
}

	public function enqueue_scripts() {
		global $pagenow, $typenow, $cc_img_config;
		$config = $cc_img_config;

		// only include if its our slug
		if($typenow == $cc_img_config['slug'] ) {


				wp_enqueue_script( 'dashicons' );
				wp_enqueue_media();
				wp_enqueue_script('jquery-ui-accordion', array('jquery'));



				$post = get_post();
				$imgGlobals = Infinite_Masonry_Gallery_Base_Admin::generate_frontend_globals($post);


			$scriptname = '';
			// we are in either new post or edit post
			if($pagenow == 'post-new.php' || $pagenow == 'post.php') {
				$scriptname = $cc_img_config['plugin_name'] . '-admin';
				wp_register_script( $scriptname, $config['js_admin_entry'], array('jquery','media-upload'), $this->version, true );

			}


			if(isset($_GET['page']) && $_GET['page'] === 'premium') {
				$scriptname = $cc_img_config['plugin_name'] . '-premium-page';

				wp_register_script($scriptname, $config['js_admin_premium_page_entry'], array('jquery','media-upload'), $this->version, true );

			}



			// localize all
			wp_localize_script($scriptname, 'IMG_GLOBALS', $imgGlobals );
			wp_enqueue_script($scriptname);

		}
		if($pagenow === 'plugins.php'){
			$scriptname = $cc_img_config['plugin_name'] . '-plugins';
			$js_url = plugin_dir_url( __FILE__ ).'js/ask-before-deactivation.js';
			wp_register_script( $scriptname, $js_url, array('jquery'), $this->version, true );
			wp_enqueue_script($scriptname);
		}
	}
	public function enqueue_styles() {
		global $pagenow, $typenow, $cc_img_config;
		$page = $_GET;

		if($typenow == $this->slug && isset($_GET['page']) && ($_GET['page'] === 'options' ||  $_GET['page'] === 'premium' || $_GET['page'] === 'support') )
			wp_enqueue_style( $cc_img_config['plugin_name'].'-admin', plugin_dir_url( __FILE__ ) . 'style/admin.css', array(), $this->version, 'all' );



		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/infinite-masonry-gallery-admin.css', array(), $this->version, 'all' );

	}

	public function dequeue_files() {
//        global $wp_scripts;
//    foreach( $wp_scripts->queue as $handle ) :
//        echo $handle . ' | ';
//    endforeach;
//
//    echo "<br> END OF SCRiPTS <br>";
//
//    global $wp_styles;
//    foreach( $wp_styles->queue as $handle ) :
//        echo $handle . ' | ';
//    endforeach;

//		require_once( dirname( __FILE__ ) . '/../../config.php' );
//
//		$wl = codeneric_img_get_styles_wl();
//		global $wp_styles;
//
//		foreach( $wp_styles->queue as $handle ){
//			if(!in_array($handle,$wl)){
//				wp_dequeue_style( $handle );
//				//wp_deregister_style($handle);
//				// echo "dequeuing: $handle<br>";
//			}else{
//				//echo "enqueuing: $handle<br>";
//			}
//		}
//
//
//
//
//		$wl = codeneric_img_get_scripts_wl();
//		global $wp_scripts;
//		foreach( $wp_scripts->queue as $handle ){
//			if(!in_array($handle,$wl)){
//				wp_dequeue_script( $handle );
//			}
//		}



	}


	public function fill_custom_columns( $column, $post_id ) {
		global $cc_img_config;
		$client = get_post_meta( $post_id, $cc_img_config['slug'], true );

		$title = get_the_title($post_id);
		// edit_post_link does not work on all servers apparantely
		$name = isset( $title ) ? $title : "not published";
		$link = get_edit_post_link( $post_id );
		switch ( $column ) {
			case "full_name":
				echo '<a class="post-edit-link" href="'.$link.'">'.$name.'</a>';
				break;
			case "shortcode":
				echo '[cc_img_gallery id="' . $post_id . '"]';
				break;
//			case "email":
//				echo isset( $client['email'] ) ? $client['email'] : "not published";
//				break;
//			case "projects":
//				$projects = get_post_meta( $post_id, "projects", true );
//				if ( ! is_array( $projects ) ) {
//					$projects = array();
//				}
//				$project_titles   = array();
//				$client_permalink = get_post_permalink( $post_id );
//				foreach ( $projects as $key => $project ) {
//					if ( isset( $project['title'] ) ) {
//						array_push( $project_titles, '<a href="' . add_query_arg( 'project', $key, $client_permalink ) . '">' . $project['title'] . '</a>' );
//					}
//				}
//				echo implode( ', ', $project_titles );
//				break;
		}
	}

	public function define_table_columns( $column_name ) {
		//die($column_name);
		$cols = array(
			'cb'        => '<input type="checkbox" />',
			'full_name'     => __( 'Name' ),
//			'projects'      => __( 'Projects' , $this->plugin_name),
//			'email'      => __( 'Email' ),
			'shortcode' => __( 'Shortcode' ),
		);

		return $cols;
	}

	public function deleted_client( $postid ){




		// My custom stuff for deleting my custom post type here
	}

	public function add_support_page(){
		require_once(dirname(__FILE__).'/subpages/support.php');
		$s_p = new Infinite_Masonry_Gallery_Base_Support($this->plugin_name, $this->version, $this->slug);
		$s_p->add_support_page();
	}

	public function add_settings_page(){
		require_once(dirname(__FILE__).'/subpages/options.php');
		$s_p = new Infinite_Masonry_Gallery_Base_Options($this->plugin_name, $this->version, $this->slug);
		$s_p->add_settings_page();
	}

	public function settings_init(){
		require_once(dirname(__FILE__).'/subpages/options.php');
		$s_p = new Infinite_Masonry_Gallery_Base_Options($this->plugin_name, $this->version, $this->slug);
		$s_p->settings_init();

	}

	public function add_premium_page(){
//		require_once(dirname(__FILE__).'/subpages/premium.php');
//		$s_p = new Infinite_Masonry_Gallery_Base_Premium($this->plugin_name, $this->version, $this->slug);
//		$s_p->add_premium_page();
//		remove_action( 'admin_notices', 'cc_img_base_admin_notice_update_to_premium', 9 );

	}

//	public function resume_photo_upload_dir( $param ) {
//		global $cc_img_config;
//		if(isset($_SERVER['HTTP_REFERER'])) {
//			$comps = parse_url($_SERVER['HTTP_REFERER']);
//			if(isset($comps['query'])){
//				parse_str($comps['query'],$query_params);
//				$new_post = (isset($query_params['post']) && get_post_type($query_params['post']) === $cc_img_config['slug']);
//				$edit_old_post = (isset($query_params['post_type']) && $query_params['post_type'] === $cc_img_config['slug']);
//				if($new_post || $edit_old_post){
//					add_image_size('img-fullscreen', 1600, 1600);
//					$mydir = '/infinite_masonry_gallery'.$param['subdir'];
//					$param['path'] = $param['basedir'] . $mydir;
//					$param['url'] = $param['baseurl'] . $mydir;
//				}
//			}
//		}
//
//		return $param;
//	}


	public function update_database(){
		require_once(dirname(__FILE__).'/DBUpdater.php');
		IMG_DBUpdater::updateClients();
	}




//	public function plugins_api_args_filter($args/*, $action*/){
//		var_dump($args);
////		var_dump($action);
//		return $args;
//	}








	/****************** AJAX HOOKS ***************/


	public function star_photo_cb() {
		Infinite_Masonry_Gallery_Base_Common::star_photo_cb();
	}




	public function send_feedback() {

		if (empty($_POST) ||
		    (!isset($_POST['cc_send_feedback_nonce']) && !isset($_POST['cc_transfer_license_nonce'])) ||
		    (!wp_verify_nonce($_POST['cc_send_feedback_nonce'], 'cc_send_feedback')
		     && !wp_verify_nonce($_POST['cc_transfer_license_nonce'], 'cc_send_feedback'))) {
			echo 'You targeted the right function, but sorry, your nonce did not verify.';
			die();
		} else {


			$data = $_POST['support'];
			$to = array('support@codeneric.com');
			$subject = 'IMG: '.$data['subject'];
			$headers[] = 'From: <'.$data['email'].'>';

			$message = $data['content'];

			global $cc_img_config;
			$adminurl = admin_url('edit.php');
			if(isset($_POST['cc_send_feedback_nonce'])){
				if(wp_mail( $to, $subject, $message, $headers))
					wp_redirect(add_query_arg( array('post_type' => $cc_img_config['slug'], 'page' => 'support', 'is_send' => "true"), $adminurl));
				else
					wp_redirect(add_query_arg( array('post_type' => $cc_img_config['slug'], 'page' => 'support', 'is_send' => "false"), $adminurl));
			}

			if(isset($_POST['cc_transfer_license_nonce'])){
				if(wp_mail( $to, $subject, $message, $headers))
					wp_redirect(add_query_arg( array('post_type' => $cc_img_config['slug'], 'page' => 'premium', 'is_send' => "true"), $adminurl));
				else
					wp_redirect(add_query_arg( array('post_type' => $cc_img_config['slug'], 'page' => 'premium', 'is_send' => "false"), $adminurl));
			}


			// do your function here

		}
	}





	public function get_attachment() {
		//todo whole workflow a bit messy
		$attachIDArray = $_POST['attachID'];
		if ( is_array( $attachIDArray ) ) {
			$res = array();
			foreach ( $attachIDArray as $i => $attachID ) {
				$temp = Infinite_Masonry_Gallery_Base_Common::get_full_and_thumb_image( intval( $attachID ) );
				array_push( $res, $temp );

			}
			header( "Content-Type: application/json" );
			echo json_encode( $res );
			exit;

		} else {
			$attachID = intval( $attachIDArray );
			$res      = Infinite_Masonry_Gallery_Base_Common::get_full_and_thumb_image( intval( $attachID ) );
			header( "Content-Type: application/json" );
			echo json_encode( $res );
			exit;
		}

	}

	


}
