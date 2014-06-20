<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to kickstart_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage kickstart
 * @since kickstart 0.1
 */
?>
<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'kickstart' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here ?>

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'kickstart' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'kickstart' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kickstart' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kickstart' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use kickstart_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define kickstart_comment() and that will be used instead.
				 * See kickstart_comment() in kickstart/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'kickstart_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'kickstart' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kickstart' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kickstart' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'kickstart' ); ?></p>
	<?php endif; ?>

	<?php $comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="comment-form-author">' .
                '<label for="author">' . __( 'Your Name', 'kickstart' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="comment-form-email">' .
                '<label for="email">' . __( 'Your Email', 'kickstart' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
		'</p><!-- #form-section-email .form-section -->',
    'url'    => '' ) ),
    'comment_field' => '<p class="comment-form-comment">' .
                '<label for="comment">' . __( 'Your Message:', 'kickstart' ) . '</label>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
    'comment_notes_after' => '',
);
comment_form($comment_args); ?>

</div><!-- #comments -->
