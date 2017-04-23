<header>
	<div class="row">
		<div class="col-12 col-md-4">
			<a href="<?php echo get_site_url() ?>">
				<?php bloginfo( 'name' ) ?>
			</a>
		</div>
		<div class="col-12 col-md-8">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( [
					'show_home'      => true,
					'theme_location' => 'primary',
					'menu_class'     => 'nav justify-content-center',
					'container'      => 'nav',
					'walker'         => new AMenu()
				] );
			} else {
				$menu_id = wp_create_nav_menu( "Default Theme Menu" );
				wp_nav_menu( [
					'show_home'  => true,
					'menu_class' => 'nav justify-content-center',
					'container'  => 'nav',
					'walker'         => new AMenu()
				] );
			}
			?>
		</div>
	</div>
</header>