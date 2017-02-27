<?php
global $_am;
$header_class = $_am[ 'sticky-header' ] ? "mdl-layout__header"
	: "mdl-layout__header mdl-layout__header--scroll";
?>
<header class="<?php echo $header_class ?>">
	<div class="mdl-layout__header-row am-wrap flex-container">
		<span class="mdl-layout-title"><?php echo material_logo() ?></span>
		<div class="mdl-layout-spacer"></div>
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( [
				'show_home'      => true,
				'menu_class'     => 'mdl-navigation',
				'theme_location' => 'primary',
				'container'      => 'nav',
				'walker'         => new AMenu()
			] );
		} else {
			$menu_id = wp_create_nav_menu( "Default Theme Menu" );
			wp_nav_menu( [
				'show_home'  => true,
				'menu_class' => 'mdl-navigation',
				'container'  => 'nav',
				'walker'     => new AMenu()
			] );
		}
		?>
	</div>
</header>

<aside class="app-viewport" id="mobile-navigation-aside">
	<div class="hidden-on-desktop">
		<md-sidenav class="md-left md-fixed" ref="sidebar">

			<?php echo render_mobile_menu() ?>
		</md-sidenav>


		<md-whiteframe md-elevation="3">
			<md-button class="md-icon-button" @click="$refs.sidebar.toggle()">
				<md-icon>menu</md-icon>
			</md-button>
		</md-whiteframe>

	</div>

</aside>