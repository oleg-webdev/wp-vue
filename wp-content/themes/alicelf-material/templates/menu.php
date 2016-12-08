<?php
global $_am; //mdl-layout__drawer
$header_class = $_am['sticky-header'] ? "mdl-layout__header"
	: "mdl-layout__header mdl-layout__header--scroll";

add_action('AM_content', 'aa_func_20162908082952');
function aa_func_20162908082952()
{
	?>
	<button type="button"
	        id="mobile-menu-trigger"
	        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect hidden-on-desktop">
		<i class="material-icons">dehaze</i>
	</button>
	<?php
}
?>

<header class="<?php echo $header_class ?>">
	<div class="mdl-layout__header-row">
		<span class="mdl-layout-title"><?php echo material_logo() ?></span>
		<div class="mdl-layout-spacer"></div>
		<?php
		if ( ! has_nav_menu( 'primary' ) ) {
			$menu_id = wp_create_nav_menu( "Default Alicelf Menu" );

			wp_update_nav_menu_item( $menu_id, 0, [
					'menu-item-title'   => __( 'Home' ),
					'menu-item-classes' => 'mdl-navigation__link',
					'menu-item-url'     => home_url( '/' ),
					'menu-item-status'  => 'publish'
				]
			);
			wp_nav_menu( [
				'show_home'  => true,
				'menu_class' => 'mdl-navigation',
				'container'  => 'nav',
				'walker'     => new AMenu()
			] );
		} else {
			wp_nav_menu( [
				'show_home'      => true,
				'menu_class'     => 'mdl-navigation',
				'theme_location' => 'primary',
				'container'      => 'nav',
				'walker'         => new AMenu()
			] );
		}
		?>
	</div>
</header>

<div class="mdl-layout__drawer">
	<span class="mdl-layout-title"><?php echo material_logo() ?></span>
	<nav class="mdl-navigation">
		<?php
		wp_nav_menu( [
			'show_home'      => true,
			'menu_class'     => 'mdl-navigation',
			'theme_location' => 'primary',
			'container'      => 'nav'
		] );
		?>
	</nav>
</div>