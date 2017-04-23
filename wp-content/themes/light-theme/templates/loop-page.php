<?php
if ( have_posts() )
	while ( have_posts() ) : the_post(); ?>

		<div class="container-fluid clearfix">
			<div class="container">
				<div <?php post_class( apply_filters( 'app_page_classes', get_page_template_slug( get_the_ID() ) ) ) ?>>
					<h3 class="entry-title"><?php the_title(); ?></h3>

					<div class="entry-content">
						<?php the_content();
						the_tags( "", " / " ); ?>
					</div>
					<div id="am-page-comments" class="am-comments-wrapper"><?php comments_template(); ?></div>
				</div>
			</div>
		</div>

	<?php endwhile; ?>