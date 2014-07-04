<div class="post-meta the-icons pmeta-alt">
<span class="post-category"><?php the_category(', ') ?></span>
<?php if( has_tag() && ( is_single() || is_archive() ) ) { ?>
<span class="post-tags"><?php the_tags('', ', '); ?></span>
<?php } ?>
</div>