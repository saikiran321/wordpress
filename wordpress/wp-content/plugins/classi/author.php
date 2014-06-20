<?php
/**
 * The template for displaying Author Archive pages.
 *
 * 
 */
if (!isset($_REQUEST['rtype']) && $_REQUEST['rtype'] == '') {
?>
<?php get_header(); ?>
<!--Start Cotent Wrapper-->
<div class="content_wrapper">
    <div class="container_24">
        <div class="grid_24">
            <div class="grid_17 alpha">
                <!--Start Cotent-->
                <div class="content">
                     <?php if (have_posts()) : the_post(); ?>
             <h1><?php printf(__(ATHR_ARC.' %s',THEME_SLUG), "<a class='url fn n' href='" . get_author_posts_url(get_the_author_meta('ID')) . "' title='" . esc_attr(get_the_author()) . "' rel='me'>" . get_the_author() . "</a>"); ?></h1>
                <?php
                // If a user has filled out their description, show a bio on their entries.
                if (get_the_author_meta('description')) :
                    ?>
                    <div id="author-info">
                        <div class="author-inner">
                        <div id="author-avatar"> <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('cc_avatar_size', 50)); ?> </div>
                        <!-- #author-avatar -->
                        <div id="author-description">
                            <h2><?php printf(__(ABT.' %s', THEME_SLUG), get_the_author()); ?></h2>
                            <?php the_author_meta('description'); ?>
                        </div>
                        <!-- #author-description	-->
                        </div>
                    </div>
                    <!-- #entry-author-info -->
                <?php endif; ?>
            <?php endif; ?>
            <?php
            /* Since we called the_post() above, we need to
             * rewind the loop back to the beginning that way
             * we can run the loop properly, in full.
             */
            rewind_posts();
            /* Run the loop for the author archive page to output the authors posts
             * If you want to overload this in a child theme then include a file
             * called loop-author.php and that will be used instead.
             */            
            get_template_part('loop');
            ?>
                <div class="clear"></div>
                </div>
                <!--End Cotent-->
            </div>
            <div class="grid_7 omega">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--End Cotent Wrapper-->
<?php get_footer(); } ?>