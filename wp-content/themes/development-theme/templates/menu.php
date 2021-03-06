<?php
global $_am;
$header_class = $_am[ 'sticky-header' ] ? "mdl-layout__header"
	: "mdl-layout__header mdl-layout__header--scroll";
?>
<header class="<?php echo $header_class ?>">

	<!--Add/remove am-wrap for swicth full/boxed layout-->
	<div class="mdl-layout__header-row am-wrap flex-container-nowrap">

		<div class="flex-col-20 flex-col-phone-100">
			<span class="mdl-layout-title"><?php echo material_logo() ?></span>
		</div>
		<div class="flex-col-80 flex-col-phone-100">
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

	</div>
</header>

<aside class="app-viewport" id="mobile-navigation-aside">
	<div class="hidden-on-desktop">

		<div class="hide-until-dom-loaded">
			<md-sidenav class="md-left md-fixed " ref="sidebar">
				<?php echo render_mobile_menu() ?>
			</md-sidenav>
		</div>

		<md-whiteframe md-elevation="3">
			<div class="flex-container-nowrap padding-x-10 mobile-nav-inner-handler">
				<div class="flex-col-50">
					<?php echo material_logo() ?>
				</div>
				<div class="flex-col-50 text-right hide-until-dom-loaded">
					<md-button class="md-raised" @click.native="$refs.sidebar.toggle()">
						<md-icon>menu</md-icon>
					</md-button>
				</div>
			</div>
		</md-whiteframe>

	</div>

</aside>