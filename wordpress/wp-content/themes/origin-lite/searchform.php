<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" value="<?php the_search_query(); ?>" name="s" class="s" />
	<input type="submit" value="Search" class="searchsubmit" />
</form>
