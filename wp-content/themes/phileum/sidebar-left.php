<div id="left-sidebar" class="sidebar">
<div class="sidebar-inner">
<div class="widget-area the-icons">
<?php do_action('bp_before_left_sidebar'); ?>

<?php $get_left_google_code = get_theme_option('adsense_left_sidebar'); if($get_left_google_code == '') { ?>
<?php } else { ?>
<aside class="widget ctr-ad">
<div class="textwidget adswidget"><?php echo stripcslashes($get_left_google_code); ?></div>
</aside>
<?php } ?>

<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
<?php dynamic_sidebar( 'left-sidebar' ); ?>
<?php else: ?>
<aside class="widget">
<h3 class="widget-title"><?php _e('Topics', TEMPLATE_DOMAIN); ?></h3>
<ul><?php wp_list_categories('orderby=name&show_count=1&title_li='); ?></ul>
</aside>
<aside class="widget">
<h3 class="widget-title"><?php _e('Archive',TEMPLATE_DOMAIN); ?></h3>
<ul><?php wp_get_archives('type=monthly&limit=12&show_post_count=1'); ?></ul>
</aside>
<aside class="widget">
<h3 class="widget-title"><?php _e('Popular Tags',TEMPLATE_DOMAIN); ?></h3>
<div class="tagcloud"><ul><?php wp_tag_cloud('orderby=count&order=DESC&&number=25&smallest=8&largest=18'); ?></ul></div>
</aside>
<aside class="widget">
<h3 class="widget-title"><?php _e('Meta', TEMPLATE_DOMAIN); ?></h3>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<?php wp_meta(); ?>
</ul>
</aside>
<?php endif; ?>



</div>
</div><!-- SIDEBAR-INNER END -->
</div><!-- LEFT SIDEBAR END -->