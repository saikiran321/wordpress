<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

 <!-- POST ENTRY START -->

<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('post-single page-single'); ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>


<div class="post-content">
<?php the_content(); ?>

<h4><?php _e('Archives by Month:', TEMPLATE_DOMAIN); ?></h4>
<ul class="the-icons"><?php wp_get_archives('before=<i class="icon-table"></i>&type=monthly&limit=12&show_post_count=1'); ?></ul>
<h4><?php _e('Archives by Category:', TEMPLATE_DOMAIN); ?></h4>
<ul class="the-icons">
<?php
  $categories = get_categories();
  foreach ($categories as $cat) {
  echo '<li><i class="icon-paper-clip"></i><a href="'.site_url().'/'.get_option('category_base').'/'.$cat->category_nicename.'/"><span>'.$cat->cat_name.'</a></li>';
  }
?>
</ul>
<h4><?php _e('Browse Last 50 Posts:', TEMPLATE_DOMAIN); ?></h4>
<ul class="the-icons"><?php wp_get_archives('before=<i class="icon-bookmark-empty"></i>&type=postbypost&limit=50'); ?> </ul>

</div>

</article>

<?php endwhile; ?>

<?php //comments_template( '', true ); ?>

<?php else : ?>

<?php get_template_part( 'lib/templates/result' ); ?>

<?php endif; ?>

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