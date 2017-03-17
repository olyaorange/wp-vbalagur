<?php

/**
 * Fired during plugin activation
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Infinite_Masonry_Gallery_Base
 * @subpackage Infinite_Masonry_Gallery_Base/includes
 * @author     Codeneric <support@codeneric.com>
 */



class Infinite_Masonry_Gallery_Base_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( get_option( 'cc_img_id' ) === false ) {
			$uniqid = uniqid('', true);
			$uniqid = str_replace('.','',$uniqid);
			update_option( 'cc_img_id', $uniqid );
		}

	}

}
