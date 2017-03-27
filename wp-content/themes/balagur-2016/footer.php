<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Balagur_2016
 * @since Balagur 2016 1.0
 */
?>

		</div><!-- .vb-site-content -->

        <?php if( !is_404() ){?>
            <footer id="colophon" class="vb-site-footer vb-custom-bg" role="contentinfo">
                <div class="container">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <nav class="vb-secondary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'balagur2016' ); ?>">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'vb-secondary-menu list-inline',
                            ) );
                            ?>
                        </nav><!-- .vb-secondary-navigation -->
                    <?php endif; ?>

                    <div class="vb-site-info">
                        <?php
                        /**
                         * Fires before the balagur2016 footer text for footer customization.
                         *
                         * @since Balagur 2016 1.0
                         */
                        do_action( 'balagur2016_credits' );
                        ?>
                        <ul class="list-inline vb-footer-services">
                            <li>Свадьбы</li>
                            <li>Корпоративы</li>
                            <li>Дни Рождения</li>
                            <li>Концерты</li>
                            <li>Соревнования</li>
                            <li>ТимБилдинги</li>
                        </ul><!-- .vb-footer-services -->
                        <div class="vb-footer-credits">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2 col-sm-6 col-sm-offset-0">
                                    <span class="vb-footer-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <address>
                                        <ul class="list-unstyled">
                                            <li>Киев, Украина</li>
                                            <li><a href="tel:+380933683780">+38(093)-368-3780</a></li>
                                            <li><a href="mailto:vbalagur@yandex.ru">vbalagur@yandex.ru</a></li>
                                        </ul>
                                    </address>
                                </div>
                            </div>
                        </div><!-- .vb-footer-credits -->
                    </div><!-- .vb-site-info -->
                </div><!-- .container -->
                <button class="js-scrollTop">Наверх</button>
            </footer><!-- .vb-site-footer -->
        <?php } ?>
	</div><!-- .vb-site-inner -->
	<div class="menu-overlay"></div>
</div><!-- .vb-site -->

<?php wp_footer(); ?>
</body>
</html>
