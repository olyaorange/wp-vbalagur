<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/public
 * @author     Codeneric <support@codeneric.com>
 */
class Infinite_Masonry_Gallery_Base_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;



	}

	public function generate_frontend_variables($gallery_id) {
		global $cc_img_config;
		$options = get_option('cc_img_settings');
//		if(!is_singular( $cc_img_config['slug'])) //todo return if not on single-client. CAUTION: client portal needs adjustment
//			return;

//		$cc_img_client_id = get_the_ID();;

		$preloadCount = 10;

		$obj = new stdClass();
		$obj->name = get_the_title($gallery_id); // worky
		$obj->ID = $gallery_id;

		$obj->gallery = get_post_meta( $gallery_id, "gallery", true ); // worky
		$obj->gallery = is_array($obj->gallery) ? $obj->gallery : array();
		$obj->gallery['images'] = isset($obj->gallery['images']) ? $obj->gallery['images'] : array();



		$obj->ajax_url = admin_url( 'admin-ajax.php' );
		$obj->locale = get_locale();
		$obj->preloadCount = $preloadCount;

		$download_url = wp_upload_dir();
		$obj->download_url_base = $download_url['baseurl']."/infinite_masonry_gallery/";


		$obj->gallery['imageIDs'] = $obj->gallery['images'];
		$initialImgs = array_slice($obj->gallery['images'], 0, $preloadCount);
		$obj->gallery['images'] = $this->get_mini_thumbs($initialImgs, $gallery_id);

		if( !isset($options['cc_img_slider']))
			$obj->disableSlider = true;

//		foreach ($obj->gallery['images'] as $index => $project) {
////			$project['ID'] = $index; // todo Assuming index is id;
//
////			$obj->gallery['images'][$index]['ID'] = $project;
//
//
//			// thumbnail was set as premium
//			$obj->gallery['images'][$index] = $this->get_mini_thumbs($gallery_id);
////			if(isset($project['thumbnail'])) {
////				$obj->projects[$index]['thumbnail'] = $this->get_mini_thumbs(array($project['thumbnail']), $gallery_id, $project['ID']);
////				$obj->projects[$index]['thumbnail'] = $obj->projects[$index]['thumbnail'][0];
////			}
////			//take first gallery entry
////			elseif (count($project['gallery']) > 0) {
////				$obj->projects[$index]['thumbnail'] = $this->get_mini_thumbs(array($project['gallery'][0]), $gallery_id, $project['ID']);
////				$obj->projects[$index]['thumbnail'] = $obj->projects[$index]['thumbnail'][0];
////			}
//
//			// otherwise placeholder?
//
//		}






//		if( !isset($options['cc_img_slider']))
//			$obj->disableSlider = true;
//
//
//		//$obj->isProjectView = isset($_GET['project']);
//
//		if(isset($_GET['project'])) {
//			$obj->currentProject = $_GET['project'];
//
//			$initialImgs = array_slice($obj->projects[$_GET['project']]['gallery'], 0, $preloadCount);
//
//			$obj->projects[$_GET['project']]['preloadedGallery'] = $this->get_mini_thumbs($initialImgs, $gallery_id, $_GET['project']);
//		}


//		$post = get_post($gallery_id);
//		$isPortal = $options['cc_img_portal_page'] == get_the_ID();


//		if(!empty($post->post_password)) {
//
//			if($isPortal) // current page is portal
//				$obj->logout_url = wp_logout_url(get_permalink(get_the_ID()));
//			else // shortcode or singular
//				$obj->logout_url = $this->posts_logout_url();
//		}


//		if(($isPortal || is_singular($cc_img_config['slug'])) && isset($_GET['project']))
//			$obj->canGoBack = true;
//





		return json_decode(json_encode($obj), true); // convert stdObj to array

	}

	


public function enqueue_styles() {

//		wp_enqueue_style( $this->plugin_name.'-public', plugin_dir_url( __FILE__ ) . 'style/public.css');

	}



	public function remove_protected_string() {
		return __('%s');
	}
	public function enqueue_scripts($id) {
		global $cc_img_config;

		$cc_img_client_id =  empty($id) ? get_the_ID() :$id;
		$options = get_option('cc_img_settings', array());




		if(empty($id)) { // could be a normal page
			if(!is_singular($cc_img_config['slug'])) return;
		}




		$user_can_access_post = apply_filters('codeneric/img/check_user_permission', $cc_img_client_id);


		if(!$user_can_access_post)
			return; // prevent react from failing because of missing DOM

		$correctJSFile = $cc_img_config['premium_ext_active']
			?  $cc_img_config['js_public_entry_premium']
			:  $cc_img_config['js_public_entry'];






		wp_register_script( $this->plugin_name.'-public', $correctJSFile, array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name.'-public', '__CC_IMG_VARS__', $this->generate_frontend_variables($cc_img_client_id) );
		wp_enqueue_script($this->plugin_name.'-public');



	}

	public function star_photo_cb() {
		Infinite_Masonry_Gallery_Base_Common::star_photo_cb();
	}





	public function get_mini_thumbs($attach_ids=array(), $gallery_id='0'){

//		if(!isset($client_id) || !isset($project_id)){
//			throw new Exception('get_mini_thumbs expects three parameters.');
//		}
		require_once(dirname(__FILE__).'/../includes/common.php');
		if(isset($_POST['attach_ids']) && isset($_POST['gallery_id']) ) {
			$attach_ids = $_POST['attach_ids'];
			$gallery_id = $_POST['gallery_id'];

			$buffer = 1024 * 8;
			header('Content-Description: File Transfer');
//		header( 'Content-Type: application/octet-stream' );
			header('Content-Type: application/json');
			//header( 'Content-Disposition: attachment; filename="' . basename( $filename ) . '"' );
			echo '[ ';
			$first = true;
			foreach ($attach_ids as $id) {

				$res = Infinite_Masonry_Gallery_Base_Common::get_minithumb_obj($id, $gallery_id);
				if ($res === false)
					continue;
				if (!$first) echo " , ";
				$first = false;
				$json = json_encode($res);
				echo $json;

				flush();

			}

			echo ' ]';

			exit;
		}else{
			$final_res = array();
//			$first = true;
			foreach ($attach_ids as $id) {

				$res = Infinite_Masonry_Gallery_Base_Common::get_minithumb_obj($id, $gallery_id);
				if ($res === false)
					continue;
				array_push($final_res, $res);
//				$final_res[$id] = $res;

			}

			return $final_res;

		}

	}



}
