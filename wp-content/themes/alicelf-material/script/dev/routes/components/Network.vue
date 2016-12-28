<style lang="scss">

</style>
<template>
	<div id="Network-scope" ref="networkscope">
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

		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.networkscope.clientHeight)
		},

		methods: {

		}
	}
</script>
