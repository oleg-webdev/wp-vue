<style lang="scss">

</style>
<template>
	<div class="Network-scope">
		<h1>Network</h1>
		<pre>{{currentUserModel}}</pre>
	</div>
</template>

<script>
	import usr from '../../vuex/User'
	export default {

		data() {
			return {

			}
		},

		computed: {

			currentUserModel: function() {
				return usr.state.userdata;
			}

		},

		created(){

		},

		methods: {

		},

		mounted() {
			console.log('Network ready.')
		}
	}
</script>
