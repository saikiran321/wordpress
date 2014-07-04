<?php get_header(); ?>

<?php do_action( 'bp_before_content' ) ?>
<!-- CONTENT START -->
<div class="content">
<div class="content-inner">

<?php do_action( 'bp_before_blog_home' ) ?>

<!-- POST ENTRY START -->
<div id="post-entry">
<section class="post-entry-inner">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- POST START -->
<article <?php post_class('post-single'); ?> id="post-<?php the_ID(); ?>" rel="author">

<div class="post-top">
<h1 class="post-title"><?php the_title(); ?></h1>
<?php get_template_part( 'lib/templates/post-meta' ); ?>
<div class="sharebox-wrap">
<?php get_template_part( 'lib/templates/share-box' ); ?>
</div>
</div>

<div class="post-content">
<?php $get_google_code = get_theme_option('adsense_single'); if($get_google_code == '') { ?>
<?php } else { ?>
<div class="adsense-single"><?php echo stripcslashes($get_google_code); ?></div>
<?php } ?>
<?php the_content( __('...more &raquo;',TEMPLATE_DOMAIN) ); ?>
</div>
<?php get_template_part( 'lib/templates/post-meta-bottom' ); ?>
<?php get_template_part( 'lib/templates/related' ); ?>

<?php $get_google_code = get_theme_option('adsense_single'); if($get_google_code == '') { ?>
<?php } else { ?>
<div class="adsense-single"><?php echo stripcslashes($get_google_code); ?></div>
<?php } ?>


</article>
<!-- POST END -->


<?php set_wp_post_view( get_the_ID() ); ?>

<?php endwhile; ?>

<?php get_template_part( 'lib/templates/author-bio' ); ?>

<?php if ( comments_open() ) { comments_template( '', true ); }  ?>

<?php else : ?>

<?php get_template_part( 'lib/templates/result' ); ?>

<?php endif; ?>

<?php get_template_part( 'lib/templates/paginate' ); ?>

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