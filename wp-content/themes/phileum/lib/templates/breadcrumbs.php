<?php
$category = get_the_category();
$current_cat = $category[0]->cat_ID;
?>

<?php if (is_single()) { ?>

<div id="breadcrumbs">
<ul>
<li class="bpage"><?php _e('You are here&nbsp;:', TEMPLATE_DOMAIN); ?></li>
<li><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php _e('Home', TEMPLATE_DOMAIN); ?></a></li>
<?php $category = get_the_category(); if ($category) { echo '<li><a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", TEMPLATE_DOMAIN ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a></li>'; } ?>
<li><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></li>
</ul>
</div>


<?php } else if (is_home()) { ?>


<div id="breadcrumbs">
<ul>
<li class="bpage"><?php _e('You are here&nbsp;:', TEMPLATE_DOMAIN); ?></li>
<li><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php _e('Home', TEMPLATE_DOMAIN); ?></a></li>
</ul>
</div>


<?php } else if ( is_category() || is_tag() ) { ?>


<div id="breadcrumbs">
<ul>
<li class="bpage"><?php _e('You are here&nbsp;:', TEMPLATE_DOMAIN); ?></li>
<li><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php _e('Home', TEMPLATE_DOMAIN); ?></a></li>
<li class="bpage"><?php if( is_category() ) { _e('Category', TEMPLATE_DOMAIN); } elseif( is_tag() ) { _e('Category', TEMPLATE_DOMAIN); } ?>
</li>
<li class="bpage"><?php single_cat_title(); ?></li>
</ul>
</div>


<?php } else if (is_page()) { ?>


<div id="breadcrumbs">
<ul>
<li class="bpage"><?php _e('You are here&nbsp;:', TEMPLATE_DOMAIN); ?></li>
<li><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php _e('Home', TEMPLATE_DOMAIN); ?></a></li>
<li class="bpage"><?php _e('Page', TEMPLATE_DOMAIN); ?></li>
<li class="bpage"><?php echo wp_title('',true); ?></li>
</ul>
</div>


<?php } else if (is_archive()) { ?>

<div id="breadcrumbs">
<ul>
<li class="bpage"><?php _e('You are here&nbsp;:', TEMPLATE_DOMAIN); ?></li>
<li><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php _e('Home', TEMPLATE_DOMAIN); ?></a></li>
<li class="bpage"><?php _e('Archive', TEMPLATE_DOMAIN); ?></li>
<li class="bpage">
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_day()) { ?>
<?php the_time(get_option('date_format')); ?>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<?php the_time(get_option('date_format')); ?>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<?php the_time(get_option('date_format')); ?>
<?php } ?>
</li>
</ul>
</div>


<?php } else if (is_search()) { ?>

<div id="breadcrumbs">
<ul>
<li class="bpage"><?php _e('You are here&nbsp;:', TEMPLATE_DOMAIN); ?></li>
<li><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php _e('Home', TEMPLATE_DOMAIN); ?></a></li>
<li class="bpage"><?php _e('Search Result', TEMPLATE_DOMAIN); ?></li>
<li class="bpage"><?php the_search_query(); ?></li>
</ul>
</div>

<?php } else if (is_author()) { ?>
<?php } else { ?>
<?php { /* nothing */ } ?>
<?php } ?>
