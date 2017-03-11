<template>
	<div id="Network-scope" ref="networkscope">
		<h1>Network</h1>
		<md-button v-show="currentUserModel.administrator"
							 class="normal-case"
							 href="/wp-admin"><md-icon>dashboard</md-icon> Admin Dashboard</md-button>
		<pre>{{currentUserModel}}</pre>

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

		},

		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.networkscope.clientHeight)
		},

		methods: {

		}
	}
</script>
