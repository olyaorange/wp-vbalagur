<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Balagur_2016
 * @since Balagur 2016 1.0
 */

get_header(); ?>

	<div id="primary" class="vb-content-area">
		<main id="main" class="vb-site-main" role="main">
            <section id="search-title" class="vb-search-title vb-title">
                <div class="container">
                    <h1 class="text-center"><?php printf( __( 'Search Results for: %s', 'balagur2016' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                </div>
            </section><!-- .vb-search-title -->
            <section id="search-content" class="vb-search-content">
                <div class="container">
                    <?php if ( have_posts() ) : ?>
                        <?php
                        // Start the loop.
                        while ( have_posts() ) : the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'template-parts/content', 'search' );

                            // End the loop.
                        endwhile;

                        // Previous/next page navigation.
                        the_posts_pagination( array(
                            'prev_text'          => __( 'Previous page', 'balagur2016' ),
                            'next_text'          => __( 'Next page', 'balagur2016' ),
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'balagur2016' ) . ' </span>',
                        ) );

                    // If no content, include the "No posts found" template.
                    else :
                        get_template_part( 'template-parts/content', 'none' );

                    endif;
                    ?>
                </div>
            </section><!-- .vb-search-content -->
		</main><!-- .vb-site-main -->
	</div><!-- .vb-content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
