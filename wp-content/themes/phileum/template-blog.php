<?php
/*
Template Name: Blog
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

<!--<h2 class="header-title"><?php _e('Blog - latest news and updates', TEMPLATE_DOMAIN); ?></h2>-->

<?php
global $more; $more = 0;
$max_num_post = get_option('posts_per_page');
$page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=&showposts=$max_num_post&paged=$page");
$oddpost = 'alt-post'; $postcount = 1;
if (have_posts()) : while ( have_posts() ) : the_post(); ?>

<?php do_action( 'bp_before_blog_post' ) ?>

<!-- POST START -->
<article <?php post_class($oddpost); ?> id="post-<?php the_ID(); ?>">

<div class="post-top">
<h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<?php get_template_part( 'lib/templates/post-meta-home' ); ?>
<div class="sharebox-wrap">
<?php get_template_part( 'lib/templates/share-box' ); ?>
</div>
</div>

<div class="post-content">

<?php if( is_category() ): ?>
<?php the_content( __('...read more', TEMPLATE_DOMAIN) ); ?>
<?php elseif( is_search() || is_day() || is_month() || is_year() ): ?>
<?php the_excerpt(); ?>
<?php else: ?>
<?php echo get_featured_post_image("<div class='alignleft post-thumb no-custom-image-size-exist in-archive'>", "</div>", 150, 150, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), false); ?>
<?php get_the_featured_excerpt($excerpt_length=45); ?>
<?php endif; ?>

</div>


</article>
<!-- POST END -->

<?php do_action( 'bp_after_blog_post' ) ?>

<?php ($oddpost == "alt-post") ? $oddpost="" : $oddpost="alt-post"; $postcount++; ?>

<?php $get_google_code = get_theme_option('adsense_post'); if($get_google_code == '') { ?>
<?php } else { ?>
<?php if( 1 == $postcount ||  2 == $postcount ){ ?>
<div class="adsense-post">
<?php echo stripcslashes($get_google_code); ?>
</div>
<?php } ?>
<?php } ?>

<?php endwhile; ?>

<?php comments_template( '', true ); ?>

<?php else: ?>

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