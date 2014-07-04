<?php global $page, $paged; if( is_home() ) { ?>

<h2 class="header-title"><?php _e('Latest News From The', TEMPLATE_DOMAIN); ?> <span><?php _e('Blog', TEMPLATE_DOMAIN); ?></span><?php if ( $paged >= 2 || $page >= 2 ) { ?> - <?php _e('Page', TEMPLATE_DOMAIN); ?> <?php echo $paged; ?><?php } ?></h2>

<?php } else if (is_category()) { ?>

<h2 class="header-title"><?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?><?php if ( $paged >= 2 || $page >= 2 ) { ?> - <?php _e('Page', TEMPLATE_DOMAIN); ?> <?php echo $paged; ?><?php } ?></h2>

<?php } else if (is_tag()) { ?>

<h2 class="header-title"><?php _e('Tag archives for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?><?php if ( $paged >= 2 || $page >= 2 ) { ?> - <?php _e('Page', TEMPLATE_DOMAIN); ?> <?php echo $paged; ?><?php } ?></h2>

<?php } else if (is_author()) { ?>

<h2 class="header-title">
<?php if ( have_posts() ) : the_post(); ?>
<?php printf( __( 'Author Archives: %s', TEMPLATE_DOMAIN ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?><?php if ( $paged >= 2 || $page >= 2 ) { ?> - <?php _e('Page', TEMPLATE_DOMAIN); ?> <?php echo $paged; ?><?php } ?>
<?php rewind_posts(); endif; ?>
</h2>

<?php } else if (is_archive()) { ?>

<h2 class="header-title">
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_day()) { ?>
<?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php the_time('F jS, Y'); ?>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php the_time('F, Y'); ?>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<?php _e('Archives for', TEMPLATE_DOMAIN); ?> <?php the_time('Y'); ?>
<?php } ?><?php if ( $paged >= 2 || $page >= 2 ) { ?> - <?php _e('Page', TEMPLATE_DOMAIN); ?> <?php echo $paged; ?><?php } ?>
</h2>

<?php } else if (is_single()) { ?>

<?php } else if (is_search()) { ?>

<h2 class="header-title"><?php _e('Search result for &quot;', TEMPLATE_DOMAIN); ?> <?php the_search_query(); ?> <?php _e('&quot;', TEMPLATE_DOMAIN); ?><?php if ( $paged >= 2 || $page >= 2 ) { ?> - <?php _e('Page', TEMPLATE_DOMAIN); ?> <?php echo $paged; ?><?php } ?></h2>

<?php }  ?>