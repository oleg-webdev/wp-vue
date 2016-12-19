<?php
get_header();
global $wp_query;
// any value after nework endpoint
// "/" separated values
$user_params = $wp_query->query_vars[ am_profile_slug() ];
?>
	<div class="fulpage-wrap clearfix">

		<!-- Entry point is USER PROFILE -->
		<div v-if="authInfo.network_purpose == 'user_profile'">

		</div>

		<!-- @TODO: Entry point is USERS LISTING -->
		<div v-if="authInfo.network_purpose == 'users_listing'"></div>

		<!-- @TODO: Entry point is USERS ACTIVITY -->
		<div v-if="authInfo.network_purpose == 'users_activity'"></div>

		<div class="clearfix">
			<div class="dashboardnav mdl-list col-md-3">
				<router-link to="/user" class="mdl-list__item mdl-js-ripple-effect">
					<span class="mdl-ripple"></span>
					<span class="am-router-name">Index</span>
				</router-link>
				<router-link to="/user/foo" class="mdl-list__item mdl-js-ripple-effect">
					<span class="mdl-ripple"></span>
					<div class="am-router-name">Foo</div>
				</router-link>
				<router-link to="/user/bar" class="mdl-list__item mdl-js-ripple-effect">
					<span class="mdl-ripple"></span>
					<span class="am-router-name">Bar</span>
				</router-link>
				<router-link to="/jibberjabber" class="mdl-list__item mdl-js-ripple-effect">
					<span class="mdl-ripple"></span>
					<span class="am-router-name">To Notfound</span>
				</router-link>
			</div>

			<div class="network-content col-md-9">
				<transition name="panelslide">
					<router-view class="view"></router-view>
				</transition>
			</div>
		</div>

	</div>
<?php
get_footer();