<div id="socialbox">

<p class="rss"><a title="<?php _e('Subscribe to rss feed', TEMPLATE_DOMAIN); ?>" href="<?php if( get_theme_option('rss_feed') ): ?><?php echo stripcslashes( get_theme_option('rss_feed') ); ?><?php else: ?><?php echo bloginfo('rss2_url'); ?><?php endif; ?>">&nbsp;</a></p>

<p class="facebook"><a title="<?php _e('Like us on Facebook', TEMPLATE_DOMAIN); ?>" href="<?php echo stripcslashes( get_theme_option('facebook_page') ); ?>">&nbsp;</a></p>


<p class="twitter"><a title="<?php _e('Follow us on Twitter', TEMPLATE_DOMAIN); ?>" href="<?php echo stripcslashes( get_theme_option('twitter_page') ); ?>">&nbsp;</a></p>


<?php if(get_theme_option('linkedin_page')): ?>
<p class="linkedin"><a title="<?php _e('Check out our Linkedin profile', TEMPLATE_DOMAIN); ?>" href="<?php echo stripcslashes( get_theme_option('linkedin_page') ); ?>">&nbsp;</a></p>
<?php endif; ?>

<?php if(get_theme_option('youtube_page')): ?>
<p class="youtube"><a title="<?php _e('Check out our Youtube profile', TEMPLATE_DOMAIN); ?>" href="<?php echo stripcslashes( get_theme_option('youtube_page') ); ?>">&nbsp;</a></p>
<?php endif; ?>

<?php if(get_theme_option('gplus_page')): ?>
<p class="gplus"><a title="<?php _e('Check out our Google Plus profile', TEMPLATE_DOMAIN); ?>" href="<?php echo stripcslashes( get_theme_option('gplus_page') ); ?>">&nbsp;</a></p>
<?php endif; ?>

</div>
