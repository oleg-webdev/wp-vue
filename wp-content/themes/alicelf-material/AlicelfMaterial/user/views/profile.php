<?php
get_header();
global $wp_query;
// any value after nework endpoint
// "/" separated values
$user_params = $wp_query->query_vars[am_profile_slug()];
?>
<div class="fulpage-wrap clearfix">
	<pre>
		{{currentUserModel}}
	</pre>
	<router-link to="/user/foo" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
		Foo
	</router-link >
	<router-link to="/user/bar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
		Bar
	</router-link>

	<div class='relative-container userprofile'>
		<transition name="panelslide">
			<router-view class="view"></router-view>
		</transition>
	</div>

</div>

<?php
get_footer();