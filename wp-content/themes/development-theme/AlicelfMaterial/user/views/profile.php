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
			<userprofile></userprofile>
		</div>

		<!-- @TODO: Entry point is USERS LISTING -->
		<div v-if="authInfo.network_purpose == 'users_listing'">

		</div>

		<!-- @TODO: Entry point is USERS ACTIVITY -->
		<div v-if="authInfo.network_purpose == 'users_activity'">

		</div>

	</div>
<?php
get_footer();