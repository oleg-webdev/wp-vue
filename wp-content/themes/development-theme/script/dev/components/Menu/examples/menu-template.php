<aside class="app-viewport" id="mobile-navigation-aside">
	<div class="hidden-on-desktop">

		<md-whiteframe md-elevation="3">
			<div class="flex-container-nowrap padding-x-10">
				<div class="flex-col-50">
					<?php echo material_logo() ?>
				</div>
				<div class="flex-col-50 text-right hide-until-dom-loaded">
					<md-button class="md-raised" @click.native="triggerMobileMenu()">
						<md-icon v-if="!currentMenuState">menu</md-icon>
						<md-icon v-else>close</md-icon>
					</md-button>
				</div>
			</div>
		</md-whiteframe>

		<div class="hide-until-dom-loaded app-mobile-menu-handler">
			<?php
			$mob_menu     = menu_items_to_tree( 'Mobile Navigation' );
			$mob_sub_menu = menu_items_to_tree( 'Events and tickets' );

			$fb_insta     = [
				'fb'    => $_am[ 'opt-social-facebook' ],
				'insta' => $_am[ 'opt-social-instagram' ],
			];
			$fb_insta = json_encode($fb_insta, JSON_UNESCAPED_SLASHES);
			if ( $mob_menu ) {
				$mob_menu = json_encode( $mob_menu, JSON_UNESCAPED_SLASHES );
				if ( $mob_sub_menu )
					$mob_sub_menu = json_encode( $mob_sub_menu, JSON_UNESCAPED_SLASHES );
				?>
				<app-menu
					menuitems='<?php echo $mob_menu ?>'
					socials='<?php echo $fb_insta ?>'
					menusubitems='<?php echo $mob_sub_menu ?>'></app-menu>
				<?php
			}
			?>
		</div>

	</div>

</aside>