<?php
get_header();
global $wp_query;
// any value after nework endpoint
// "/" separated values
$user_params = $wp_query->query_vars[am_profile_slug()];
?>
<div class="am-wrap">
	<h2 class="text-center mdl-color-text--blue-grey-600">Network Area</h2>
	<router-link to="/foo" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
		Foo
	</router-link >
	<router-link to="/bar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
		Bar
	</router-link>

	<div class='relative-container userprofile'>
		<transition name="panelslide">
			<router-view class="view"></router-view>
		</transition>
	</div>
	<hr>
</div>

<?php
get_footer();