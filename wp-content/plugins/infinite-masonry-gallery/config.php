<?php

//TODO(denis) make class

class Infinite_Masonry_Gallery_Base_Config
{
    /**
     * Generates globally accessible config-data.
     *
     * @since    1.0.0
     * @access   public
     */



    public static function set($env){
        if ( ! function_exists( 'get_plugins' ) ) {
        	require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $env = $env !== 'production' ? 'development' : 'production';

        $all_plugins = get_plugins();
        $plugin_data = get_plugin_data(dirname(__FILE__) .'/infinite-masonry-gallery.php');
//        $this->version = $plugin_data['Version'];
//       var_dump($all_plugins);
        $img_premium_key = 'infinite-masonry-gallery-premium/infinite_masonry_gallery-premium.php';
        $has_premium_ext = isset($all_plugins[$img_premium_key]);
        $a_p = get_option('active_plugins');
//        $premium_ext_active = isset($a_p[$img_premium_key]);
        $the_plugs = get_site_option('active_sitewide_plugins'); //multisite;
        $premium_ext_active = in_array($img_premium_key, $a_p) || isset($the_plugs[$img_premium_key]);

        $premium_version = '0.0.0'; // so php doesnt cry
        if ( file_exists( dirname( __FILE__ ) . '/../' . $img_premium_key ) ) {

            $premium_data = get_plugin_data( dirname( __FILE__ ) . '/../' . $img_premium_key );

            $premium_version = $premium_data['Version'];
        }






        $config = array(
            "development" => array(
                "env" => "development",
                "landing_url" => 'https://sandbox.img.codeneric.com',
                "slug" => "cc_img_gallery",
                "plugin_name" => "infinite-masonry-gallery",
                "premium_plugin_name" => "infinite-masonry-gallery-premium",
                "plugin_slug_abbr" => "img",
                "version" => $plugin_data['Version'],
                "has_premium_ext" => $has_premium_ext,
                "premium_ext_active" => $premium_ext_active,
//                "premium_plugin_key" => 'latest/hello_KRASS.php',
                "premium_plugin_key" => $img_premium_key,
                "update_check_cool_down" => 5,
                "js_admin_entry"              => 'http://localhost:3000/entry.edit.js',
                "js_admin_premium_page_entry" => 'http://localhost:3000/entry.premium-page.js',
                "js_public_entry"             => 'http://localhost:3000/entry.public.js',
                "js_admin_entry_premium"      => 'http://localhost:3001/entry.edit.js',
                "js_public_entry_premium"     => 'http://localhost:3001/entry.public.js',

                "paypal_merchant" => "elance-facilitator@codeneric.com",
                "paypal_post_url" => "https://www.sandbox.paypal.com/cgi-bin/webscr",
                "paypal_env"      => "sandbox",

                "stripe_key" => "pk_test_uyLxBWH0UDBwlaXCzdmAzsjv"
            ),
            "production" => array(
                "env" => "production",
                "landing_url" => 'https://img.codeneric.com',
                "slug" => "cc_img_gallery",
                "plugin_name" => "infinite-masonry-gallery",
                "premium_plugin_name" => "infinite-masonry-gallery-premium",
                "plugin_slug_abbr" => "img",
                "version" => $plugin_data['Version'],
                "has_premium_ext" => $has_premium_ext,
                "premium_ext_active" => $premium_ext_active,
                "premium_plugin_key" => $img_premium_key,
                "update_check_cool_down" => 60 * 60,
                "js_admin_entry"              => plugin_dir_url( __FILE__ ) . '/admin/js/edit.bundle.base-' . $plugin_data['Version'] . '.min.js',
                "js_public_entry"             => plugin_dir_url( __FILE__ ) . '/public/js/public.bundle.base-' . $plugin_data['Version'] . '.min.js',
                "js_admin_premium_page_entry" => plugin_dir_url( __FILE__ ) . '/admin/js/premium-page.bundle.base-' . $plugin_data['Version'] . '.min.js',
                "js_admin_entry_premium"      => plugin_dir_url( __FILE__ ) . '../infinite-masonry-gallery-premium/admin/js/edit.bundle.premium-' . $premium_version . '.min.js',
                "js_public_entry_premium"     => plugin_dir_url( __FILE__ ) . '../infinite-masonry-gallery-premium/public/js/public.bundle.premium-' . $premium_version . '.min.js',


                "paypal_merchant" => "elance@codeneric.com",
                "paypal_post_url" => "https://www.paypal.com/cgi-bin/webscr",
                "paypal_env"      => "www",

                "stripe_key" => 'pk_live_dvPEBGQnKz9rpcoddxTJ21Rf'

            )

        );


//        $GLOBALS["cc_img_config"] = $config[$env];
        return $config[$env];
    }




//    public static function get_config()
//    {
//
//        $env = 'development';
//
//
//        $config = array(
//            "development" => array(
//                "wpps_url" => 'https://headgame.draco.uberspace.de/sandbox.wpps'
//            ),
//            "production" => array(
//                "wpps_url" => 'https://headgame.draco.uberspace.de/wpps'
//            )
//        );
//
//
//        $config = $config[$env];
//        return $config;
//    }
//
//    public static function codeneric_img_get_scripts_wl()
//    {
//        return array('common', 'admin-bar', 'post',
//            'utils', 'svg-painter', 'wp-auth-check',
//            'media-editor', 'media-audiovideo',
//            'mce-view', 'image-edit', 'media-upload',
//            'jquery', 'wp-pointer', 'stripe',
//            'jquery-ui');
//    }
//    public static function codeneric_img_get_styles_wl()
//    {
//        return array('admin-bar', 'colors', 'ie', 'wp-auth-check',
//            'media-views', 'imgareaselect', 'metabox-css',
//            'wp-pointer');
//    }
}