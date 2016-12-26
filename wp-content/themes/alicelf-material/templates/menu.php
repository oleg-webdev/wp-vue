<?php
global $_am;
$header_class = $_am[ 'sticky-header' ] ? "mdl-layout__header"
	: "mdl-layout__header mdl-layout__header--scroll";
?>
<header class="<?php echo $header_class ?>">
	<div class="mdl-layout__header-row">
		<span class="mdl-layout-title"><?php echo material_logo() ?></span>
		<div class="mdl-layout-spacer"></div>
		<?php
		if ( ! has_nav_menu( 'primary' ) ) {
			$menu_id = wp_create_nav_menu( "Default Theme Menu" );

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

<div class="app-viewport" id="file-list">
	<div class="hidden-on-desktop">
		<md-sidenav class="md-left md-fixed" ref="sidebar">
			<md-toolbar class="md-account-header">
				<md-list class="md-transparent">
					<md-list-item class="md-avatar-list">
						<md-avatar class="md-large">
							<img src="https://placeimg.com/64/64/people/8" alt="People">
						</md-avatar>

						<span style="flex: 1"></span>

						<md-avatar>
							<img src="https://placeimg.com/40/40/people/3" alt="People">
						</md-avatar>

						<md-avatar>
							<img src="https://placeimg.com/40/40/people/4" alt="People">
						</md-avatar>
					</md-list-item>

					<md-list-item>
						<div class="md-list-text-container">
							<span>John Doe</span>
							<span>johndoe@email.com</span>
						</div>

						<md-button class="md-icon-button md-list-action">
							<md-icon>arrow_drop_down</md-icon>
						</md-button>
					</md-list-item>
				</md-list>
			</md-toolbar>

		<?php echo render_mobile_menu() ?>
		</md-sidenav>


		<md-whiteframe md-elevation="3">
			<md-button class="md-icon-button" @click="$refs.sidebar.toggle()">
				<md-icon>menu</md-icon>
			</md-button>
		</md-whiteframe>

	</div>

</div>