<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Balagur_2016
 * @since Balagur 2016 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="vb-site">
    <?php if( !is_404() ){?>
        <nav id="site-navigation" class="vb-main-navigation" role="navigation"
             aria-label="<?php esc_attr_e('Primary Menu', 'balagur2016'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'vb-primary-menu',
                'items_wrap' => '<h2 class="vb-menu-mainmenu-title">Меню</h2><ul class="%2$s">%3$s</ul>',
            ));
            ?>
        </nav><!-- .vb-main-navigation -->
    <?php }?>
    <div class="vb-site-inner">
        <?php /*
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'balagur2016' ); ?></a>
        */ ?>

        <?php if( !is_404() ){?>
            <header id="masthead" class="vb-header" role="banner">
                <div class="vb-header-main container">
                    <div class="vb-header-wrapper">
                        <div class="vb-header-item">
                            <?php if (has_nav_menu('primary')) : ?>
                                <button id="menu-toggle" class="vb-menu-toggle">
                                    <span></span><?php _e('Меню', 'balagur2016'); ?></button>
                            <?php endif; ?>
                        </div>
                        <div class="vb-header-item">
                            <div class="text-center">
                                <?php balagur2016_the_custom_logo(); ?>
                            </div>
                        </div>
                        <div class="vb-header-item">
                            <nav id="social-navigation" class="vb-social-navigation vb-soc-wrapper-color" role="navigation">
                                <ul class="list-unstyled list-inline text-right">
                                    <li>
                                        <a rel="nofollow" target="_blank"
                                           href="https://www.facebook.com/vlad.balagur"
                                           class="soc-icon soc-icon-fcb-wrapper">
                                            <svg version="1.1" id="Layer_1" class="soc-icon-fcb"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;"
                                                 xml:space="preserve">
                                            <g>
                                                <linearGradient id="SVGID_11_" gradientUnits="userSpaceOnUse"
                                                                x1="28.7926" y1="575.2089"
                                                                x2="385.2089" y2="218.7927">
                                                    <stop offset="0"/>
                                                    <stop offset="1"/>
                                                </linearGradient>
                                                <path class="st0" d="M436.3,270.4l-224-128c-3.3-1.9-7.3-1.9-10.6,0l-224,128c-3.3,1.9-5.4,5.4-5.4,9.3v234.7c0,3.8,2,7.4,5.4,9.3
                                                l224,128c1.6,0.9,3.5,1.4,5.3,1.4s3.6-0.5,5.3-1.4l224-128c3.3-1.9,5.4-5.4,5.4-9.3V279.7C441.7,275.8,439.6,272.3,436.3,270.4z
                                                 M420.3,508.1L207,630L-6.3,508.1V285.9L207,164l213.3,121.9V508.1z"/>
                                            </g>
                                                <g id="facebook">
                                                    <linearGradient id="SVGID_12_" gradientUnits="userSpaceOnUse"
                                                                    x1="113.6656"
                                                                    y1="497.0446" x2="329.2756" y2="281.4346">
                                                        <stop offset="0"/>
                                                        <stop offset="1"/>
                                                    </linearGradient>
                                                    <path class="st1" d="M284.8,239.9l-47.2,0c0,0-1-0.1-2.7-0.1c-9.7,0-58.6,2.7-71.9,55.2c-0.2,0.6-4.7,13.7-4.8,44.3h-44.7
                                                c-4,0-7.2,3.2-7.2,7.2v41.2c0,4,3.2,7.2,7.2,7.2h48.9v148c0,4,3.2,7.2,7.2,7.2h56c4,0,7.2-3.2,7.2-7.2V395H282
                                                c4,0,7.2-3.2,7.2-7.2v-41.4c0-4-3.2-7.2-7.2-7.2h-49v-17.7c0-11.8,7.5-24.4,28.5-24.4h23.4c4,0,7.2-3.2,7.2-7.2v-42.9
                                                C292,243.2,288.8,239.9,284.8,239.9z M277.6,282.9h-16.2c-29.6,0-42.8,19.5-42.8,38.7v24.9c0,4,3.2,7.2,7.2,7.2h49v27h-49.1
                                                c-4,0-7.2,3.2-7.2,7.2v147.9h-41.6v-148c0-4-3.2-7.2-7.2-7.2h-48.9v-26.8h44.8c1.9,0,3.8-0.8,5.1-2.2c1.4-1.4,2.1-3.2,2.1-5.2
                                                c-0.6-32.7,3.9-46.5,4.1-47.2c10.6-41.7,47.2-44.9,58.2-44.9c1,0,1.6,0,2.2,0.1h40.5V282.9L277.6,282.9z"/>
                                                </g>
					                    </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a rel="nofollow" target="_blank" href="https://vk.com/id22248793"
                                           class="soc-icon soc-icon-vk-wrapper">
                                            <svg version="1.1" id="Layer_2" class="soc-icon-vk" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;"
                                                 xml:space="preserve">
                                            <g>
                                                <linearGradient id="SVGID_13_" gradientUnits="userSpaceOnUse" x1="28.7926" y1="575.2089"
                                                                x2="385.2089" y2="218.7927">
                                                    <stop offset="0"/>
                                                    <stop offset="1"/>
                                                </linearGradient>
                                                <path class="st0" d="M436.3,270.4l-224-128c-3.3-1.9-7.3-1.9-10.6,0l-224,128c-3.3,1.9-5.4,5.4-5.4,9.3v234.7c0,3.8,2,7.4,5.4,9.3
                                                l224,128c1.6,0.9,3.5,1.4,5.3,1.4s3.6-0.5,5.3-1.4l224-128c3.3-1.9,5.4-5.4,5.4-9.3V279.7C441.7,275.8,439.6,272.3,436.3,270.4z
                                                 M420.3,508.1L207,630L-6.3,508.1V285.9L207,164l213.3,121.9V508.1z"/>
                                            </g>
                                                <g>
                                                    <linearGradient id="SVGID_14_" gradientUnits="userSpaceOnUse" x1="134.3947"
                                                                    y1="474.5912"
                                                                    x2="333.6051" y2="275.3808">
                                                        <stop offset="0"/>
                                                        <stop offset="1"/>
                                                    </linearGradient>
                                                    <path class="st1" d="M360.3,452.2c-7.3-8.8-15.6-16.6-23.6-24.2c-2.8-2.7-5.7-5.4-8.5-8.2c0,0,0,0,0,0c-3.8-3.7-5.6-6.3-5.8-8.2
                                                c-0.2-1.9,1.1-4.7,4.1-8.9c4.5-6.2,9.2-12.5,13.8-18.6c4.1-5.4,8.3-10.9,12.3-16.5l0.9-1.3c7.9-10.9,16-22.2,20.4-36
                                                c1.2-3.9,2.5-9.8-0.6-14.9c-3.1-5.1-8.9-6.6-13-7.3c-2-0.3-3.9-0.4-5.7-0.4l-51.2,0c-8.8-0.1-15,4-18.3,12.5
                                                c-2.7,6.7-5.8,14.5-9.5,21.9c-7,14.3-15.9,30.7-28.8,44.4l-0.6,0.6c-0.9,0.9-2.3,2.5-3.1,2.8c-1.4-0.9-3-5.9-2.9-8.5
                                                c0-0.1,0-0.1,0-0.2l0-59.1c0-0.3,0-0.6-0.1-0.9c-1.1-8.4-3.4-16.9-16.7-19.5c-0.4-0.1-0.9-0.1-1.3-0.1H169c-10,0-15.3,4.6-19.6,9.6
                                                c-1.2,1.4-4.5,5.3-2.8,10c1.7,4.8,6.7,5.7,8.3,6c5.8,1.1,8.8,4.4,9.7,10.6c1.8,12.2,2.1,25.2,0.7,41c-0.4,4.2-1.1,7.5-2.2,10.1
                                                c-0.3,0.7-0.6,1.2-0.8,1.5c-0.3-0.1-0.8-0.4-1.4-0.8c-4.1-2.8-7.1-7.1-10.1-11.3c-11.9-16.7-21.8-35.2-30.5-56.6
                                                c-3.6-8.7-10.3-13.6-18.9-13.7c-16.4-0.3-31.5-0.3-46.3,0c-7,0.1-11.9,2.3-14.5,6.5c-2.7,4.2-2.6,9.6,0.3,16
                                                c20.5,45.6,39.1,78.8,60.4,107.6c15,20.3,30,34.3,47.4,44.3c18.3,10.4,38.8,15.6,62.7,15.6c2.7,0,5.5-0.1,8.3-0.2
                                                c14.7-0.7,20.7-6.5,21.4-20.9c0.4-7.6,1.2-13.7,4.1-19.1c0.8-1.5,1.7-2.5,2.5-2.7c0.8-0.2,2.1,0.3,3.7,1.3c2.8,1.8,5.2,4.3,7.2,6.4
                                                c2,2.2,4,4.5,6,6.7c4.2,4.7,8.5,9.5,13,14.1c10.2,10.4,22,15.2,35,14.2l46.8,0c0,0,0,0,0,0c0.1,0,0.3,0,0.4,0
                                                c5.4-0.4,10.1-3.3,12.8-8.2c3.3-5.8,3.3-13.3-0.1-19.8C369,463,364.4,457.1,360.3,452.2z M361,483c-0.6,1.1-1.4,1.4-1.9,1.4
                                                l-46.8,0c0,0,0,0,0,0c-0.2,0-0.4,0-0.6,0c-9.2,0.8-17.1-2.5-24.6-10.2c-4.3-4.4-8.5-9.1-12.6-13.6c-2-2.2-4-4.5-6.1-6.8
                                                c-2.6-2.8-5.7-6-9.8-8.6c-6.1-3.9-11.1-3.8-14.3-3c-3.1,0.8-7.6,3-11,9.2c-4.4,8-5.4,16.7-5.8,24.9c-0.2,5-1.1,6.3-1.4,6.7
                                                c-0.5,0.4-2,1.2-7.2,1.5c-24.8,1.2-45.7-3.3-63.7-13.6c-15.7-9-29.4-21.9-43.3-40.6c-20.7-28-38.8-60.4-58.9-105.1
                                                c-0.7-1.6-1-2.6-1-3.2c0.5-0.2,1.5-0.4,3.3-0.4c14.6-0.3,29.6-0.3,45.9,0c2.2,0,4.8,0.7,6.7,5.4c9.1,22.3,19.5,41.6,32,59.2
                                                c3.3,4.7,7.4,10.5,13.5,14.6c5.5,3.8,10,3.6,12.8,2.8c2.8-0.8,6.7-3.1,9.3-9.3c1.7-4,2.7-8.5,3.2-14.2c1.4-16.9,1.2-30.9-0.8-44.1
                                                c-1.4-9.5-6.3-16.3-14-19.8c1.4-0.7,2.9-1,5.1-1h52.5c3,0.7,3.5,1.4,3.7,1.7c0.9,1.1,1.3,3.8,1.6,5.9l0,58.6
                                                c-0.1,5.6,2.6,18.1,11.9,21.5c0.1,0,0.2,0.1,0.2,0.1c8.5,2.8,14.1-3.2,17.1-6.4l0.5-0.6c14.1-15,23.6-32.5,31.1-47.7
                                                c3.9-7.8,7.2-15.9,9.9-22.9c1.4-3.5,2.7-4.1,5.7-4c0,0,0.1,0,0.1,0l51.2,0c1.2,0,2.4,0,3.4,0.2c2.4,0.4,3.4,0.9,3.8,1.1
                                                c0,0.4,0,1.5-0.7,3.8c-3.7,11.7-10.9,21.6-18.5,32.2l-0.9,1.3c-3.9,5.5-8.1,11-12.2,16.3c-4.6,6.1-9.5,12.5-14,18.9
                                                c-9.7,13.6-8.9,22.6,3.3,34.5c2.9,2.8,5.8,5.6,8.7,8.3c8.1,7.6,15.7,14.9,22.5,23c3.6,4.3,7.6,9.5,10.5,15.1
                                                C362.1,478.9,361.7,481.6,361,483z"/>
                                                </g>
					                    </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a rel="nofollow" target="_blank" href="https://instagram.com/vladislav_balagur/"
                                           class="soc-icon soc-icon-insta-wrapper">
                                            <svg version="1.1" id="Layer_1" class="soc-icon-insta"
                                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 x="0px" y="0px"
                                                 viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;"
                                                 xml:space="preserve">
                                            <g>
                                                <linearGradient id="SVGID_15_" gradientUnits="userSpaceOnUse" x1="28.7926" y1="575.2089"
                                                                x2="385.2089" y2="218.7927">
                                                    <stop offset="0"/>
                                                    <stop offset="1"/>
                                                </linearGradient>
                                                <path class="st0" d="M436.3,270.4l-224-128c-3.3-1.9-7.3-1.9-10.6,0l-224,128c-3.3,1.9-5.4,5.4-5.4,9.3v234.7c0,3.8,2,7.4,5.4,9.3
                                                l224,128c1.6,0.9,3.5,1.4,5.3,1.4s3.6-0.5,5.3-1.4l224-128c3.3-1.9,5.4-5.4,5.4-9.3V279.7C441.7,275.8,439.6,272.3,436.3,270.4z
                                                 M420.3,508.1L207,630L-6.3,508.1V285.9L207,164l213.3,121.9V508.1z"/>
                                            </g>
                                                <g id="instagram">
                                                    <linearGradient id="SVGID_16_" gradientUnits="userSpaceOnUse"
                                                                    x1="110.1029" y1="500.2505" x2="312.6039" y2="297.7496">
                                                        <stop offset="0"/>
                                                        <stop offset="1"/>
                                                    </linearGradient>
                                                    <path class="st1" d="M290.9,314.2h-21.5c-7,0-12.8,5.7-12.8,12.8v21.5c0,7,5.7,12.8,12.8,12.8h21.5c7,0,12.8-5.7,12.8-12.8v-21.5
                                                C303.7,319.9,298,314.2,290.9,314.2z M292.5,348.5c0,0.9-0.7,1.6-1.6,1.6h-21.5c-0.9,0-1.6-0.7-1.6-1.6v-21.5
                                                c0-0.9,0.7-1.6,1.6-1.6h21.5c0.9,0,1.6,0.7,1.6,1.6V348.5z M278.4,284.4H144.3c-27.7,0-50.3,22.6-50.3,50.3v128.6
                                                c0,27.7,22.6,50.3,50.3,50.3h134.2c27.7,0,50.3-22.6,50.3-50.3V334.7C328.8,307,306.2,284.4,278.4,284.4z M317.6,463.3
                                                c0,21.6-17.6,39.1-39.1,39.1H144.3c-21.6,0-39.1-17.6-39.1-39.1v-83.9h56.4c-10.7,11.9-17.2,27.5-17.2,44.7
                                                c0,37,30.1,67.1,67.1,67.1s67.1-30.1,67.1-67.1c0-17.2-6.6-32.8-17.2-44.7h56.4V463.3z M211.4,368.3c30.8,0,55.9,25.1,55.9,55.9
                                                c0,30.8-25.1,55.9-55.9,55.9s-55.9-25.1-55.9-55.9C155.4,393.3,180.5,368.3,211.4,368.3z M317.6,368.3h-69.2
                                                c-10.6-7-23.3-11.2-37-11.2c-13.7,0-26.4,4.1-37,11.2h-69.2v-33.5c0-21.6,17.6-39.1,39.1-39.1h134.2c21.6,0,39.1,17.6,39.1,39.1
                                                V368.3z M211.4,463.3c21.6,0,39.1-17.6,39.1-39.1c0-21.6-17.6-39.1-39.1-39.1s-39.1,17.6-39.1,39.1
                                                C172.2,445.7,189.8,463.3,211.4,463.3z M211.4,396.2c15.4,0,28,12.5,28,28c0,15.4-12.5,28-28,28s-28-12.5-28-28
                                                C183.4,408.7,195.9,396.2,211.4,396.2z"/>
                                                </g>
                                        </svg>
                                        </a>
                                    </li>
                                </ul>
                            </nav><!-- .vb-social-navigation -->
                        </div>
                    </div>
                    <?php /*
				<div class="site-branding">

					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
				*/ ?>
                </div><!-- .vb-header-main -->
            </header><!-- .vb-header -->
        <?php } ?>

        <div id="content" class="vb-site-content">
