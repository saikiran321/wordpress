<?php
$featured_on = get_theme_option('slider_on');
$featured_category = get_theme_option('feat_cat');
$featured_number = get_theme_option('feat_cat_count');
$featured_post = get_theme_option('feat_post');
?>

<?php if($featured_on == 'Enable'): ?>
<?php if(!$featured_category && !$featured_post): ?>
<?php else: ?>
<?php if($featured_category): ?>

<!-- GALLERY SLIDER START -->
<div id="featuredbox">
<div id="featured">
<div id="Gallerybox">
<div id="myGallery">
<?php
$query = new WP_Query( "cat=$featured_category&posts_per_page=$featured_number&orderby=date" );
while ( $query->have_posts() ) : $query->the_post(); ?>
<div class="imageElement post-<?php the_ID(); ?>">

<?php echo get_featured_post_image("", "", 800, 400, "alignleft full", "full", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h3>
<p><?php get_the_featured_excerpt($excerpt_length=30); ?></p>
<a href="<?php the_permalink(); ?>" title="open image" class="open"></a>
</div>
<?php endwhile; wp_reset_query(); ?>
</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->
</div>
<!-- GALLERY SLIDER END -->


<?php elseif($featured_post && !$featured_category): ?>

<!-- GALLERY SLIDER START -->
<div id="featuredbox">
<div id="featured">
<div id="Gallerybox">
<div id="myGallery">
<?php
query_posts( array( 'post__in' => explode(',', $featured_post), 'post_type'=> array('post','portfolio'), 'posts_per_page' => 100, 'orderby' => 'date', 'order' => 'DESC' ) );
while ( have_posts() ) : the_post(); ?>
<div class="imageElement post-<?php the_ID(); ?>">

<?php echo get_featured_post_image("", "", 800, 400, "alignleft full", "full", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h3>
<p><?php get_the_featured_excerpt($excerpt_length=30); ?></p>
<a href="<?php the_permalink(); ?>" title="open image" class="open"></a>
</div>
<?php endwhile; wp_reset_query(); ?>
</div><!-- MYGALLERY END -->
</div><!-- GALLERBOX END -->
</div><!-- FEATURED END -->
</div>
<!-- GALLERY SLIDER END -->

<?php endif; ?>

<?php endif; ?>

<?php endif; ?>