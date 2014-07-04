<?php if( get_theme_option('social_on') == 'Yes') { global $post; ?>
<div class="share_box">
<div class="addthis_toolbox addthis_default_style"
addthis:url="<?php the_permalink(); ?>"
addthis:title="<?php the_title(); ?>"
addthis:description="<?php get_the_featured_excerpt($excerpt_length=30); ?>">
<a style="margin:0 20px 0 0;" class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
</div>
<?php } ?>