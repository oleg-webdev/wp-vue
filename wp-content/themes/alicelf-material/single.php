<?php
/**
 * Single post
 */
get_header();
?>
<div id="page-<?php the_ID(); ?>"  <?php post_class('am-wrap'); ?>>
	<?php get_template_part('templates/loop', 'article') ?>
</div>
<?php get_footer(); ?>
