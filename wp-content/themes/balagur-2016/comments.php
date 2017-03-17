<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Balagur_2016
 * @since Balagur 2016 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="vb-comments-area">

    <?php if (have_comments()) : ?>
        <section class="vb-title">
            <h1 class="comments-title text-center">
                <?php
                $comments_number = get_comments_number();
                if (1 === $comments_number) {
                    /* translators: %s: post title */
                    printf(_x('One thought on &ldquo;%s&rdquo;', 'comments title', 'balagur2016'), get_the_title());
                } else {
                    printf(
                    /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s thought on &ldquo;%2$s&rdquo;',
                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                            $comments_number,
                            'comments title',
                            'balagur2016'
                        ),
                        number_format_i18n($comments_number),
                        get_the_title()
                    );
                }
                ?>
            </h1>
        </section>
        <hr class="vb-small-separator">
        <?php the_comments_navigation(); ?>

        <ol class="vb-comment-list container">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 56,
            ));
            ?>
        </ol><!-- .vb-comment-list -->

        <?php the_comments_navigation(); ?>
        <hr class="vb-small-separator">

    <?php endif; // Check for have_comments(). ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'balagur2016'); ?></p>
    <?php endif; ?>

    <?php
    $fields =  array(
        'author' =>
            '<div class="vb-form-common-group comment-form-author">' . '<label for="author">' . __('Name') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
            '<div class="vb-form-common"><input id="author" name="author" type="text" required="required" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div><div class="vb-form-underline"></div></div>',
        'email'  =>
            '<div class="vb-form-common-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<div class="vb-form-common"><input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' required="required" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div><div class="vb-form-underline"></div></div>',
    );
    comment_form(array(
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title vb-custom-bg">',
        'title_reply_after'  => '</h2>',
        'class_form'         => 'vb-custom-bg vb-form-wrapper comment-form',
        'comment_field'      => '<div class="vb-form-common-group comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . ($req ? ' <span class="required">*</span>' : '') . '</label><div class="vb-form-common"><textarea id="comment" name="comment" cols="40" rows="5" maxlength="65525" aria-required="true" required="required"></textarea></div><div class="vb-form-underline"></div></div>',
        'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'       => '<div class="clearfix"></div><div class="text-center top-offset-xs"><div class="vb-submit vb-button-big vb-button-primary form-submit">%1$s %2$s</div></div>',

        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    ));
    ?>
</div><!-- .vb-comments-area -->
