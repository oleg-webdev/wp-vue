<?php
/**
 * Single post
 */
get_header();
?>
<div id="page-<?php the_ID(); ?>"  <?php post_class(); ?>>
	<?php
	$post_type = get_post_type(get_the_ID());
	get_template_part('templates/loop', $post_type);
	?>
</div>
<?php get_footer(); ?>