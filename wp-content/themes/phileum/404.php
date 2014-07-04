<?php get_header(); ?>
<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content full-width">
<div class="content-inner">
<?php do_action( 'bp_before_blog_home' ) ?>
<!-- POST ENTRY -->
<div id="post-entry">
<section class="post-entry-inner">
<article class="post-single page-single 404-page">
<h1 class="post-title"><?php _e('Error 404', TEMPLATE_DOMAIN); ?></h1>
<div class="post-content">
<h3><?php _e('The page you requested cannot be found!', TEMPLATE_DOMAIN); ?></h3>
<p><?php _e('Perhaps you are here because:', TEMPLATE_DOMAIN); ?></p>
<ul>
<li><?php _e('The page has moved', TEMPLATE_DOMAIN); ?></li>
<li><?php _e('The page url has been change', TEMPLATE_DOMAIN); ?></li>
<li><?php _e('The page no longer exist', TEMPLATE_DOMAIN); ?></li>
</ul>
<p><strong><?php printf(__('Don\'t worry, we are still here, just <a href="%s">click here</a> to go back to civilization.', TEMPLATE_DOMAIN), home_url() ); ?></strong></p>
</div>
<!-- POST CONTENT END -->
</article>
</section>
</div>
<!-- POST ENTRY END -->
<?php do_action( 'bp_after_blog_home' ) ?>
</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->
<?php do_action( 'bp_after_content' ) ?>
<?php get_footer(); ?>