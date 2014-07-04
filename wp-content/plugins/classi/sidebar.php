<!--Start sidebar-->
<div class="sidebar">
    <!--Start sidebar_widget-->
    <div class="sidebar_widget">
        <?php if (!dynamic_sidebar('primary-widget-area')) : ?>
            <h3>Search:</h3>
            <?php get_search_form(); ?>
            <h3>
                <?php _e('Categories', THEME_SLUG); ?>
            </h3>

            <ul>
                <?php wp_list_categories('title_li'); ?>
            </ul>

            <h3>
                <?php _e('Archives', THEME_SLUG); ?>
            </h3>	
            <ul>
                <?php wp_get_archives('type=monthly'); ?>
            </ul> 
        <?php endif; // end primary widget area ?>
    </div>
    <!--End sidebar_widget-->
     <?php
// A second sidebar for widgets, just because.
        if (is_active_sidebar('blog-widget-area')) :
            ?>
            <?php dynamic_sidebar('blog-widget-area'); ?>
        <?php endif; ?>
</div>
<!--End sidebar-->