<p style="clear:both;padding: 1em 0 0 !important; font-size: 14px;"><?php if (is_category()) { ?>
<?php _e("Sorry, we can't find the category you're looking for at this URL. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } else if (is_archive()) { ?>
<?php _e("Sorry, we can't find the archive you're looking for at this URL. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } else if (is_search()) { ?>
<?php _e("Sorry, we can't find the search keyword you're looking for. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } else if (is_author()) { ?>
<?php _e("Sorry, we can't find the author you're looking for at this URL. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } else if (is_single()) { ?>
<?php _e("Sorry, we can't find the post you're looking for at this URL. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } else if (is_home()) { ?>
<?php _e("Sorry, we can't find the content you're looking for at this URL. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } else if (is_404()) { ?>
<?php _e("Sorry, we can't find the content you're looking for at this URL. Please try selecting a menu item from above or to the side of this message to get where you'd like to go.", TEMPLATE_DOMAIN); ?>
<?php } ?></p>