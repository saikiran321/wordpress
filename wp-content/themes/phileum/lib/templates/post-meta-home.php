<div class="post-meta the-icons pmeta-alt">
<span class="post-author"><?php the_author_posts_link(); ?> </span>
<span class="post-time"><?php the_time('d/m/Y'); ?></span>

<span class="post-category">
<?php if( is_home() ) { ?>
<?php echo get_singular_cat(); ?>
<?php } else { ?><?php the_category(', ') ?><?php } ?>
</span>

<?php if ( comments_open() ) { ?>
<span class="post-comment"><?php comments_popup_link(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></span>
<?php } ?>
</div>