<style lang="scss">

</style>
<template>
	<div id="Profile-scope">

		<md-list id="dashboardnav" class="md-dense">

			<md-list-item class="md-primary">
				<router-link class="button" to="/user" exact>
					<md-icon>home</md-icon>
					<span>Home Link</span>
				</router-link>
			</md-list-item>

			<md-list-item>
				<router-link class="button" to="/user/settings">
					<md-icon>settings</md-icon>
					<span>Settings</span>
				</router-link>
			</md-list-item>

			<md-list-item>
				<router-link class="button" to="/user/media">
					<md-icon>photo_library</md-icon>
					<span>Media</span>
				</router-link>
			</md-list-item>

			<md-list-item>
				<router-link class="button" to="/user/jibberjabber">
					<md-icon>warning</md-icon>
					<span>Notfound</span>
				</router-link>
			</md-list-item>

		</md-list>


		<div id="network-content">
			<transition name="panelslide">
				<router-view class="view"></router-view>
			</transition>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {

			}
		},

		computed: {

		},

		created(){

		},

		methods: {

		},

		mounted() {
			console.log('Profile ready.')
		}
	}
</script>