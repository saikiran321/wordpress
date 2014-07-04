<?php
global $post;
$featon = get_theme_option('feat_sidebar_on');

$featcat1 = get_theme_option('side_feat_cat1');
$featcat2 = get_theme_option('side_feat_cat2');
$featcat3 = get_theme_option('side_feat_cat3');
$featcat4 = get_theme_option('side_feat_cat4');

$featcat1_count = get_theme_option('side_feat_cat1_count');
$featcat2_count = get_theme_option('side_feat_cat2_count');
$featcat3_count = get_theme_option('side_feat_cat3_count');
$featcat4_count = get_theme_option('side_feat_cat4_count');

$category_id1 = get_cat_id($featcat1);
$category_id2 = get_cat_id($featcat2);
$category_id3 = get_cat_id($featcat3);
$category_id4 = get_cat_id($featcat4);

$icon_name = "";
$icon_time = "";
$icon_comment = '<i class="icon-comment-alt"></i>';

if($featon=="Enable"):

if($featcat1 && $featcat1 != 'Choose a category'):
$my_query1 = new WP_Query('cat='. $category_id1 . '&' . 'offset=' . '&' . 'showposts='. $featcat1_count); ?>
<aside class="widget">
<h3 class="widget-title"><?php echo $icon_name; ?><?php echo stripcslashes($featcat1); ?></h3>
<ul class="sidefeat">

<?php while ($my_query1->have_posts()) : $my_query1->the_post(); $do_not_duplicate = $post->ID; ?>
<li class="feat-<?php echo $post->ID; ?>">
<?php echo get_featured_post_image("<div class='post-thumb mini-feat'>", "</div>", 180, 150, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<div class="sidefeat-meta">
<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h4>
<p class="sidetext"><?php get_the_featured_excerpt($excerpt_length=15); ?></p>
</div>

</li>
<?php endwhile; wp_reset_postdata(); ?>

</ul>
</aside>
<?php endif;



if($featcat2 && $featcat2 != 'Choose a category'):
$my_query2 = new WP_Query('cat='. $category_id2 . '&' . 'offset=' . '&' . 'showposts='. $featcat2_count); ?>
<aside class="widget">
<h3 class="widget-title"><?php echo $icon_name; ?><?php echo stripcslashes($featcat2); ?></h3>
<ul class="sidefeat">

<?php while ($my_query2->have_posts()) : $my_query2->the_post(); $do_not_duplicate = $post->ID; ?>
<li class="feat-<?php echo $post->ID; ?>">

<?php echo get_featured_post_image("<div class='post-thumb mini-feat'>", "</div>", 180, 150, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<div class="sidefeat-meta">
<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h4>
<p class="sidetext"><?php get_the_featured_excerpt($excerpt_length=15); ?></p>
</div>

</li>
<?php endwhile; wp_reset_postdata(); ?>

</ul>
</aside>
<?php endif;




if($featcat3 && $featcat3 != 'Choose a category'):
$my_query3 = new WP_Query('cat='. $category_id3 . '&' . 'offset=' . '&' . 'showposts='. $featcat3_count); ?>
<aside class="widget">
<h3 class="widget-title"><?php echo $icon_name; ?><?php echo stripcslashes($featcat3); ?></h3>
<ul class="sidefeat">

<?php while ($my_query3->have_posts()) : $my_query3->the_post(); $do_not_duplicate = $post->ID; ?>
<li class="feat-<?php echo $post->ID; ?>">

<?php echo get_featured_post_image("<div class='post-thumb mini-feat'>", "</div>", 180, 150, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<div class="sidefeat-meta">
<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h4>
<p class="sidetext"><?php get_the_featured_excerpt($excerpt_length=15); ?></p>  
</div>

</li>
<?php endwhile; wp_reset_postdata(); ?>

</ul>
</aside>
<?php endif;



if($featcat4 && $featcat4 != 'Choose a category'):  
$my_query4 = new WP_Query('cat='. $category_id4 . '&' . 'offset=' . '&' . 'showposts='. $featcat4_count); ?>
<aside class="widget">
<h3 class="widget-title"><?php echo $icon_name; ?><?php echo stripcslashes($featcat4); ?></h3>
<ul class="sidefeat">

<?php while ($my_query4->have_posts()) : $my_query4->the_post(); $do_not_duplicate = $post->ID; ?>
<li class="feat-<?php echo $post->ID; ?>">

<?php echo get_featured_post_image("<div class='post-thumb mini-feat'>", "</div>", 180, 150, "alignleft", "thumbnail", 'image-'.get_the_ID() ,get_the_title(), true); ?>

<div class="sidefeat-meta">
<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h4>
<p class="sidetext"><?php get_the_featured_excerpt($excerpt_length=15); ?></p>
</div>

 </li>
<?php endwhile; wp_reset_postdata(); ?>

</ul>
</aside>
<?php endif;
endif;
?>