<style lang="scss">
</style>
<template>
	<div ref="restrictedscope" id="Restricted-scope">

		<div class="col-md-8 col-md-offset-2">
			<hgroup class="text-center">
				<h1>Bad Request</h1>
				<h2>
					<router-link to="/user" exact>
						<md-icon>home</md-icon>
						<span>Are you lost?</span>
					</router-link>
				</h2>
			</hgroup>
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

		// Constructor
		created(){

		},

		// Rendered
		mounted() {
			var vm = this;
			eventHub.$emit('profileViewHeight', vm.$refs.restrictedscope.clientHeight)
		},

		methods: {

		}
	}
</script>