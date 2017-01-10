<template>
	<div id="Profile-scope" class="flex-container">

		<md-list id="dashboardnav" class="md-dense flex-col-20" v-if="currentUserModel">

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
				<router-link class="button" to="/user/auth">
					<md-icon>warning</md-icon>
					<span>Auth</span>
				</router-link>
			</md-list-item>

		</md-list>


		<div class="flex-col-80" v-bind:class="{'flex-col-100': !currentUserModel}"
				 id="network-content" ref="networkcontent"
		>
			<transition name="panelslide">
				<router-view class="view"></router-view>
			</transition>
		</div>

	</div>
</template>

<script>
	import user from '../../vuex/User'
	export default {
		data() {
			return {

			}
		},

		computed: {

			currentUserModel: function() {
				return user.state.userdata;
			}

		},

		created(){
			var vm = this;
			eventHub.$on('profileViewHeight', function(data) {
				var container = vm.$refs.networkcontent;
				container.style.minHeight = data+'px'
			})
		},

		mounted() {
			console.log('Profile ready.')
		},

		methods: {

		},

	}
</script>