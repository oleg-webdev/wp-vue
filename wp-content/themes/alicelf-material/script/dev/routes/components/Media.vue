<style lang="scss">
</style>
<template>
	<div class="Bar-scope">
		<h1>Media Component</h1>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid assumenda, blanditiis debitis dolor ducimus facere magnam, magni maxime molestiae mollitia non provident quasi repellendus sint tempora unde veritatis. Minus, mollitia!
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" id="txt-id">
			<label class="mdl-textfield__label" for="txt-id">Some placeholder</label>
		</div>

		<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Submit</button>
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
			console.log('Bar ready.')
		}
	}
</script>
