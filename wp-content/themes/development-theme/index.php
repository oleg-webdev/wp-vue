<?php
get_header();
$blog_id          = get_option('page_for_posts');
$show_sidebar     = get_post_meta( $blog_id, 'show_sidebar', true );
$sidebar_position = get_post_meta( $blog_id, 'sidebar_postion', true );
$sidebar_name     = get_post_meta( $blog_id, 'select_your_sidebar', true );
$page_template    = str_replace( [ ".php", "_" ], "", get_page_template_slug( $blog_id ) );
do_action('aa_page_loop_start', $blog_id);
?>
	<div class="flex-container am-wrap">
		<?php
		if ( $show_sidebar && $sidebar_position === 'left' )
			aa_sidebar_fn($sidebar_name, 30);
		?>
		<div class="flex-col-<?php echo $show_sidebar ? 70 : 100; ?> flex-col-phone-100">
			<?php get_template_part('templates/loop', 'index') ?>
		</div>
		<?php
		if ( $show_sidebar && $sidebar_position === 'right' )
			aa_sidebar_fn($sidebar_name, 30);
		?>
	</div>

<?php get_footer() ?>