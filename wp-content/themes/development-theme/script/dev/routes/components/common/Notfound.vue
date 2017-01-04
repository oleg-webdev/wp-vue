<style lang="scss">
</style>
<template>
	<div id="Notfound-scope" ref="notfoundscope">
		<h1 class="text-center mdl-color-text--blue-grey-700">.404 Nothing Found</h1>
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

		mounted() {
			var vm = this;

			eventHub.$emit('profileViewHeight', vm.$refs.notfoundscope.clientHeight)
		},

		methods: {

		}
	}
</script>
