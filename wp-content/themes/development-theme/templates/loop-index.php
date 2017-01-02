<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article class="am-wrap">
		<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
		<div class="excerpt"><?php the_excerpt() ?></div>
	</article>

<?php endwhile; endif; wp_reset_query() ?>