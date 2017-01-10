<style lang="scss" rel="stylesheet/scss">
</style>
<template>
	<div ref="restorepassscope" id="Restore-pass-scope">
		<h3>Restore pass scope</h3>
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
			eventHub.$emit('profileViewHeight', vm.$refs.restorepassscope.clientHeight)
		},

		methods: {

		}
	}
</script>
