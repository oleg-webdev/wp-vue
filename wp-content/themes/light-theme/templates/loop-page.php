<?php
if ( have_posts() )
	while ( have_posts() ) : the_post();
		$page_template = str_replace( [ ".php", "_" ], "", get_page_template_slug( get_the_ID() ) );
		?>

		<div <?php post_class( empty( $page_template ) ? 'am-wrap' : $page_template ) ?>>
			<h3 class="entry-title"><?php the_title(); ?></h3>

			<div class="entry-content">
				<?php the_content();
				the_tags( "", " / " ); ?>
			</div>
			<div id="am-page-comments" class="am-comments-wrapper"><?php comments_template(); ?></div>
		</div>

	<?php endwhile; ?>