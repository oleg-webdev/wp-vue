<?php
/**
 * The loop that displays a page.
 */
get_header();
?>
<div id="page-<?php the_ID(); ?>">
	<?php get_template_part('templates/loop', 'page') ?>
</div>
<?php get_footer(); ?>
