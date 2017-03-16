<template>
	<div id="Profile-scope" class="flex-container">

		<md-list id="dashboardnav" class="md-dense flex-col-20" v-if="currentUserModel">

			<md-list-item class="md-primary">
				<router-link class="button" :to="{path: '/'+netwoRkUrlendpoint }" exact>
					<md-icon>home</md-icon>
					<span class="hidden-on-phones">Home Link</span>
				</router-link>
			</md-list-item>

			<md-list-item>
				<router-link class="button" :to="{path:'/'+netwoRkUrlendpoint+'/settings'}">
					<md-icon>settings</md-icon>
					<span class="hidden-on-phones">Settings</span>
				</router-link>
			</md-list-item>

			<md-list-item>
				<router-link class="button" :to="{path:'/'+netwoRkUrlendpoint+'/media'}">
					<md-icon>photo_library</md-icon>
					<span class="hidden-on-phones">Media</span>
				</router-link>
			</md-list-item>

			<md-list-item>
				<router-link class="button" :to="{path:'/'+netwoRkUrlendpoint+'/auth'}">
					<md-icon>warning</md-icon>
					<span class="hidden-on-phones">Auth</span>
				</router-link>
			</md-list-item>

		</md-list>


		<div class="flex-col-80" :class="{'flex-col-100': !currentUserModel}"
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
				netwoRkUrlendpoint: AMdefaults.routerPrefix + AMdefaults.networkSlug
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