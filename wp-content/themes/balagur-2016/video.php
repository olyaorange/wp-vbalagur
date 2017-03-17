<?php
/**
 * Template Name: Video
 */
get_header(); ?>

<div id="primary" class="vb-content-area">
    <main id="contactme" class="vb-site-video" role="main">
        <section id="video-title" class="vb-video-title vb-title">
            <div class="container">
                <h1 class="text-center">Видео</h1>
            </div>
        </section><!-- .vb-video-title -->
        <section id="video-list" class="vb-video-list">
            <div class="container">
                <div class="embed-responsive vb-video-item"><iframe src="https://player.vimeo.com/video/189755826?portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="embed-responsive vb-video-item"><iframe src="//vk.com/video_ext.php?oid=60229646&amp;id=170029800&amp;hash=dbd7219aaf63cdb6&amp;hd=2" width="300" height="150" frameborder="0"></iframe></div>
                    </div>
                    <div class="col-md-6">
                        <div class="embed-responsive vb-video-item"><iframe src="https://player.vimeo.com/video/84725784" width="300" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="embed-responsive vb-video-item"><iframe src="//vk.com/video_ext.php?oid=-73050943&amp;id=168914074&amp;hash=0a60b4377c71ad61&amp;hd=2" width="300" height="150" frameborder="0"></iframe></div>
                    </div>
                    <div class="col-md-6">
                        <div class="embed-responsive vb-video-item"><iframe src="https://player.vimeo.com/video/96684438" width="300" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="embed-responsive vb-video-item"><iframe src="//vk.com/video_ext.php?oid=-73142775&amp;id=169030330&amp;hash=cea75477dd14ef28&amp;hd=2" width="300" height="150" frameborder="0"></iframe></div>
                    </div>
                </div>
            </div>
        </section><!-- .vb-video-list -->

        <?php
        // Start the loop.
        while (have_posts()) : the_post();

            // Include the page content template.
            get_template_part('template-parts/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }

            // End of the loop.
        endwhile;
        ?>

    </main><!-- .vb-site-video -->
</div><!-- .vb-content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>