<?php if ( have_posts() )
	while ( have_posts() ) : the_post(); ?>

		<h3 class="entry-title"><?php the_title(); ?></h3>

		<div class="entry-content">
			<div class="the-article-content">
				<?php the_content(); ?>
			</div>
			<?php the_tags( "", " / " ); ?>
			<nav>
				<ul id="nav-below" class="pager clearfix">
					<li class="nav-previous"><?php previous_post_link( '&larr; %link' ); ?></li>
					<li class="nav-next"><?php next_post_link( '%link &rarr;' ); ?></li>
				</ul>
			</nav>
		</div>
		<div id="am-single-comments" class="am-comments-wrapper"><?php comments_template(); ?></div>

	<?php endwhile; ?>