<div id="right-sidebar" class="sidebar">
<div class="sidebar-inner">
<div class="widget-area the-icons">
<?php do_action('bp_before_right_sidebar'); ?>

<?php if( get_theme_option('rss_feed') ): ?>
<aside class="widget">
<h3 class="widget-title"><?php _e('Stay Update', TEMPLATE_DOMAIN); ?></h3>
<div class="extra-block social-and-search">
<?php get_template_part( 'lib/templates/social-box' ); ?>
</div>
</aside>
<?php endif; ?>

<?php $get_google_code = get_theme_option('adsense_right_sidebar'); if($get_google_code != '') { ?>
<aside class="widget ctr-ad">
<div class="textwidget adswidget"><?php echo stripcslashes($get_google_code); ?></div>
</aside>
<?php } ?>

<aside class="widget">
<h3 class="widget-title"><?php _e('Search', TEMPLATE_DOMAIN); ?></h3>
<?php get_search_form(); ?>
</aside>

<div id="tabber-widget">
<div class="tabber">
<?php if ( is_active_sidebar( 'tabbed-sidebar' ) ) : ?>
<?php dynamic_sidebar( 'tabbed-sidebar' ); ?>
<?php else: ?>

<div class="tabbertab">
<aside class="widget widget_recent_entries">
<h3 class="widget-title"><?php _e('Posts', TEMPLATE_DOMAIN); ?></h3>
<ul><?php wp_get_archives('type=postbypost&limit=5'); ?></ul>
</aside></div>


<div class="tabbertab">
<aside class="widget">
<h3 class="widget-title"><?php _e('Comments', TEMPLATE_DOMAIN); ?></h3>
<?php get_avatar_recent_comment(5); ?>
</aside></div>


<div class="tabbertab">
<aside class="widget">
<h3 class="widget-title"><?php _e('Popular',TEMPLATE_DOMAIN); ?></h3>
<?php get_hot_topics(5); ?>
</aside></div>

<?php endif; ?>
</div>
</div>

<?php get_template_part('lib/templates/advertisment'); ?>
<?php get_template_part('lib/templates/sidebar-feat-cat'); ?>

<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
<?php dynamic_sidebar( 'right-sidebar' ); ?>
<?php else: ?>

<aside class="widget">
<h3 class="widget-title"><?php _e('Calendar', TEMPLATE_DOMAIN); ?></h3>
<?php get_calendar(); ?>
</aside>

<?php endif; ?>

<?php /* WARNING: DON'T EDIT OR ADD ANYTHING INSIDE THIS LINE. THE THEME WILL DEACTIVATE IF THESE CODES ARE MODIFIED IN ANY WAYS */?> <?php echo ccc_theme_license(); ?> <?php /* WARNING: DON'T EDIT OR ADD ANYTHING INSIDE THIS LINE. THE THEME WILL DEACTIVATE IF THESE CODES ARE MODIFIED IN ANY WAYS */?>

<?php do_action('bp_after_right_sidebar'); ?>

</div>
</div><!-- SIDEBAR-INNER END -->
</div><!-- RIGHT SIDEBAR END -->