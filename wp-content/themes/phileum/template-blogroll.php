<?php
/*
Template Name: Blogroll
*/
?>

<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- POST START -->
<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>">


<h1 class="post-title"><?php the_title(); ?></h1>


<div class="post-content">
<?php the_content(); ?>
<h2><?php _e('Useful Resources:', TEMPLATE_DOMAIN); ?></h2>
<ul><?php wp_list_bookmarks('title_li=&categorize=0'); ?></ul>
</div>

</article>
<!-- POST END -->

<?php endwhile; endif; ?>
</section>
</div>
<!-- POST ENTRY END -->

<?php do_action( 'bp_after_blog_home' ) ?>
<?php get_sidebar('left'); ?>
</div><!-- CONTENT INNER END -->
</div><!-- CONTENT END -->

<?php do_action( 'bp_after_content' ) ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>