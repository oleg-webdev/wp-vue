<template>
	<div id="Settings-scope" ref="settingsscope">
		<h1>Settings Component</h1>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, aspernatur beatae cum dignissimos, ea iusto molestias mollitia neque quis recusandae repudiandae tempore unde vitae! Facere labore magnam nesciunt nulla optio!
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
			eventHub.$emit('profileViewHeight', vm.$refs.settingsscope.clientHeight)
		},

		methods: {

		}
	}
</script>
