<?php if ( have_posts() )
	while ( have_posts() ) : the_post();
		$post_id          = get_the_ID();
		$show_sidebar     = get_post_meta( $post_id, 'show_sidebar', true );
		$sidebar_position = get_post_meta( $post_id, 'sidebar_postion', true );
		$sidebar_name     = get_post_meta( $post_id, 'select_your_sidebar', true );
		$page_template    = str_replace( [ ".php", "_" ], "", get_page_template_slug( $post_id ) );
		do_action('aa_page_loop_start', $post_id);
		?>

		<div <?php post_class( empty( $page_template ) ? 'am-wrap' : $page_template ) ?>>
			<h3 class="entry-title"><?php the_title(); ?></h3>

			<div class="entry-content">
				<div class="mdl-grid">
					<?php
					if ( $show_sidebar && $sidebar_position === 'left' )
						aa_sidebar_fn($sidebar_name);
					?>
					<div class="the-page-content mdl-cell mdl-cell--<?php echo $show_sidebar ? "8-col" : "12-col"; ?>">
						<?php the_content(); the_tags( "", " / " ); ?>
					</div>
					<?php
					if ( $show_sidebar && $sidebar_position === 'right' )
						aa_sidebar_fn($sidebar_name);
					?>
				</div>
				<nav>
					<ul id="nav-below" class="pager clearfix">
						<li class="nav-previous"><?php previous_post_link( '&larr; %link' ); ?></li>
						<li class="nav-next"><?php next_post_link( '%link &rarr;' ); ?></li>
					</ul>
				</nav>
			</div>
			<div id="am-page-comments" class="am-comments-wrapper"><?php comments_template(); ?></div>

		</div>

	<?php endwhile; ?>